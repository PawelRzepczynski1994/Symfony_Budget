<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_parent_category;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=FixedExpenses::class, mappedBy="id_category")
     */
    private $id_fixedExpenses;

    public function __construct(int $id_user,string $name)
    {
        $this->user_id = $id_user;
        $this->name = $name;
        $this->id_fixedExpenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdParentCategory(): ?int
    {
        return $this->id_parent_category;
    }

    public function setIdParentCategory(?int $id_parent_category): self
    {
        $this->id_parent_category = $id_parent_category;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return Collection|FixedExpenses[]
     */
    public function getIdFixedExpenses(): Collection
    {
        return $this->id_fixedExpenses;
    }

    public function addIdFixedExpense(FixedExpenses $idFixedExpense): self
    {
        if (!$this->id_fixedExpenses->contains($idFixedExpense)) {
            $this->id_fixedExpenses[] = $idFixedExpense;
            $idFixedExpense->setIdCategory($this);
        }

        return $this;
    }

    public function removeIdFixedExpense(FixedExpenses $idFixedExpense): self
    {
        if ($this->id_fixedExpenses->removeElement($idFixedExpense)) {
            // set the owning side to null (unless already changed)
            if ($idFixedExpense->getIdCategory() === $this) {
                $idFixedExpense->setIdCategory(null);
            }
        }

        return $this;
    }

}
