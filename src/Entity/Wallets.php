<?php

namespace App\Entity;

use App\Repository\WalletsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WalletsRepository::class)
 */
class Wallets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank ( message = "wallets.name.not_blank" )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length
     * (
     *      max = 255,
     *      maxMessage = "wallets.description.max_lenght"
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="wallets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Expenses::class, mappedBy="wallets")
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity=FixedExpenses::class, mappedBy="wallets")
     */
    private $fixedExpenses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bankaccount;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
        $this->fixedExpenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Expenses[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expenses $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setWallets($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getWallets() === $this) {
                $expense->setWallets(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FixedExpenses[]
     */
    public function getFixedExpenses(): Collection
    {
        return $this->fixedExpenses;
    }

    public function addFixedExpense(FixedExpenses $fixedExpense): self
    {
        if (!$this->fixedExpenses->contains($fixedExpense)) {
            $this->fixedExpenses[] = $fixedExpense;
            $fixedExpense->setWallets($this);
        }

        return $this;
    }

    public function removeFixedExpense(FixedExpenses $fixedExpense): self
    {
        if ($this->fixedExpenses->removeElement($fixedExpense)) {
            // set the owning side to null (unless already changed)
            if ($fixedExpense->getWallets() === $this) {
                $fixedExpense->setWallets(null);
            }
        }

        return $this;
    }

    public function getBankaccount(): ?string
    {
        return $this->bankaccount;
    }

    public function setBankaccount(?string $bankaccount): self
    {
        $this->bankaccount = $bankaccount;

        return $this;
    }
}
