<?php

namespace App\Entity;

use App\Enum\StatusEnum;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $Title = null;

    #[ORM\Column]
    private ?bool $IsPinned = null;

    #[ORM\Column(enumType: StatusEnum::class)]
    private ?StatusEnum $StatusEnum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function isPinned(): ?bool
    {
        return $this->IsPinned;
    }

    public function setIsPinned(bool $IsPinned): static
    {
        $this->IsPinned = $IsPinned;

        return $this;
    }

    public function getStatusEnum(): ?StatusEnum
    {
        return $this->StatusEnum;
    }

    public function setStatusEnum(StatusEnum $StatusEnum): static
    {
        $this->StatusEnum = $StatusEnum;

        return $this;
    }
}
