<?php

namespace App\Entity;

use App\Repository\SourceIncomeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=SourceIncomeRepository::class)
 */
class SourceIncome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank ( message = "sourceincome.name.not_blank" )
     * @Assert\Length
     * (
     *     min = 3,
     *     max = 50,
     *     minMessage = "sourceincome.name.min_lenght",
     *     maxMessage = "sourceincome.name.max_lenght"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length
     * (
     *     max = 255,
     *     maxMessage = "sourceincome.description.max_lenght"
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="sourceIncome")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
}
