<?php

namespace App\Entity;

use App\Repository\ExpResumeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpResumeRepository::class)
 */
class ExpResume
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
    private $beta;

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
    private $propotioninitiale;

    /**
     * @ORM\Column(type="integer")
     */
    private $idexp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeta(): ?float
    {
        return $this->beta;
    }

    public function setBeta(float $beta): self
    {
        $this->beta = $beta;

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

    public function getPropotioninitiale(): ?float
    {
        return $this->propotioninitiale;
    }

    public function setPropotioninitiale(float $propotioninitiale): self
    {
        $this->propotioninitiale = $propotioninitiale;

        return $this;
    }

    public function getIdexp(): ?int
    {
        return $this->idexp;
    }

    public function setIdexp(int $idexp): self
    {
        $this->idexp = $idexp;

        return $this;
    }
}
