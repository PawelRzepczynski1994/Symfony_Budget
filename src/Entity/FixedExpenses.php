<?php

namespace App\Entity;

use App\Repository\FixedExpensesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FixedExpensesRepository::class)
 */
class FixedExpenses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $first_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $frequency_payments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="id_fixedExpenses")
     */
    private $id_category;

    /**
     * @ORM\ManyToOne(targetEntity=PlaceExpenses::class, inversedBy="id_fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_places_expenses;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Wallets;

    /**
     * @ORM\ManyToOne(targetEntity=Wallets::class, inversedBy="id_fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_wallet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getFirstDate(): ?\DateTime
    {
        return $this->first_date;
    }

    public function setFirstDate(\DateTime $first_date): self
    {
        $this->first_date = $first_date;

        return $this;
    }

    public function getFrequencyPayments(): ?int
    {
        return $this->frequency_payments;
    }

    public function setFrequencyPayments(int $frequency_payments): self
    {
        $this->frequency_payments = $frequency_payments;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
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

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdPlacesExpenses(): ?PlaceExpenses
    {
        return $this->id_places_expenses;
    }

    public function setIdPlacesExpenses(?PlaceExpenses $id_places_expenses): self
    {
        $this->id_places_expenses = $id_places_expenses;

        return $this;
    }

    public function getWallets(): ?string
    {
        return $this->Wallets;
    }

    public function setWallets(string $Wallets): self
    {
        $this->Wallets = $Wallets;

        return $this;
    }

    public function getIdWallet(): ?Wallets
    {
        return $this->id_wallet;
    }

    public function setIdWallet(?Wallets $id_wallet): self
    {
        $this->id_wallet = $id_wallet;

        return $this;
    }
}
