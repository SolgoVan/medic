<?php

namespace App\Entity;

use App\Repository\JobGradesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobGradesRepository::class)]
class JobGrades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $salary = null;

    #[ORM\OneToMany(mappedBy: 'job_grades', targetEntity: Users::class)]
    private Collection $users;

    #[ORM\Column]
    private ?int $billing_percentage = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setJobGrades($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getJobGrades() === $this) {
                $user->setJobGrades(null);
            }
        }

        return $this;
    }

    public function getBillingPercentage(): ?int
    {
        return $this->billing_percentage;
    }

    public function setBillingPercentage(int $billing_percentage): static
    {
        $this->billing_percentage = $billing_percentage;

        return $this;
    }
}
