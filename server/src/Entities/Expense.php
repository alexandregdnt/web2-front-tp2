<?php

namespace App\Entities;

class Expense extends BaseEntity
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $image_url = null;
    private ?\DateTimeImmutable $date = null;
    private ?float $amount = null;
    private ?int $project_id = null;
    private ?int $payer_id = null;
    private array $users = [];
    private ?int $category_id = null;
    private Category $category;

    public function __construct(array $data = [])
    {
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
     * @return Expense
     */
    public function setId(?int $id): Expense
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Expense
     */
    public function setTitle(?string $title): Expense
    {
        $this->title = $title;
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
     * @return Expense
     */
    public function setDescription(?string $description): Expense
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    /**
     * @param string|null $image_url
     * @return Expense
     */
    public function setImageUrl(?string $image_url): Expense
    {
        $this->image_url = $image_url;
        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param \DateTimeImmutable|null $date
     * @return Expense
     */
    public function setDate(?\DateTimeImmutable $date): Expense
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     * @return Expense
     */
    public function setAmount(?float $amount): Expense
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    /**
     * @param int|null $project_id
     * @return Expense
     */
    public function setProjectId(?int $project_id): Expense
    {
        $this->project_id = $project_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPayerId(): ?int
    {
        return $this->payer_id;
    }

    /**
     * @param int|null $payer_id
     * @return Expense
     */
    public function setPayerId(?int $payer_id): Expense
    {
        $this->payer_id = $payer_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    /**
     * @param int|null $category_id
     * @return Expense
     */
    public function setCategoryId(?int $category_id): Expense
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        if (empty($this->category)) {
            $this->category = $this->getCategoryFromDb();
        }
        return $this->category;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        if (empty($this->users)) {
            $this->users = $this->getUsersFromDb();
        }
        return $this->users;
    }

    public function toArray(): array
    {
        $users = [];
        foreach ($this->getUsers() as $user) {
            $users[] = $user->toArray();
        }

        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'image_url' => $this->getImageUrl(),
            'date' => $this->getDate()?->format('Y-m-d'),
            'amount' => $this->getAmount(),
            'project_id' => $this->getProjectId(),
            'payer_id' => $this->getPayerId(),
            'category_id' => $this->getCategoryId(),
            'category' => $this->getCategory()->toArray(),
            'users' => $users,
        ];
    }
}
