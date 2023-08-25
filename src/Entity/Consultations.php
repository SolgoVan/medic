<?php

namespace App\Entity;

use App\Repository\ConsultationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationsRepository::class)]
class Consultations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $practitioner = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PatientIdentities $patients_identities = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Examens $examen = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Localisations $localisation = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmergencyVehicles $vehicle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $care = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $emergency = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPractitioner(): ?Users
    {
        return $this->practitioner;
    }

    public function setPractitioner(?Users $practitioner): static
    {
        $this->practitioner = $practitioner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPatientsIdentities(): ?PatientIdentities
    {
        return $this->patients_identities;
    }

    public function setPatientsIdentities(?PatientIdentities $patients_identities): static
    {
        $this->patients_identities = $patients_identities;

        return $this;
    }

    public function getExamen(): ?Examens
    {
        return $this->examen;
    }

    public function setExamen(?Examens $examen): static
    {
        $this->examen = $examen;

        return $this;
    }

    public function getLocalisation(): ?Localisations
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisations $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getVehicle(): ?EmergencyVehicles
    {
        return $this->vehicle;
    }

    public function setVehicle(?EmergencyVehicles $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getCare(): ?string
    {
        return $this->care;
    }

    public function setCare(string $care): static
    {
        $this->care = $care;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getEmergency(): ?string
    {
        return $this->emergency;
    }

    public function setEmergency(string $emergency): static
    {
        $this->emergency = $emergency;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
