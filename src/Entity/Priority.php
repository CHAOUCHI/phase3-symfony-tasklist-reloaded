<?php

namespace App\Entity;

use App\Repository\PriorityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriorityRepository::class)]
class Priority
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   
    #[ORM\Column]
    private ?int $importance = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'priorities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $priority = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'priority')]
    private Collection $priorities;

    public function __construct()
    {
        $this->priorities = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getImportance(): ?int
    {
        return $this->importance;
    }

    public function setImportance(int $importance): static
    {
        $this->importance = $importance;

        return $this;
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

    public function getPriority(): ?self
    {
        return $this->priority;
    }

    public function setPriority(?self $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPriorities(): Collection
    {
        return $this->priorities;
    }

    public function addPriority(self $priority): static
    {
        if (!$this->priorities->contains($priority)) {
            $this->priorities->add($priority);
            $priority->setPriority($this);
        }

        return $this;
    }

    public function removePriority(self $priority): static
    {
        if ($this->priorities->removeElement($priority)) {
            // set the owning side to null (unless already changed)
            if ($priority->getPriority() === $this) {
                $priority->setPriority(null);
            }
        }

        return $this;
    }
}
