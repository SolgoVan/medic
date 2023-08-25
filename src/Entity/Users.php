<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\New_;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $birth_date = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $sent;

    #[ORM\OneToMany(mappedBy: 'recipient', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $received;

    #[ORM\Column]
    private ?bool $is_valid_account = false;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name:'job_grades_id', referencedColumnName:'id')]
    private ?JobGrades $job_grades = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $is_working = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: StartService::class)]
    private Collection $startServices;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EndService::class)]
    private Collection $endServices;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TotalService::class)]
    private Collection $totalServices;

    #[ORM\OneToMany(mappedBy: 'practitioner', targetEntity: Consultations::class, orphanRemoval: true)]
    private Collection $consultations;

    #[ORM\OneToMany(mappedBy: 'credit', targetEntity: Bills::class)]
    private Collection $bills;

    #[ORM\OneToMany(mappedBy: 'created_by', targetEntity: Patients::class, orphanRemoval: true)]
    private Collection $patients;

    public function __construct()
    {
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
        $this->startServices = new ArrayCollection();
        $this->endServices = new ArrayCollection();
        $this->totalServices = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->bills = new ArrayCollection();
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeImmutable $birth_date): static
    {
        $this->birth_date = $birth_date;

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
     * @return Collection<int, Messages>
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Messages $sent): static
    {
        if (!$this->sent->contains($sent)) {
            $this->sent->add($sent);
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Messages $sent): static
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Messages $received): static
    {
        if (!$this->received->contains($received)) {
            $this->received->add($received);
            $received->setRecipient($this);
        }

        return $this;
    }

    public function removeReceived(Messages $received): static
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecipient() === $this) {
                $received->setRecipient(null);
            }
        }

        return $this;
    }

    public function isIsValidAccount(): ?bool
    {
        return $this->is_valid_account;
    }

    public function setIsValidAccount(bool $is_valid_account): static
    {
        $this->is_valid_account = $is_valid_account;

        return $this;
    }

    public function getJobGrades(): ?JobGrades
    {
        return $this->job_grades;
    }

    public function setJobGrades(?JobGrades $job_grades): static
    {
        $this->job_grades = $job_grades;

        return $this;
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

    public function isIsWorking(): ?bool
    {
        return $this->is_working;
    }

    public function setIsWorking(bool $is_working): static
    {
        $this->is_working = $is_working;

        return $this;
    }

    /**
     * @return Collection<int, StartService>
     */
    public function getStartServices(): Collection
    {
        return $this->startServices;
    }

    public function addStartService(StartService $startService): static
    {
        if (!$this->startServices->contains($startService)) {
            $this->startServices->add($startService);
            $startService->setUser($this);
        }

        return $this;
    }

    public function removeStartService(StartService $startService): static
    {
        if ($this->startServices->removeElement($startService)) {
            // set the owning side to null (unless already changed)
            if ($startService->getUser() === $this) {
                $startService->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EndService>
     */
    public function getEndServices(): Collection
    {
        return $this->endServices;
    }

    public function addEndService(EndService $endService): static
    {
        if (!$this->endServices->contains($endService)) {
            $this->endServices->add($endService);
            $endService->setUser($this);
        }

        return $this;
    }

    public function removeEndService(EndService $endService): static
    {
        if ($this->endServices->removeElement($endService)) {
            // set the owning side to null (unless already changed)
            if ($endService->getUser() === $this) {
                $endService->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TotalService>
     */
    public function getTotalServices(): Collection
    {
        return $this->totalServices;
    }

    public function addTotalService(TotalService $totalService): static
    {
        if (!$this->totalServices->contains($totalService)) {
            $this->totalServices->add($totalService);
            $totalService->setUser($this);
        }

        return $this;
    }

    public function removeTotalService(TotalService $totalService): static
    {
        if ($this->totalServices->removeElement($totalService)) {
            // set the owning side to null (unless already changed)
            if ($totalService->getUser() === $this) {
                $totalService->setUser(null);
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
            $consultation->setPractitioner($this);
        }

        return $this;
    }

    public function removeConsultation(Consultations $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getPractitioner() === $this) {
                $consultation->setPractitioner(null);
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
            $bill->setCredit($this);
        }

        return $this;
    }

    public function removeBill(Bills $bill): static
    {
        if ($this->bills->removeElement($bill)) {
            // set the owning side to null (unless already changed)
            if ($bill->getCredit() === $this) {
                $bill->setCredit(null);
            }
        }

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
            $patient->setCreatedBy($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getCreatedBy() === $this) {
                $patient->setCreatedBy(null);
            }
        }

        return $this;
    }
}
