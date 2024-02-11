<?php

namespace App\Entity;

use App\Repository\HopitalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HopitalRepository::class)]
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
}
