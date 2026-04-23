<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use App\enum\taskstatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $isPinned = null;

    #[ORM\Column(enumType: taskstatus::class)]
    private ?taskstatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function isPinned(): ?bool
    {
        return $this->isPinned;
    }

    public function setIsPinned(bool $isPinned): static
    {
        $this->isPinned = $isPinned;

        return $this;
    }

    public function getStatus(): ?taskstatus
    {
        return $this->status;
    }

    public function setStatus(taskstatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
