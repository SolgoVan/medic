<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $genre = null;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: PatientIdentities::class, orphanRemoval: true)]
    private Collection $patientIdentities;

    public function __construct()
    {
        $this->patientIdentities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, PatientIdentities>
     */
    public function getPatientIdentities(): Collection
    {
        return $this->patientIdentities;
    }

    public function addPatientIdentity(PatientIdentities $patientIdentity): static
    {
        if (!$this->patientIdentities->contains($patientIdentity)) {
            $this->patientIdentities->add($patientIdentity);
            $patientIdentity->setGenre($this);
        }

        return $this;
    }

    public function removePatientIdentity(PatientIdentities $patientIdentity): static
    {
        if ($this->patientIdentities->removeElement($patientIdentity)) {
            // set the owning side to null (unless already changed)
            if ($patientIdentity->getGenre() === $this) {
                $patientIdentity->setGenre(null);
            }
        }

        return $this;
    }
}
