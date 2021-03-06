<?php

namespace App\Entity;

use App\Repository\FixedExpensesRepository;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "fixedexpenses.name.not_blank")
     * @Assert\Length
     * (
     *      min = 3,
     *      max = 50,
     *      minMessage = "fixedexpenses.name.min_lenght",
     *      maxMessage = "fixedexpenses.name.max_lenght"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $first_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $frequency_payments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "fixedexpenses.description.max_lenght"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=PlaceExpenses::class, inversedBy="fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place_expenses;

    /**
     * @ORM\ManyToOne(targetEntity=Wallets::class, inversedBy="fixedExpenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wallets;

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

    public function getFirstDate(): ?\DateTimeInterface
    {
        return $this->first_date;
    }

    public function setFirstDate(\DateTimeInterface $first_date): self
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

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): self
    {
        $this->active = $active;

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
