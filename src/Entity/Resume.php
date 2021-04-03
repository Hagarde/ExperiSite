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
}
