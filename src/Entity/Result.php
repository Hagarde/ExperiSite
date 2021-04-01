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
     * @ORM\Column(type="float", nullable=false)
     */
    private $beta;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $pi;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $mu;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $S1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $U1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $P1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $RU1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $RP1;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $Repartition1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Repartition2;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $Repartition3;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $Repartition4;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $Temps;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $proportioninitiale;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $idexp;

    /**
     * @ORM\Column(type="float")
     */
    private $s2;

    /**
     * @ORM\Column(type="float")
     */
    private $u2;

    /**
     * @ORM\Column(type="float")
     */
    private $rp2;

    /**
     * @ORM\Column(type="float")
     */
    private $ru2;

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

    public function getRepartition1(): ?float
    {
        return $this->Repartition1;
    }

    public function setRepartition1(?float $Repartition1): self
    {
        $this->Repartition1 = $Repartition1;

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

    public function getIdexp(): ?int
    {
        return $this->idexp;
    }

    public function setIdexp(?int $idexp): self
    {
        $this->idexp = $idexp;

        return $this;
    }

    public function getS2(): ?float
    {
        return $this->s2;
    }

    public function setS2(float $s2): self
    {
        $this->s2 = $s2;

        return $this;
    }

    public function getU2(): ?float
    {
        return $this->u2;
    }

    public function setU2(float $u2): self
    {
        $this->u2 = $u2;

        return $this;
    }

    public function getRp2(): ?float
    {
        return $this->rp2;
    }

    public function setRp2(float $rp2): self
    {
        $this->rp2 = $rp2;

        return $this;
    }

    public function getRu2(): ?float
    {
        return $this->ru2;
    }

    public function setRu2(float $su2): self
    {
        $this->su2 = $r
        u2;

        return $this;
    }

}
