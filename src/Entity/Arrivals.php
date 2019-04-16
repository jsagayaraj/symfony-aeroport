<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArrivalsRepository")
 */
class Arrivals
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $villedAriver;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flights", mappedBy="arrivals")
     */
    private $arrivals;

    public function __construct()
    {
        $this->arrivals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilledAriver(): ?string
    {
        return $this->villedAriver;
    }

    public function setVilledAriver(string $villedAriver): self
    {
        $this->villedAriver = $villedAriver;

        return $this;
    }

    /**
     * @return Collection|Flights[]
     */
    public function getArrivals(): Collection
    {
        return $this->arrivals;
    }

    public function addArrival(Flights $arrival): self
    {
        if (!$this->arrivals->contains($arrival)) {
            $this->arrivals[] = $arrival;
            $arrival->setArrivals($this);
        }

        return $this;
    }

    public function removeArrival(Flights $arrival): self
    {
        if ($this->arrivals->contains($arrival)) {
            $this->arrivals->removeElement($arrival);
            // set the owning side to null (unless already changed)
            if ($arrival->getArrivals() === $this) {
                $arrival->setArrivals(null);
            }
        }

        return $this;
    }
}
