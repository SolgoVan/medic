<?php

namespace App\Entity;

use App\Repository\TotalServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TotalServiceRepository::class)]
class TotalService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'totalServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\OneToOne(inversedBy: 'totalService', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?StartService $start = null;

    #[ORM\OneToOne(inversedBy: 'totalService', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EndService $end = null;

    #[ORM\Column]
    private ?int $total = null;

    #[ORM\Column]
    private ?bool $is_validated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStart(): ?StartService
    {
        return $this->start;
    }

    public function setStart(StartService $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?EndService
    {
        return $this->end;
    }

    public function setEnd(EndService $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function isIsValidated(): ?bool
    {
        return $this->is_validated;
    }

    public function setIsValidated(bool $is_validated): static
    {
        $this->is_validated = $is_validated;

        return $this;
    }
}
