import pandas, random, time, MySQLdb
#generation d'une date
def str_time_prop(start, end ):
    stime = time.mktime(time.strptime(start, '%d/%m/%Y'))
    etime = time.mktime(time.strptime(end, '%d/%m/%Y'))
    ptime = stime + random.random() * (etime - stime)
    return time.strftime('%Y-%m-%d', time.localtime(ptime))

## ########### EXTRACTION DES DONNEES DU FICHIER CSV #############
#lecture du fichier CSV 
data = pandas.read_csv("data.csv", sep=";", encoding="utf-8")
data = data.fillna(0)

tables = ["salle_exposition",  "arrivee", "exposition", "salle", "organisateur"]
#Constantes/ Params base de données
DB_NAME = "exposition"
DB_HOST= "localhost"
DB_USER="root"
DB_PWD=""

############# TRANSFORMATION DES DONNEES ########################

#Calcule du pourcentage moyen pour remplir les champs vides
arrivals = []
cot = 0
# chaque ligne 
for ligne in data.values:
    val = (ligne[5]/ligne[7])*100
    arrivals.append("{}".format(val))
    cot = cot + val
percent_individu = int(cot / len(arrivals))
#end fin du calcul

#création du contenu de la table arrivé & récpération du contenu des tables 
#  expositions , organisateur , salle , salle_exposition

table_exposition = []
table_arrivee = []
table_salle = []
table_salle_exposition = []
table_organisateur = []

    # chaque ligne 
for ligne in data.values:
    # detrminer le nombre en individuel indiv / groupe grp
    indiv = int(ligne[5])
    grp = int(ligne[6])
    total_individus = int(ligne[7])
    if indiv == 0:
        indiv = int(total_individus* percent_individu/100)
        grp = total_individus - indiv
    
    if grp == 0:
        grp = total_individus - indiv
        
    rest = grp % 2
    if rest != 0:
    # Nombre de personnes en individuel à créer
        indiv = indiv + rest
    # nombre de groupe de deux individus à inserer
    grp = int((grp-rest)/2);
    
    # On insere les individuels
    index = 1
    for a in range(indiv + grp):
        if a == indiv :
            index = 2
        # Construction de la table arrivee
        table_arrivee.append( [ index, str_time_prop( ligne[2] , ligne[3] ), ligne[0]])
    
    # Construction de la table exposition
    date_debut = time.strptime(ligne[2], '%d/%m/%Y')
    date_fin = time.strptime(ligne[3], '%d/%m/%Y')
    if time.strptime(ligne[2], '%d/%m/%Y') > time.strptime(ligne[3], '%d/%m/%Y'):
        tmp = date_debut
        date_debut = date_fin
        date_fin = tmp
        
    table_exposition.append([ligne[0], ligne[1], time.strftime("%Y-%m-%d", date_debut),time.strftime("%Y-%m-%d", date_fin), ligne[9]]) 

    # Construction de la table organisateur
    if ligne[9] not in table_organisateur:
        table_organisateur.append(ligne[9])

    salles = ligne[8].split(" / ")
    if(len(salles) > 1):
        for salle in salles:
            if salle not in table_salle:
                table_salle.append(salle)
            # ligne[0] = nom_exposition , salle
            table_salle_exposition.append([ligne[0], salle])
    else:
        if ligne[8] not in table_salle:

# Construction de la table salle         
            table_salle.append(ligne[8])

# Construction de la table salle_exposition
        table_salle_exposition.append([ligne[0], ligne[8]])
#end creation table arrivee
#end recuperationdu contenu des tables   expositions , organisateur , salle , salle_exposition


#connexion à la base de données
mydb = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PWD, db="mysql")
mycursor = mydb.cursor()

#Suppression de la base de données si existante
sql = "DROP DATABASE IF EXISTS {0};".format(DB_NAME)
mycursor.execute(sql, [])
mydb.commit()

#Creation de la base de données
sql = "CREATE DATABASE {0};".format(DB_NAME)
mycursor.execute(sql, [])
mydb.commit()
mydb.close()

#connexion à la base de données exposition
mydb = MySQLdb.connect(host=DB_HOST, user=DB_USER, passwd=DB_PWD, db=DB_NAME)
mycursor = mydb.cursor()

