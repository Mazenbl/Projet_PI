<?php

namespace App\Entity;

use App\Repository\HopitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: HopitalRepository::class)]
#[Vich\Uploadable]
class Hopital
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $nbr_Chambre = null;

    #[ORM\Column(length: 255)]
    private ?string $num_Tel = null;

    #[ORM\OneToMany(mappedBy: 'hopital', targetEntity: Chambre::class)]
    private Collection $hopital_chambre;

   /**
     * @Vich\UploadableField(mapping="hopital_images", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    #[ORM\OneToMany(mappedBy: 'idHopital', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->hopital_chambre = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }


    public function getImageFile()
    {
        return $this->imageFile;
    }
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNbrChambre(): ?int
    {
        return $this->nbr_Chambre;
    }

    public function setNbrChambre(int $nbr_Chambre): static
    {
        $this->nbr_Chambre = $nbr_Chambre;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->num_Tel;
    }

    public function setNumTel(string $num_Tel): static
    {
        $this->num_Tel = $num_Tel;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getHopitalChambre(): Collection
    {
        return $this->hopital_chambre;
    }

    public function addHopitalChambre(Chambre $hopitalChambre): static
    {
        if (!$this->hopital_chambre->contains($hopitalChambre)) {
            $this->hopital_chambre->add($hopitalChambre);
            $hopitalChambre->setHopital($this);
        }

        return $this;
    }

    public function removeHopitalChambre(Chambre $hopitalChambre): static
    {
        if ($this->hopital_chambre->removeElement($hopitalChambre)) {
            // set the owning side to null (unless already changed)
            if ($hopitalChambre->getHopital() === $this) {
                $hopitalChambre->setHopital(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->nom; // Or any other property you want to use as a string representation
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setIdHopital($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdHopital() === $this) {
                $reservation->setIdHopital(null);
            }
        }

        return $this;
    }
}
