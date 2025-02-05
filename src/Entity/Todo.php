<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TodoRepository::class)
 */
class Todo
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
    private $todo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

   
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $done = false;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="todos")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="todos")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function isDone(): bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTodo(): ?string
    {
        return $this->todo;
    }

    public function setTodo(string $todo): self
    {
        $this->todo = $todo;

        return $this;
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addTodo($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeTodo($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name; // Ou une autre propriété représentative
    }
}
