<?php

namespace App\Entity;

use App\Repository\ExpensesRepository;
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
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_category;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_place_expenses;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_wallet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $amount;

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

    public function getIdCategory(): ?int
    {
        return $this->id_category;
    }

    public function setIdCategory(int $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdPlaceExpenses(): ?int
    {
        return $this->id_place_expenses;
    }

    public function setIdPlaceExpenses(int $id_place_expenses): self
    {
        $this->id_place_expenses = $id_place_expenses;

        return $this;
    }

    public function getIdWallet(): ?int
    {
        return $this->id_wallet;
    }

    public function setIdWallet(int $id_wallet): self
    {
        $this->id_wallet = $id_wallet;

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
}
