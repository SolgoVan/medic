<?php

namespace App\Entity;

use App\Repository\StartServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StartServiceRepository::class)]
class StartService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'startServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timer = null;

    #[ORM\OneToOne(mappedBy: 'start', cascade: ['persist', 'remove'])]
    private ?EndService $endService = null;

    #[ORM\OneToOne(mappedBy: 'start', cascade: ['persist', 'remove'])]
    private ?TotalService $totalService = null;

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

    public function getTimer(): ?\DateTimeInterface
    {
        return $this->timer;
    }

    public function setTimer(\DateTimeInterface $timer): static
    {
        $this->timer = $timer;

        return $this;
    }

    public function getEndService(): ?EndService
    {
        return $this->endService;
    }

    public function setEndService(EndService $endService): static
    {
        // set the owning side of the relation if necessary
        if ($endService->getStart() !== $this) {
            $endService->setStart($this);
        }

        $this->endService = $endService;

        return $this;
    }

    public function getTotalService(): ?TotalService
    {
        return $this->totalService;
    }

    public function setTotalService(TotalService $totalService): static
    {
        // set the owning side of the relation if necessary
        if ($totalService->getStart() !== $this) {
            $totalService->setStart($this);
        }

        $this->totalService = $totalService;

        return $this;
    }
}
