<?php

namespace App\Managers;

use App\Entities\Expense;
use App\Exceptions\ExpenseException;

class ExpenseManager extends BaseManager
{
    public function findOne(int $id): Expense
    {
        $db = $this->pdo;
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return new Expense($data);
        } else {
            throw new ExpenseException("Expense not found");
        }
    }

    public function findAll(): array
    {
        $db = $this->pdo;
        $query = "SELECT * FROM expenses";
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($data) {
            $expenses = [];
            foreach ($data as $expense) {
                $expenses[] = new Expense($expense);
            }
            return $expenses;
        } else {
            throw new ExpenseException("No expenses found");
        }
    }

    public function insertOne(Expense $expense): Expense
    {
        try {
            $db = $this->pdo;
            $query = "INSERT INTO expenses (title, description, image_url, date, amount, project_id, payer_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $statement = $db->prepare($query);
            $statement->execute(array(
                $expense->getTitle(),
                $expense->getDescription(),
                $expense->getImageUrl(),
                $expense->getDate(),
                $expense->getAmount(),
                $expense->getProjectId(),
                $expense->getPayerId(),
                $expense->getCategoryId()
            ));
            $expense->setId($db->lastInsertId());
            return $expense;
        } catch (\PDOException $e) {
            throw new ExpenseException("Error inserting expense");
        }
    }

    public function updateOne(Expense $expense): Expense
    {
        try {
            $db = $this->pdo;
            $query = "UPDATE expenses SET title = ?, description = ?, image_url = ?, date = ?, amount = ?, project_id = ?, payer_id = ?, category_id = ? WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->execute(array(
                $expense->getTitle(),
                $expense->getDescription(),
                $expense->getImageUrl(),
                $expense->getDate(),
                $expense->getAmount(),
                $expense->getProjectId(),
                $expense->getPayerId(),
                $expense->getCategoryId(),
                $expense->getId()
            ));
            return $expense;
        } catch (\PDOException $e) {
            throw new ExpenseException("Error updating expense");
        }
    }

    public function deleteOne(Expense $expense): void
    {
        try {
            $db = $this->pdo;
            $query = "DELETE FROM expenses WHERE id = ?";
            $statement = $db->prepare($query);
            $statement->execute(array($expense->getId()));
        } catch (\PDOException $e) {
            throw new ExpenseException("Error deleting expense");
        }
    }
}
