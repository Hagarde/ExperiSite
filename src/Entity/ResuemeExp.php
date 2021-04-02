<?php

namespace App\Entity;

use App\Repository\ResuemeExpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResumeExpRepository::class)
 */
class ResuemeExp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $R0;

    /**
     * @ORM\Column(type="float")
     */
    private $pi;

    /**
     * @ORM\Column(type="float")
     */
    private $mu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getR0(): ?int
    {
        return $this->R0;
    }

    public function setR0(int $R0): self
    {
        $this->R0 = $R0;

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
}
