<?php

namespace App\Entities;

class ExpenseUser extends BaseEntity
{
    private ?int $id = null;
    private ?int $expenseId = null;
    private ?int $userId = null;
    private ?int $percentage = null;
    private ?float $amount = null;

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
     * @return ExpenseUser
     */
    public function setId(?int $id): ExpenseUser
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpenseId(): ?int
    {
        return $this->expenseId;
    }

    /**
     * @param int|null $expenseId
     * @return ExpenseUser
     */
    public function setExpenseId(?int $expenseId): ExpenseUser
    {
        $this->expenseId = $expenseId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return ExpenseUser
     */
    public function setUserId(?int $userId): ExpenseUser
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    /**
     * @param int|null $percentage
     * @return ExpenseUser
     */
    public function setPercentage(?int $percentage): ExpenseUser
    {
        $this->percentage = $percentage;
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
     * @return ExpenseUser
     */
    public function setAmount(?float $amount): ExpenseUser
    {
        $this->amount = $amount;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'expense_id' => $this->getExpenseId(),
            'user_id' => $this->getUserId(),
            'percentage' => $this->getPercentage(),
            'amount' => $this->getAmount(),
        ];
    }
}
