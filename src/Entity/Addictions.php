<?php

namespace App\Entity;

use App\Repository\AddictionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddictionsRepository::class)]
class Addictions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tobacco = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alcohol = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $drug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $other = null;

    #[ORM\OneToMany(mappedBy: 'addiction', targetEntity: Patients::class)]
    private Collection $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTobacco(): ?string
    {
        return $this->tobacco;
    }

    public function setTobacco(?string $tobacco): static
    {
        $this->tobacco = $tobacco;

        return $this;
    }

    public function getAlcohol(): ?string
    {
        return $this->alcohol;
    }

    public function setAlcohol(?string $alcohol): static
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    public function getDrug(): ?string
    {
        return $this->drug;
    }

    public function setDrug(?string $drug): static
    {
        $this->drug = $drug;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): static
    {
        $this->other = $other;

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
            $patient->setAddiction($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getAddiction() === $this) {
                $patient->setAddiction(null);
            }
        }

        return $this;
    }
}
