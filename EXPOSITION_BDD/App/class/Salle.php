<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 26/03/2020
 * Time: 22:55
 */

class Salle {
    public $nom_salle;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getNomSalle(): string
    {
        return $this->nom_salle;
    }

    /**
     * @param string $nom_salle
     */
    public function setNomSalle(string $nom_salle): void
    {
        $this->nom_salle = $nom_salle;
    }

}