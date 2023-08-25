<?php

namespace App\Entity;

use App\Repository\BloodGroupsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BloodGroupsRepository::class)]
class BloodGroups
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $blood_group = null;

    #[ORM\OneToMany(mappedBy: 'blood_group', targetEntity: Patients::class)]
    private Collection $patients;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBloodGroup(): ?string
    {
        return $this->blood_group;
    }

    public function setBloodGroup(string $blood_group): static
    {
        $this->blood_group = $blood_group;

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
            $patient->setBloodGroup($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getBloodGroup() === $this) {
                $patient->setBloodGroup(null);
            }
        }

        return $this;
    }
}
