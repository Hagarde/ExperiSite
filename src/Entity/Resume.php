<?php

namespace App\Entity;

use App\Repository\ResumeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResumeRepository::class)
 */
class Resume
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
     * @ORM\OneToMany(targetEntity=EtatExp::class, mappedBy="experience", orphanRemoval=true)
     */
    private $detail;

    /**
     * @ORM\Column(type="float")
     */
    private $I0;

    /**
     * @ORM\Column(type="float")
     */
    private $influence12;

    /**
     * @ORM\Column(type="float")
     */
    private $influence13;

    /**
     * @ORM\Column(type="float")
     */
    private $influence14;

    /**
     * @ORM\Column(type="float")
     */
    private $influence23;

    /**
     * @ORM\Column(type="float")
     */
    private $influence24;

    /**
     * @ORM\Column(type="float")
     */
    private $influence34;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acc;

    /**
     * @ORM\Column(type="float")
     */
    private $epsilon;

    public function __construct()
    {
        $this->detail = new ArrayCollection();
    }

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

    /**
     * @return Collection|EtatExp[]
     */
    public function getDetail(): Collection
    {
        return $this->detail;
    }

    public function addDetail(EtatExp $detail): self
    {
        if (!$this->detail->contains($detail)) {
            $this->detail[] = $detail;
            $detail->setExperience($this);
        }

        return $this;
    }

    public function removeDetail(EtatExp $detail): self
    {
        if ($this->detail->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getExperience() === $this) {
                $detail->setExperience(null);
            }
        }

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

    public function getInfluence12(): ?float
    {
        return $this->influence12;
    }

    public function setInfluence12(float $influence12): self
    {
        $this->influence12 = $influence12;

        return $this;
    }

    public function getInfluence13(): ?float
    {
        return $this->influence13;
    }

    public function setInfluence13(float $influence13): self
    {
        $this->influence13 = $influence13;

        return $this;
    }

    public function getInfluence14(): ?float
    {
        return $this->influence14;
    }

    public function setInfluence14(float $influence14): self
    {
        $this->influence14 = $influence14;

        return $this;
    }

    public function getInfluence23(): ?float
    {
        return $this->influence23;
    }

    public function setInfluence23(float $influence23): self
    {
        $this->influence23 = $influence23;

        return $this;
    }

    public function getInfluence24(): ?float
    {
        return $this->influence24;
    }

    public function setInfluence24(float $influence24): self
    {
        $this->influence24 = $influence24;

        return $this;
    }

    public function getInfluence34(): ?float
    {
        return $this->influence34;
    }

    public function setInfluence34(float $influence34): self
    {
        $this->influence34 = $influence34;

        return $this;
    }

    public function getAcc(): ?bool
    {
        return $this->acc;
    }

    public function setAcc(bool $acc): self
    {
        $this->acc = $acc;

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
