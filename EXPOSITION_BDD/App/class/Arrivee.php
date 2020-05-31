<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 31/03/2020
 * Time: 01:56
 */

class Arrivee
{

    public $id_arrivee;
    public $nb_arrivee;
    public $date_arrivee;
    public $nom_exposition;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdArrivee()
    {
        return $this->id_arrivee;
    }

    /**
     * @param mixed $id_arrivee
     */
    public function setIdArrivee($id_arrivee): void
    {
        $this->id_arrivee = $id_arrivee;
    }

    /**
     * @return mixed
     */
    public function getNbArrivee()
    {
        return $this->nb_arrivee;
    }

    /**
     * @param mixed $nb_arrivee
     */
    public function setNbArrivee($nb_arrivee): void
    {
        $this->nb_arrivee = $nb_arrivee;
    }

    /**
     * @return mixed
     */
    public function getDateArrivee()
    {
        return $this->date_arrivee;
    }

    /**
     * @param mixed $date_arrivee
     */
    public function setDateArrivee($date_arrivee): void
    {
        $this->date_arrivee = $date_arrivee;
    }

    /**
     * @return mixed
     */
    public function getNomExposition()
    {
        return $this->nom_exposition;
    }

    /**
     * @param mixed $nom_exposition
     */
    public function setNomExposition($nom_exposition): void
    {
        $this->nom_exposition = $nom_exposition;
    }


}