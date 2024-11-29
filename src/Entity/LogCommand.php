<?php

namespace App\Entity;

use App\Repository\LogCommandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogCommandRepository::class)]
class LogCommand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $uniqueId = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\Column(nullable: true)]
    private ?array $errors = null;

    #[ORM\Column]
    private ?float $beginAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $endAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): static
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function setErrors(?array $errors): static
    {
        $this->errors = $errors;

        return $this;
    }

    public function getBeginAt(): ?float
    {
        return $this->beginAt;
    }

    public function getBeginAtDate(): ?\DateTimeImmutable
    {
        return $this->beginAt ? (\DateTimeImmutable::createFromFormat('U.u', (string) $this->beginAt) ?: null) : null;
    }

    public function setBeginAt(float $beginAt): static
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getEndAt(): ?float
    {
        return $this->endAt;
    }

    public function getEndAtDate(): ?\DateTimeImmutable
    {
        return $this->endAt ? (\DateTimeImmutable::createFromFormat('U.u', (string) $this->endAt) ?: null) : null;
    }

    public function setEndAt(?float $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
    }
}
