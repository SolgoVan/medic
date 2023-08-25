<?php

namespace App\Entity;

use App\Repository\BillsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillsRepository::class)]
class Bills
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'bills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $credit = null;

    #[ORM\ManyToOne(inversedBy: 'bills')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PatientIdentities $debit = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column]
    private ?bool $is_validated = null;

    public function __construct()
    {       
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

    public function getCredit(): ?Users
    {
        return $this->credit;
    }

    public function setCredit(?Users $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    public function getDebit(): ?PatientIdentities
    {
        return $this->debit;
    }

    public function setDebit(?PatientIdentities $debit): static
    {
        $this->debit = $debit;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

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
