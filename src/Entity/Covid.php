<?php

namespace App\Entity;
use Cassandra\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table (name="Covid")
 *
 */
class Covid
{
    /**
     * @var int
     * @ORM\Column (name="idCovid",type="integer")
     * @ORM\GeneratedValue()
     * @ORM\Id ()
     */
    public $idCovid;
    /**
     * @var string
     * @ORM\Column (name="version",type="string")
     */
    public $version;
    /**
     * @param Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Robot",mappedBy="Covid",fetch="EAGER");
     */
    public \Doctrine\Common\Collections\Collection $listecovid;

}