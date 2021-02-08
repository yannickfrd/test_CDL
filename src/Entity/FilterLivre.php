<?php


namespace App\Entity;


class FilterLivre
{
    private $name;

    private $date;

    private $auteur;

    private $categorie;

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     * @return FilterLivre
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return FilterLivre
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return FilterLivre
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     * @return FilterLivre
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }
}