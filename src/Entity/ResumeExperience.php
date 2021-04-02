<?php

namespace App\Entity;

use App\Repository\ResumeExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResumeExperienceRepository::class)
 */
class ResumeExperience
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
    private $r0;

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
    private $I0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getR0(): ?float
    {
        return $this->r0;
    }

    public function setR0(float $r0): self
    {
        $this->r0 = $r0;

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
        return $this->I0;
    }

    public function setI0(float $I0): self
    {
        $this->I0 = $I0;

        return $this;
    }
}
