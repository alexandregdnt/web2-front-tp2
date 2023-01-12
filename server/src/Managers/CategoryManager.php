<?php

namespace App\Managers;

use App\Entities\Category;
use App\Exceptions\CategoryException;

class CategoryManager extends BaseManager
{
    public function findOne(int $id): Category
    {
        $db = $this->pdo;
        $query = "SELECT * FROM categories WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return new Category($data);
        } else {
            throw new CategoryException("Category not found");
        }
    }

    public function findAll(): array
    {
        $db = $this->pdo;
        $query = "SELECT * FROM categories";
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($data) {
            $categories = [];
            foreach ($data as $row) {
                $categories[] = new Category($row);
            }
            return $categories;
        } else {
            throw new CategoryException("No categories found");
        }
    }

    public function insertOne(Category $category): Category
    {
        try {
            $db = $this->pdo;
            $query = "INSERT INTO categories (name) VALUES (:name)";
            $statement = $db->prepare($query);
            $statement->bindValue(":name", $category->getName());
            $statement->execute();
            $category->setId($db->lastInsertId());
            return $category;
        } catch (\PDOException $e) {
            throw new CategoryException("Category could not be inserted");
        }
    }

    public function updateOne(Category $category): Category
    {
        try {
            $db = $this->pdo;
            $query = "UPDATE categories SET name = :name WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(":name", $category->getName());
            $statement->bindValue(":id", $category->getId());
            $statement->execute();
            return $category;
        } catch (\PDOException $e) {
            throw new CategoryException("Category could not be updated");
        }
    }

    public function deleteOne(Category $category): Category
    {
        try {
            $db = $this->pdo;
            $query = "DELETE FROM categories WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $category->getId());
            $statement->execute();
            return $category;
        } catch (\PDOException $e) {
            throw new CategoryException("Category could not be deleted");
        }
    }
}
