<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
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

    public function __construct(int $id_user,string $name)
    {
        $this->id_user = $id_user;
        $this->name = $name;
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
}
