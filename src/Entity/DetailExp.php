<?php

namespace App\Entity;

use App\Repository\DetailExpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailExpRepository::class)
 */
class DetailExp
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
    private $idexp;

    /**
     * @ORM\Column(type="float")
     */
    private $s1;

    /**
     * @ORM\Column(type="float")
     */
    private $s2;

    /**
     * @ORM\Column(type="float")
     */
    private $s3;

    /**
     * @ORM\Column(type="float")
     */
    private $s4;

    /**
     * @ORM\Column(type="float")
     */
    private $u1;

    /**
     * @ORM\Column(type="float")
     */
    private $u2;

    /**
     * @ORM\Column(type="float")
     */
    private $u3;

    /**
     * @ORM\Column(type="float")
     */
    private $u4;

    /**
     * @ORM\Column(type="float")
     */
    private $p1;

    /**
     * @ORM\Column(type="float")
     */
    private $p2;

    /**
     * @ORM\Column(type="float")
     */
    private $p3;

    /**
     * @ORM\Column(type="float")
     */
    private $p4;

    /**
     * @ORM\Column(type="float")
     */
    private $ru1;

    /**
     * @ORM\Column(type="float")
     */
    private $ru2;

    /**
     * @ORM\Column(type="float")
     */
    private $ru3;

    /**
     * @ORM\Column(type="float")
     */
    private $ru4;

    /**
     * @ORM\Column(type="float")
     */
    private $rp1;

    /**
     * @ORM\Column(type="float")
     */
    private $rp2;

    /**
     * @ORM\Column(type="float")
     */
    private $rp3;

    /**
     * @ORM\Column(type="float")
     */
    private $rp4;

    /**
     * @ORM\Column(type="integer")
     */
    private $T;

    /**
     * @ORM\Column(type="float")
     */
    private $Repartition1;

    /**
     * @ORM\Column(type="float")
     */
    private $Repartition2;

    /**
     * @ORM\Column(type="float")
     */
    private $Repartition3;

    /**
     * @ORM\Column(type="float")
     */
    private $Repartition4;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getS1(): ?float
    {
        return $this->s1;
    }

    public function setS1(float $s1): self
    {
        $this->s1 = $s1;

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

    public function getS3(): ?float
    {
        return $this->s3;
    }

    public function setS3(float $s3): self
    {
        $this->s3 = $s3;

        return $this;
    }

    public function getS4(): ?float
    {
        return $this->s4;
    }

    public function setS4(float $s4): self
    {
        $this->s4 = $s4;

        return $this;
    }

    public function getU1(): ?float
    {
        return $this->u1;
    }

    public function setU1(float $u1): self
    {
        $this->u1 = $u1;

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

    public function getU3(): ?float
    {
        return $this->u3;
    }

    public function setU3(float $u3): self
    {
        $this->u3 = $u3;

        return $this;
    }

    public function getU4(): ?float
    {
        return $this->u4;
    }

    public function setU4(float $u4): self
    {
        $this->u4 = $u4;

        return $this;
    }

    public function getP1(): ?float
    {
        return $this->p1;
    }

    public function setP1(float $p1): self
    {
        $this->p1 = $p1;

        return $this;
    }

    public function getP2(): ?float
    {
        return $this->p2;
    }

    public function setP2(float $p2): self
    {
        $this->p2 = $p2;

        return $this;
    }

    public function getP3(): ?float
    {
        return $this->p3;
    }

    public function setP3(float $p3): self
    {
        $this->p3 = $p3;

        return $this;
    }

    public function getP4(): ?float
    {
        return $this->p4;
    }

    public function setP4(float $p4): self
    {
        $this->p4 = $p4;

        return $this;
    }

    public function getRu1(): ?float
    {
        return $this->ru1;
    }

    public function setRu1(float $ru1): self
    {
        $this->ru1 = $ru1;

        return $this;
    }

    public function getRu2(): ?float
    {
        return $this->ru2;
    }

    public function setRu2(float $ru2): self
    {
        $this->ru2 = $ru2;

        return $this;
    }

    public function getRu3(): ?float
    {
        return $this->ru3;
    }

    public function setRu3(float $ru3): self
    {
        $this->ru3 = $ru3;

        return $this;
    }

    public function getRu4(): ?float
    {
        return $this->ru4;
    }

    public function setRu4(float $ru4): self
    {
        $this->ru4 = $ru4;

        return $this;
    }

    public function getRp1(): ?float
    {
        return $this->rp1;
    }

    public function setRp1(float $rp1): self
    {
        $this->rp1 = $rp1;

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

    public function getRp3(): ?float
    {
        return $this->rp3;
    }

    public function setRp3(float $rp3): self
    {
        $this->rp3 = $rp3;

        return $this;
    }

    public function getRp4(): ?float
    {
        return $this->rp4;
    }

    public function setRp4(float $rp4): self
    {
        $this->rp4 = $rp4;

        return $this;
    }

    public function getT(): ?int
    {
        return $this->T;
    }

    public function setT(int $T): self
    {
        $this->T = $T;

        return $this;
    }

    public function getRepartition1(): ?float
    {
        return $this->Repartition1;
    }

    public function setRepartition1(float $Repartition1): self
    {
        $this->Repartition1 = $Repartition1;

        return $this;
    }

    public function getRepartition2(): ?float
    {
        return $this->Repartition2;
    }

    public function setRepartition2(float $Repartition2): self
    {
        $this->Repartition2 = $Repartition2;

        return $this;
    }

    public function getRepartition3(): ?float
    {
        return $this->Repartition3;
    }

    public function setRepartition3(float $Repartition3): self
    {
        $this->Repartition3 = $Repartition3;

        return $this;
    }

    public function getRepartition4(): ?float
    {
        return $this->Repartition4;
    }

    public function setRepartition4(float $Repartition4): self
    {
        $this->Repartition4 = $Repartition4;

        return $this;
    }
}
