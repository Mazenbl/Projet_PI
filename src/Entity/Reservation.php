<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(min: 1)]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\Date]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Hopital $Hopital = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $patientNomEtPrenom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getHopital(): ?Hopital
    {
        return $this->Hopital;
    }

    public function setHopital(?Hopital $Hopital): static
    {
        $this->Hopital = $Hopital;

        return $this;
    }

    public function getPatientNomEtPrenom(): ?string
    {
        return $this->patientNomEtPrenom;
    }

    public function setPatientNomEtPrenom(string $patientNomEtPrenom): static
    {
        $this->patientNomEtPrenom = $patientNomEtPrenom;

        return $this;
    }
}
