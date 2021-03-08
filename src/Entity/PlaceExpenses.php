<?php

namespace App\Entity;

use App\Repository\PlaceExpensesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaceExpensesRepository::class)
 */
class PlaceExpenses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address_2;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $number_phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="placeExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Expenses::class, mappedBy="place_expenses")
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity=FixedExpenses::class, mappedBy="place_expenses")
     */
    private $fixedExpenses;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address_2;
    }

    public function setAddress2(?string $address_2): self
    {
        $this->address_2 = $address_2;

        return $this;
    }

    public function getNumberPhone(): ?string
    {
        return $this->number_phone;
    }

    public function setNumberPhone(?string $number_phone): self
    {
        $this->number_phone = $number_phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
            $expense->setPlaceExpenses($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getPlaceExpenses() === $this) {
                $expense->setPlaceExpenses(null);
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
            $fixedExpense->setPlaceExpenses($this);
        }

        return $this;
    }

    public function removeFixedExpense(FixedExpenses $fixedExpense): self
    {
        if ($this->fixedExpenses->removeElement($fixedExpense)) {
            // set the owning side to null (unless already changed)
            if ($fixedExpense->getPlaceExpenses() === $this) {
                $fixedExpense->setPlaceExpenses(null);
            }
        }

        return $this;
    }
}
