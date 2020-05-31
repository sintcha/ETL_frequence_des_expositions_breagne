<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 26/03/2020
 * Time: 23:00
 */

class Organisateur
{
    public $nom_organisateur;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getNomOrganisateur(): string
    {
        return $this->nom_organisateur;
    }

    /**
     * @param string $nom_organisateur
     */
    public function setNomOrganisateur(string $nom_organisateur): void
    {
        $this->nom_organisateur = $nom_organisateur;
    }


}