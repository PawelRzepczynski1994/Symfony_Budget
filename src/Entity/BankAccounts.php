<?php

namespace App\Entity;

use App\Repository\BankAccountsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountsRepository::class)
 */
class BankAccounts
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
     * @ORM\Column(type="string", length=255)
     */
    private $bank_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bank_description;

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

    public function getBankName(): ?string
    {
        return $this->bank_name;
    }

    public function setBankName(string $bank_name): self
    {
        $this->bank_name = $bank_name;

        return $this;
    }

    public function getBankDescription(): ?string
    {
        return $this->bank_description;
    }

    public function setBankDescription(?string $bank_description): self
    {
        $this->bank_description = $bank_description;

        return $this;
    }
}
