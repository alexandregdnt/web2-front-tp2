<?php

namespace App\Managers;

use App\Entities\Expense;
use App\Entities\Project;
use App\Entities\User;
use App\Exceptions\ProjectException;

class ProjectManager extends BaseManager
{
    /**
     * @param int $id
     * @return Project
     * @throws ProjectException
     */
    public function findOne(int $id): Project
    {
        $db = $this->pdo;
        $query = "SELECT * FROM projects WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($data) {
            return new Project($data);
        } else {
            throw new ProjectException("Project not found");
        }
    }

    /**
     * @return Project[]
     * @throws ProjectException
     */
    public function findAll(): array
    {
        $db = $this->pdo;
        $query = "SELECT * FROM projects";
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($data) {
            $projects = [];
            foreach ($data as $project) {
                $projects[] = new Project($project);
            }
            return $projects;
        } else {
            throw new ProjectException("No projects found");
        }
    }

    /**
     * @param Project $project
     * @return Project
     * @throws ProjectException
     */
    public function insertOne(Project $project): Project
    {
        try {
            $db = $this->pdo;
            $query = "INSERT INTO projects (name, description, created_at) VALUES (:name, :description, :created_at)";
            $statement = $db->prepare($query);
            $statement->bindValue(":name", $project->getName());
            $statement->bindValue(":description", $project->getDescription());
            $statement->bindValue(":created_at", $project->getCreatedAt());
            $statement->execute();
            $project->setId($db->lastInsertId());
            return $project;
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new ProjectException("Email or username already exists");
            } else {
                throw new ProjectException($e->getMessage());
            }
        }
    }

    /**
     * @param Project $project
     * @return Project
     * @throws ProjectException
     */
    public function updateOne(Project $project): Project
    {
        try {
            $db = $this->pdo;
            $query = "UPDATE projects SET name = :name, description = :description WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(":name", $project->getName());
            $statement->bindValue(":description", $project->getDescription());
            $statement->bindValue(":id", $project->getId());
            $statement->execute();
            return $project;
        } catch (\PDOException $e) {
            throw new ProjectException("Project not found");
        }
    }

    /**
     * @param Project $project
     * @return void
     * @throws ProjectException
     */
    public function deleteOne(Project $project): void
    {
        try {
            $db = $this->pdo;
            $query = "DELETE FROM projects WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(":id", $project->getId());
            $statement->execute();
        } catch (\PDOException $e) {
            throw new ProjectException("Project could not be deleted");
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws ProjectException
     */
    public function findProjectUsers(int $id): array
    {
        $db = $this->pdo;
        $query = "SELECT * FROM users WHERE id IN (SELECT user_id FROM project_users WHERE project_id = :id)";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($data) {
            $users = [];
            foreach ($data as $user) {
                $users[] = new User($user);
            }
            return $users;
        } else {
            throw new ProjectException("No users found");
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws ProjectException
     */
    public function findProjectExpenses(int $id): array
    {
        $db = $this->pdo;
        $query = "SELECT * FROM expenses WHERE project_id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($data) {
            $expenses = [];
            foreach ($data as $expense) {
                $expenses[] = new Expense($expense);
            }
            return $expenses;
        } else {
            throw new ProjectException("No expenses found");
        }
    }
}
