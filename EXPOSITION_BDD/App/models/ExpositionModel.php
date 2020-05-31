<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 26/03/2020
 * Time: 23:47
 */
class ExpositionModel extends Model
{
    protected $table_name= "exposition";

    protected $id_column_name = "nom_exposition";
    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    public function __construct() {
    }

}