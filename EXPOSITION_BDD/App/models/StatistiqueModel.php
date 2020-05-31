<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 10/04/2020
 * Time: 19:52
 */

class StatistiqueModel
{

    /**
     * StatistiqueModel constructor.
     * @param string $table_name
     */
    public function __construct()
    {

    }

    public function getCountExpositionByAnnee(){
        $sql = "select count(expo.nom_exposition) as ordonnee , date_format(date_debut_d_exposition,\"%Y\") as abscisse
        from exposition.exposition as expo
        group by abscisse";
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, "Statistique");
        $request->execute();
        return $request->fetchAll();
    }

    public function getCountExpositionByOrganisation(){
        $sql = "select count(nom_exposition) as ordonnee , nom_organisateur as abscisse 
        from exposition.exposition as expo
        group by abscisse";
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, "Statistique");
        $request->execute();
        return $request->fetchAll();
    }

    public function getNbJourByExposition(){
        $sql = "select DATEDIFF(date_fin_d_exposition, date_debut_d_exposition) as  ordonnee, nom_exposition as abscisse 
        from exposition.exposition ";
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, "Statistique");
        $request->execute();
        return $request->fetchAll();
    }

    public function getNbArriveeByExposition(){
        $sql = "select sum(nb_arrivee) as ordonnee, nom_exposition as abscisse
        from exposition.arrivee 
        group by nom_exposition ";
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, "Statistique");
        $request->execute();
        return $request->fetchAll();
    }

}