<?php

namespace App\Entity;

use App\Repository\EndServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EndServiceRepository::class)]
class EndService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'endServices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\OneToOne(inversedBy: 'endService', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?StartService $start = null;

    #[ORM\OneToOne(mappedBy: 'end', cascade: ['persist', 'remove'])]
    private ?TotalService $totalService = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Timer = null;

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

    public function getTotalService(): ?TotalService
    {
        return $this->totalService;
    }

    public function setTotalService(TotalService $totalService): static
    {
        // set the owning side of the relation if necessary
        if ($totalService->getEnd() !== $this) {
            $totalService->setEnd($this);
        }

        $this->totalService = $totalService;

        return $this;
    }

    public function getTimer(): ?\DateTimeInterface
    {
        return $this->Timer;
    }

    public function setTimer(\DateTimeInterface $Timer): static
    {
        $this->Timer = $Timer;

        return $this;
    }
}
