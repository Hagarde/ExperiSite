<?php

namespace App\Entity;

use App\Repository\EpidemieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EpidemieRepository::class)
 */
class Epidemie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $R;

    /**
     * @ORM\Column(type="float")
     */
    private $pi;

    /**
     * @ORM\Column(type="float")
     */
    private $mu;

    /**
     * @ORM\Column(type="float")
     */
    private $i0;

    /**
     * @ORM\Column(type="float")
     */
    private $epsilon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getR(): ?float
    {
        return $this->R;
    }

    public function setR(float $R): self
    {
        $this->R = $R;

        return $this;
    }

    public function getPi(): ?float
    {
        return $this->pi;
    }

    public function setPi(float $pi): self
    {
        $this->pi = $pi;

        return $this;
    }

    public function getMu(): ?float
    {
        return $this->mu;
    }

    public function setMu(float $mu): self
    {
        $this->mu = $mu;

        return $this;
    }

    public function getI0(): ?float
    {
        return $this->i0;
    }

    public function setI0(float $i0): self
    {
        $this->i0 = $i0;

        return $this;
    }

    public function getEpsilon(): ?float
    {
        return $this->epsilon;
    }

    public function setEpsilon(float $epsilon): self
    {
        $this->epsilon = $epsilon;

        return $this;
    }
}
