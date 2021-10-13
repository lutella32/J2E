<?php

namespace App\Entity;
use Cassandra\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table (name="Marque");
 */
class Marque
{
    /**
     * @var int
     * @ORM\Column (name="idMarque",type="integer")
     * @ORM\GeneratedValue()
     * @ORM\Id()
     */
    public $idMarque;

    /**
     * @var string
     * @ORM\Column (name="nomMarque",type="string")
     */
    public $nomMarque;

    /**
     * @param Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Robot",mappedBy="Marque",fetch="EAGER");
     */
    public \Doctrine\Common\Collections\Collection $liste;
}