<?php

namespace App\Entity;

use App\Repository\PatientIdentitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientIdentitiesRepository::class)]
class PatientIdentities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 30)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $occupation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $employer = null;

    #[ORM\OneToMany(mappedBy: 'patients_identities', targetEntity: Patients::class, orphanRemoval: true)]
    private Collection $patients;

    #[ORM\OneToMany(mappedBy: 'patients_identities', targetEntity: Consultations::class, orphanRemoval: true)]
    private Collection $consultations;

    #[ORM\OneToMany(mappedBy: 'debit', targetEntity: Bills::class)]
    private Collection $bills;

    #[ORM\ManyToOne(inversedBy: 'patientIdentities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genres $genre = null;


    public function __construct()
    {
        $this->patients = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->bills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(?string $occupation): static
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getEmployer(): ?string
    {
        return $this->employer;
    }

    public function setEmployer(?string $employer): static
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    /**
     * @return Collection<int, Patients>
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patients $patient): static
    {
        if (!$this->patients->contains($patient)) {
            $this->patients->add($patient);
            $patient->setPatientsIdentities($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getPatientsIdentities() === $this) {
                $patient->setPatientsIdentities(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Consultations>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultations $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->setPatientsIdentities($this);
        }

        return $this;
    }

    public function removeConsultation(Consultations $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPatientsIdentities() === $this) {
                $consultation->setPatientsIdentities(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bills>
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    public function addBill(Bills $bill): static
    {
        if (!$this->bills->contains($bill)) {
            $this->bills->add($bill);
            $bill->setDebit($this);
        }

        return $this;
    }

    public function removeBill(Bills $bill): static
    {
        if ($this->bills->removeElement($bill)) {
            // set the owning side to null (unless already changed)
            if ($bill->getDebit() === $this) {
                $bill->setDebit(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?Genres
    {
        return $this->genre;
    }

    public function setGenre(?Genres $genre): static
    {
        $this->genre = $genre;

        return $this;
    }


}