#Creation des tables à nouveau
creatable = []
creatable.append("CREATE TABLE IF NOT EXISTS `salle` (`nom_salle` varchar(255) NOT NULL,PRIMARY KEY (`nom_salle`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;") 

 
creatable.append("CREATE TABLE IF NOT EXISTS `organisateur` (`nom_organisateur` varchar(255) NOT NULL,PRIMARY KEY (`nom_organisateur`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;")
creatable.append("CREATE TABLE IF NOT EXISTS `exposition` (`nom_exposition` varchar(255) NOT NULL,`descriptif_exposition` varchar(500) NOT NULL,`date_debut_d_exposition` date NOT NULL,`date_fin_d_exposition` date NOT NULL,`nom_organisateur` varchar(255) NOT NULL,PRIMARY KEY (`nom_exposition`), FOREIGN KEY (`nom_organisateur`) REFERENCES organisateur(`nom_organisateur`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;")
creatable.append("CREATE TABLE IF NOT EXISTS `arrivee` (`id_arrivee` int(11) NOT NULL AUTO_INCREMENT, `nb_arrivee` int(11) NOT NULL,`date_arrivee` datetime default CURRENT_TIMESTAMP NOT NULL,`nom_exposition` varchar(255) NOT NULL,PRIMARY KEY (`id_arrivee`), FOREIGN KEY (`nom_exposition`) REFERENCES exposition(`nom_exposition`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;")
creatable.append("CREATE TABLE IF NOT EXISTS `salle_exposition` (`nom_exposition` varchar(255) NOT NULL,`nom_salle` varchar(255) NOT NULL,PRIMARY KEY (`nom_exposition`,`nom_salle`), FOREIGN KEY (`nom_salle`) REFERENCES salle(`nom_salle`), FOREIGN KEY (`nom_exposition`) REFERENCES exposition(`nom_exposition`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;")

for sql in creatable:
    mycursor.execute(sql, [])
    mydb.commit()

#Creation des procédures stockées
creatprocedure = []
creatprocedure.append("CREATE PROCEDURE `delete_arrivee_of_exposition`(IN `param_nom_exposition` VARCHAR(255)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER DELETE FROM arrivee WHERE nom_exposition = param_nom_exposition")
creatprocedure.append("CREATE PROCEDURE `delete_salle_of_exposition`(IN `param_nom_exposition` VARCHAR(255)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER DELETE FROM salle_exposition WHERE nom_exposition = param_nom_exposition")

for sql in creatprocedure:
    mycursor.execute(sql, [])
    mydb.commit()

#Creation des déclencheurs/triggers  
creatrigger = []
creatrigger.append("CREATE TRIGGER `delete_exposition_arrivee` BEFORE DELETE ON `exposition` FOR EACH ROW CALL delete_arrivee_of_exposition(old.nom_exposition)")
creatrigger.append("CREATE TRIGGER `delete_exposition_salle` BEFORE DELETE ON `exposition` FOR EACH ROW CALL delete_salle_of_exposition(old.nom_exposition)")

for sql in creatrigger:
    mycursor.execute(sql, [])
    mydb.commit()


############## INSERTION DES DONNEES DANS LA DATA BASE #############
    
# Remplissage table salle

for salle in table_salle:
    sql = "INSERT INTO salle(`nom_salle`) VALUES (%s)"
    mycursor.execute(sql, [salle])
mydb.commit()

# Remplissage table organisateur

for organisateur in table_organisateur:
    sql = "INSERT INTO organisateur(`nom_organisateur`) VALUES (%s)"
    mycursor.execute(sql, [organisateur])
mydb.commit()

# Remplissage table exposition
for exposition in table_exposition:
    sql = "INSERT INTO exposition(`nom_exposition`, `descriptif_exposition`, `date_debut_d_exposition`, `date_fin_d_exposition`, `nom_organisateur`) VALUES(%s, %s, %s, %s, %s)"
    mycursor.execute(sql, exposition)
mydb.commit()

# Remplissage table salle_exposition
for salle_exposition in table_salle_exposition:
    sql = "INSERT INTO salle_exposition(`nom_exposition`, `nom_salle`) VALUES(%s, %s)"
    mycursor.execute(sql, salle_exposition)
mydb.commit()

# Remplissage table arrivee
for arrivee in table_arrivee:
    sql = "INSERT INTO arrivee(`nb_arrivee`, `date_arrivee`, `nom_exposition`) VALUES(%s, %s, %s)"
     mycursor.execute(sql, arrivee)
mydb.commit()


# Fermeture de la connexion a la base de données
mydb.close()


### THE END 

#@Joelle_$intch@