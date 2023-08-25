<?php

namespace App\Entity;

use App\Repository\PatientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientsRepository::class)]
class Patients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?PatientIdentities $patients_identities = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?BloodGroups $blood_group = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?Measurements $measurement = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?Addictions $addiction = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?Pathologies $pathology = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    private ?EmergencyPeople $emergency_person = null;

    protected Collection $patientsIdentities;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $created_by = null;


    public function __construct()
    {
        $this->patientsIdentities = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBloodGroup(): ?BloodGroups
    {
        return $this->blood_group;
    }

    public function setBloodGroup(?BloodGroups $blood_group): static
    {
        $this->blood_group = $blood_group;

        return $this;
    }

    public function getMeasurement(): ?Measurements
    {
        return $this->measurement;
    }

    public function setMeasurement(?Measurements $measurement): static
    {
        $this->measurement = $measurement;

        return $this;
    }

    public function getAddiction(): ?Addictions
    {
        return $this->addiction;
    }

    public function setAddiction(?Addictions $addiction): static
    {
        $this->addiction = $addiction;

        return $this;
    }

    public function getPathology(): ?Pathologies
    {
        return $this->pathology;
    }

    public function setPathology(?Pathologies $pathology): static
    {
        $this->pathology = $pathology;

        return $this;
    }

    public function getEmergencyPerson(): ?EmergencyPeople
    {
        return $this->emergency_person;
    }

    public function setEmergencyPerson(?EmergencyPeople $emergency_person): static
    {
        $this->emergency_person = $emergency_person;

        return $this;
    }

    public function getCreatedBy(): ?Users
    {
        return $this->created_by;
    }

    public function setCreatedBy(?Users $created_by): static
    {
        $this->created_by = $created_by;

        return $this;
    }

    
}
