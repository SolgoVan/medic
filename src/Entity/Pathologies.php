<?php

namespace App\Entity;

use App\Repository\PathologiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PathologiesRepository::class)]
class Pathologies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_allergic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergy = null;

    #[ORM\Column]
    private ?bool $is_diabetic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $diabetes = null;

    #[ORM\Column]
    private ?bool $is_asmatic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $asthma = null;

    #[ORM\Column]
    private ?bool $is_cardiac = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cardiac = null;

    #[ORM\Column]
    private ?bool $is_epileptic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $epilepsy = null;

    #[ORM\Column]
    private ?bool $is_historic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $antecedent = null;

    #[ORM\Column]
    private ?bool $is_treatement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $treatement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    #[ORM\OneToMany(mappedBy: 'pathology', targetEntity: Patients::class)]
    private Collection $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsAllergic(): ?bool
    {
        return $this->is_allergic;
    }

    public function setIsAllergic(bool $is_allergic): static
    {
        $this->is_allergic = $is_allergic;

        return $this;
    }

    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    public function setAllergy(?string $allergy): static
    {
        $this->allergy = $allergy;

        return $this;
    }

    public function isIsDiabetic(): ?bool
    {
        return $this->is_diabetic;
    }

    public function setIsDiabetic(bool $is_diabetic): static
    {
        $this->is_diabetic = $is_diabetic;

        return $this;
    }

    public function getDiabetes(): ?string
    {
        return $this->diabetes;
    }

    public function setDiabetes(?string $diabetes): static
    {
        $this->diabetes = $diabetes;

        return $this;
    }

    public function isIsAsmatic(): ?bool
    {
        return $this->is_asmatic;
    }

    public function setIsAsmatic(bool $is_asmatic): static
    {
        $this->is_asmatic = $is_asmatic;

        return $this;
    }

    public function getAsthma(): ?string
    {
        return $this->asthma;
    }

    public function setAsthma(?string $asthma): static
    {
        $this->asthma = $asthma;

        return $this;
    }

    public function isIsCardiac(): ?bool
    {
        return $this->is_cardiac;
    }

    public function setIsCardiac(bool $is_cardiac): static
    {
        $this->is_cardiac = $is_cardiac;

        return $this;
    }

    public function getCardiac(): ?string
    {
        return $this->cardiac;
    }

    public function setCardiac(?string $cardiac): static
    {
        $this->cardiac = $cardiac;

        return $this;
    }

    public function isIsEpileptic(): ?bool
    {
        return $this->is_epileptic;
    }

    public function setIsEpileptic(bool $is_epileptic): static
    {
        $this->is_epileptic = $is_epileptic;

        return $this;
    }

    public function getEpilepsy(): ?string
    {
        return $this->epilepsy;
    }

    public function setEpilepsy(?string $epilepsy): static
    {
        $this->epilepsy = $epilepsy;

        return $this;
    }

    public function isIsHistoric(): ?bool
    {
        return $this->is_historic;
    }

    public function setIsHistoric(bool $is_historic): static
    {
        $this->is_historic = $is_historic;

        return $this;
    }

    public function getAntecedent(): ?string
    {
        return $this->antecedent;
    }

    public function setAntecedent(?string $antecedent): static
    {
        $this->antecedent = $antecedent;

        return $this;
    }

    public function isIsTreatement(): ?bool
    {
        return $this->is_treatement;
    }

    public function setIsTreatement(bool $is_treatement): static
    {
        $this->is_treatement = $is_treatement;

        return $this;
    }

    public function getTreatement(): ?string
    {
        return $this->treatement;
    }

    public function setTreatement(?string $treatement): static
    {
        $this->treatement = $treatement;

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
            $patient->setPathology($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getPathology() === $this) {
                $patient->setPathology(null);
            }
        }

        return $this;
    }
}
