<?php

namespace Smals\Entity;

class Contact
{
    protected $prenom;
    protected $nom;

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     * @return Contact
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Contact
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }


}