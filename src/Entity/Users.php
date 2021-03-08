<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $active_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $register_time;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="user", orphanRemoval=true)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Expenses::class, mappedBy="user", orphanRemoval=true)
     */
    private $expenses;

    /**
     * @ORM\OneToMany(targetEntity=PlaceExpenses::class, mappedBy="user", orphanRemoval=true)
     */
    private $placeExpenses;

    /**
     * @ORM\OneToMany(targetEntity=Wallets::class, mappedBy="user", orphanRemoval=true)
     */
    private $wallets;

    /**
     * @ORM\OneToMany(targetEntity=SourceIncome::class, mappedBy="user", orphanRemoval=true)
     */
    private $sourceIncome;

    /**
     * @ORM\OneToMany(targetEntity=FixedExpenses::class, mappedBy="user", orphanRemoval=true)
     */
    private $fixedExpenses;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->expenses = new ArrayCollection();
        $this->placeExpenses = new ArrayCollection();
        $this->wallets = new ArrayCollection();
        $this->sourceIncome = new ArrayCollection();
        $this->fixedExpenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getActiveTime(): ?int
    {
        return $this->active_time;
    }

    public function setActiveTime(?int $active_time): self
    {
        $this->active_time = $active_time;

        return $this;
    }

    public function getRegisterTime(): ?int
    {
        return $this->register_time;
    }

    public function setRegisterTime(int $register_time): self
    {
        $this->register_time = $register_time;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

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
            $expense->setUser($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getUser() === $this) {
                $expense->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlaceExpenses[]
     */
    public function getPlaceExpenses(): Collection
    {
        return $this->placeExpenses;
    }

    public function addPlaceExpense(PlaceExpenses $placeExpense): self
    {
        if (!$this->placeExpenses->contains($placeExpense)) {
            $this->placeExpenses[] = $placeExpense;
            $placeExpense->setUser($this);
        }

        return $this;
    }

    public function removePlaceExpense(PlaceExpenses $placeExpense): self
    {
        if ($this->placeExpenses->removeElement($placeExpense)) {
            // set the owning side to null (unless already changed)
            if ($placeExpense->getUser() === $this) {
                $placeExpense->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wallets[]
     */
    public function getWallets(): Collection
    {
        return $this->wallets;
    }

    public function addWallet(Wallets $wallet): self
    {
        if (!$this->wallets->contains($wallet)) {
            $this->wallets[] = $wallet;
            $wallet->setUser($this);
        }

        return $this;
    }

    public function removeWallet(Wallets $wallet): self
    {
        if ($this->wallets->removeElement($wallet)) {
            // set the owning side to null (unless already changed)
            if ($wallet->getUser() === $this) {
                $wallet->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SourceIncome[]
     */
    public function getSourceIncome(): Collection
    {
        return $this->sourceIncome;
    }

    public function addSourceIncome(SourceIncome $sourceIncome): self
    {
        if (!$this->sourceIncome->contains($sourceIncome)) {
            $this->sourceIncome[] = $sourceIncome;
            $sourceIncome->setUser($this);
        }

        return $this;
    }

    public function removeSourceIncome(SourceIncome $sourceIncome): self
    {
        if ($this->sourceIncome->removeElement($sourceIncome)) {
            // set the owning side to null (unless already changed)
            if ($sourceIncome->getUser() === $this) {
                $sourceIncome->setUser(null);
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
            $fixedExpense->setUser($this);
        }

        return $this;
    }

    public function removeFixedExpense(FixedExpenses $fixedExpense): self
    {
        if ($this->fixedExpenses->removeElement($fixedExpense)) {
            // set the owning side to null (unless already changed)
            if ($fixedExpense->getUser() === $this) {
                $fixedExpense->setUser(null);
            }
        }

        return $this;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
