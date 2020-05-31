<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 26/03/2020
 * Time: 23:40
 */

class DB
{
    private static $_instance = null;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct() {
    }


    public static function getInstance(){
        if(is_null(self::$_instance)) {
            try
            {
                self::$_instance = new PDO('mysql:host=localhost;dbname=exposition;charset=utf8',
                    'root', '',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
        }
        return self::$_instance;
    }

}