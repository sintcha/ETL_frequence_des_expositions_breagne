<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 27/03/2020
 * Time: 22:23
 */

require_once "App/DB.php";
require_once "App/class/Salle.php";
require_once "App/class/SalleExposition.php";
require_once "App/class/Exposition.php";
require_once "App/class/Organisateur.php";
abstract class Model
{
    protected $table_name = "default";
    protected $id_column_name = "id";

    public function __construct(){
        // $this->table_name= str_replace("model", "", strlower(get_called_class()));
    }

    /**
     * @param array $params
     * @return bool
     */
    public function insert($params){
        $sql = "INSERT INTO ".$this->table_name."(";
        $sql .= implode(",", array_keys($params));
        $sql.= ") VALUES(";
        for ($i= count($params); $i > 0; $i--){
            $sql .= "?";
            $sql .= $i==1 ? "" : ",";
        }
        $sql .= ")";
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        return $request->execute(array_values($params));
    }

    public function all(){
        $sql = "SELECT * FROM ".$this->table_name;
        $dbh = DB::getInstance();
        $request = $dbh->prepare($sql);
        $request->setFetchMode(PDO::FETCH_CLASS, ucfirst($this->table_name));
        $request->execute();
        return $request->fetchAll();
    }

    /**
     *  Count
     * @param array $criteria
     * @return int
     */
    public function countByCriterea($criteria = []): int
    {
        try{
            $sql = "SELECT COALESCE(SUM(nb_arrivee),0) AS total FROM ".$this->table_name ." WHERE ";
            $sql .= implode(" = ? AND ", array_merge(array_keys($criteria), [""]));

            $sql = substr ($sql, 0, strlen($sql) -4);
            $dbh = DB::getInstance();
            $request = $dbh->prepare($sql);
            $request->execute(array_values($criteria));
            $result = $request->fetch();
            return $result['total'];
        }catch (Exception $exception){
            return 0;
        }
    }

    public function find($id){
        try{
            $sql = "SELECT * FROM ".$this->table_name." WHERE ".$this->id_column_name." = ? LIMIT 1";
            $dbh = DB::getInstance();
            $request = $dbh->prepare($sql);
            $request->setFetchMode(PDO::FETCH_CLASS, ucfirst($this->table_name));
            $request->execute(array($id));
            return $request->fetch();
        }catch (Exception $exception){
            return null;
        }
    }


    public function delete($id){
        try{
            $sql = "DELETE FROM ".$this->table_name." WHERE ".$this->id_column_name." = ?";
            $dbh = DB::getInstance();
            $request = $dbh->prepare($sql);
            return $request->execute(array($id));
        }catch (Exception $exception){
            echo $exception->getMessage();
            return false;
        }
    }
}




