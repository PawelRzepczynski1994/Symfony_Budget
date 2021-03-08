<?php

namespace App\Entity;

use App\Repository\ExpensesRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpensesRepository::class)
 */
class Expenses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length
     * (
     *      max = 255,
     *      maxMessage = "expenses.description.max_lenght"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=PlaceExpenses::class, inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place_expenses;

    /**
     * @ORM\ManyToOne(targetEntity=Wallets::class, inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wallets;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

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

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPlaceExpenses(): ?placeexpenses
    {
        return $this->place_expenses;
    }

    public function setPlaceExpenses(?placeexpenses $place_expenses): self
    {
        $this->place_expenses = $place_expenses;

        return $this;
    }

    public function getWallets(): ?wallets
    {
        return $this->wallets;
    }

    public function setWallets(?wallets $wallets): self
    {
        $this->wallets = $wallets;

        return $this;
    }
}
