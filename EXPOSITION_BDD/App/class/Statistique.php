<?php
/**
 * Created by PhpStorm.
 * User: stchj
 * Date: 10/04/2020
 * Time: 19:47
 */

class Statistique
{
    public $abscisse;
    public $ordonnee;


    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getAbscisse()
    {
        return $this->abscisse;
    }

    /**
     * @param mixed $abscisse
     */
    public function setAbscisse($abscisse): void
    {
        $this->abscisse = $abscisse;
    }

    /**
     * @return mixed
     */
    public function getOrdonnee()
    {
        return $this->ordonnee;
    }

    /**
     * @param mixed $ordonnee
     */
    public function setOrdonnee($ordonnee): void
    {
        $this->ordonnee = $ordonnee;
    }

}