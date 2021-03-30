<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultRepository::class)
 */
class Result
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $beta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pi;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mu;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $S;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $U;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $P;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $RU;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $RP;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Repartititon1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Repartition2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Repartition3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Repartition4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Temps;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $proportioninitiale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idutilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeta(): ?float
    {
        return $this->beta;
    }

    public function setBeta(?float $beta): self
    {
        $this->beta = $beta;

        return $this;
    }

    public function getPi(): ?float
    {
        return $this->pi;
    }

    public function setPi(?float $pi): self
    {
        $this->pi = $pi;

        return $this;
    }

    public function getMu(): ?float
    {
        return $this->mu;
    }

    public function setMu(?float $mu): self
    {
        $this->mu = $mu;

        return $this;
    }

    public function getS(): ?float
    {
        return $this->S;
    }

    public function setS(?float $S): self
    {
        $this->S = $S;

        return $this;
    }

    public function getU(): ?float
    {
        return $this->U;
    }

    public function setU(?float $U): self
    {
        $this->U = $U;

        return $this;
    }

    public function getP(): ?float
    {
        return $this->P;
    }

    public function setP(?float $P): self
    {
        $this->P = $P;

        return $this;
    }

    public function getRU(): ?float
    {
        return $this->RU;
    }

    public function setRU(?float $RU): self
    {
        $this->RU = $RU;

        return $this;
    }

    public function getRP(): ?float
    {
        return $this->RP;
    }

    public function setRP(?float $RP): self
    {
        $this->RP = $RP;

        return $this;
    }

    public function getRepartititon1(): ?float
    {
        return $this->Repartititon1;
    }

    public function setRepartititon1(?float $Repartititon1): self
    {
        $this->Repartititon1 = $Repartititon1;

        return $this;
    }

    public function getRepartition2(): ?float
    {
        return $this->Repartition2;
    }

    public function setRepartition2(?float $Repartition2): self
    {
        $this->Repartition2 = $Repartition2;

        return $this;
    }

    public function getRepartition3(): ?float
    {
        return $this->Repartition3;
    }

    public function setRepartition3(?float $Repartition3): self
    {
        $this->Repartition3 = $Repartition3;

        return $this;
    }

    public function getRepartition4(): ?float
    {
        return $this->Repartition4;
    }

    public function setRepartition4(?float $Repartition4): self
    {
        $this->Repartition4 = $Repartition4;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->Temps;
    }

    public function setTemps(?int $Temps): self
    {
        $this->Temps = $Temps;

        return $this;
    }

    public function getProportioninitiale(): ?float
    {
        return $this->proportioninitiale;
    }

    public function setProportioninitiale(?float $proportioninitiale): self
    {
        $this->proportioninitiale = $proportioninitiale;

        return $this;
    }

    public function getIdutilisateur(): ?int
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(?int $idutilisateur): self
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }
}
