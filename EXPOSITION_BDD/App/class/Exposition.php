<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 26/03/2020
 * Time: 23:01
 */

class Exposition
{
    public $nom_exposition;
    public $descriptif_exposition;
    public $date_debut_d_exposition;
    public $date_fin_d_exposition;
    public $nom_organisateur;

    public function __construct()
    {
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

    /**
     * @return mixed
     */
    public function getDescriptifExposition()
    {
        return $this->descriptif_exposition;
    }

    /**
     * @param mixed $descriptif_exposition
     */
    public function setDescriptifExposition($descriptif_exposition): void
    {
        $this->descriptif_exposition = $descriptif_exposition;
    }

    /**
     * @return mixed
     */
    public function getDateDebutDExposition()
    {
        return $this->date_debut_d_exposition;
    }

    /**
     * @param mixed $date_debut_d_exposition
     */
    public function setDateDebutDExposition($date_debut_d_exposition): void
    {
        $this->date_debut_d_exposition = $date_debut_d_exposition;
    }

    /**
     * @return mixed
     */
    public function getDateFinDExposition()
    {
        return $this->date_fin_d_exposition;
    }

    /**
     * @param mixed $date_fin_d_exposition
     */
    public function setDateFinDExposition($date_fin_d_exposition): void
    {
        $this->date_fin_d_exposition = $date_fin_d_exposition;
    }

    /**
     * @return mixed
     */
    public function getNomOrganisateur()
    {
        return $this->nom_organisateur;
    }

    /**
     * @param mixed $nom_organisateur
     */
    public function setNomOrganisateur($nom_organisateur): void
    {
        $this->nom_organisateur = $nom_organisateur;
    }


}