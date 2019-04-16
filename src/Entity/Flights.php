<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightsRepository")
 * @Vich\Uploadable()
 */
class Flights
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string|nul
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

     /**
     * @Vich\UploadableField(mapping="flight_image", fileNameProperty="filename")
     * @var File
     */
    private $imageFile;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flightName;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $flightNumber;

    // /**
    //  * @ORM\Column(type="string", length=255)
    //  */
    // private $departures;

    // /**
    //  * @ORM\Column(type="string", length=255)
    //  */
    // private $arrivals;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */

    private $maxPlace;

     /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departures", inversedBy="flights")
     */
    private $departures;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arrivals", inversedBy="arrivals")
     */
    private $arrivals;

       

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightName(): ?string
    {
        return $this->flightName;
    }

    public function setFlightName(string $flightName): self
    {
        $this->flightName = $flightName;

        return $this;
    }

    public function getFlightNumber(): ?string
    {
        return $this->flightNumber;
    }

    public function setFlightNumber(string $flightNumber): self
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    // public function getDepartures(): ?string
    // {
    //     return $this->departures;
    // }

    // public function setDepartures(string $departures): self
    // {
    //     $this->departures = $departures;

    //     return $this;
    // }

    // public function getArrivals(): ?string
    // {
    //     return $this->arrivals;
    // }

    // public function setArrivals(string $arrivals): self
    // {
    //     $this->arrivals = $arrivals;

    //     return $this;
    // }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMaxPlace(): ?int
    {
        return $this->maxPlace;
    }

    public function setMaxPlace(int $maxPlace): self
    {
        $this->maxPlace = $maxPlace;

        return $this;
    }

     

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFormattedPrice():string
    {
        return number_format($this->price, 0, '', ' ');
    }

  /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getDepartures(): ?Departures
    {
        return $this->departures;
    }

    public function setDepartures(?Departures $departures): self
    {
        $this->departures = $departures;

        return $this;
    }

    public function getArrivals(): ?Arrivals
    {
        return $this->arrivals;
    }

    public function setArrivals(?Arrivals $arrivals): self
    {
        $this->arrivals = $arrivals;

        return $this;
    }

   

      
}
