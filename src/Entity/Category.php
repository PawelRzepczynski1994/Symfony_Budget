<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="category.name.not_blank")
     * @Assert\Length(
     *     min = 3,
     *     max = 50,
     *     minMessage = "category.name.min_lenght",
     *     maxMessage = "category.name.max_lenght"
     * )
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Expenses::class, mappedBy="category")
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity=FixedExpenses::class, mappedBy="category")
     */
    private $fixedExpenses;

    public function __construct($id_user,string $name)
    {
        $this->user = $id_user;
        $this->name = $name;
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
            $expense->setCategory($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getCategory() === $this) {
                $expense->setCategory(null);
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
            $fixedExpense->setCategory($this);
        }

        return $this;
    }

    public function removeFixedExpense(FixedExpenses $fixedExpense): self
    {
        if ($this->fixedExpenses->removeElement($fixedExpense)) {
            // set the owning side to null (unless already changed)
            if ($fixedExpense->getCategory() === $this) {
                $fixedExpense->setCategory(null);
            }
        }

        return $this;
    }
}
