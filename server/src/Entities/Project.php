<?php

namespace App\Entities;

class Project extends BaseEntity
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?\DateTimeImmutable $createdAt = null;
    private ?int $owner_id = null;
    private array $users = [];
    private array $expenses = [];

    public function __construct(array $data = [])
    {
        $this->createdAt = new \DateTimeImmutable();

        parent::__construct($data);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Project
     */
    public function setId(?int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Project
     */
    public function setName(?string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Project
     */
    public function setDescription(?string $description): Project
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable|null $createdAt
     * @return Project
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt): Project
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    /**
     * @param int|null $owner_id
     * @return Project
     */
    public function setOwnerId(?int $owner_id): Project
    {
        $this->owner_id = $owner_id;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        if (empty($this->users)) {
            $this->users = $this->getEntityManager()->getRepository(User::class)->findBy(['project' => $this]);
        }
        return $this->users;
    }

    /**
     * @return Expense[]
     */
    public function getExpenses(): array
    {
        if (empty($this->expenses)) {
            $this->expenses = $this->getEntityManager()->getRepository(Expense::class)->findBy(['projectId' => $this->getId()]);
        }
        return $this->expenses;
    }

    public function toArray(): array
    {
        $users = [];
        foreach ($this->getUsers() as $user) {
            $users[] = $user->toArray();
        }
        $expenses = [];
        foreach ($this->getExpenses() as $expense) {
            $expenses[] = $expense->toArray();
        }

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'users' => $users,
            'expenses' => $expenses,
        ];
    }
}
