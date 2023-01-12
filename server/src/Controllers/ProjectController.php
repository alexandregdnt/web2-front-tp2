<?php

namespace App\Controllers;

use App\Entities\Project;
use App\Exceptions\ProjectException;
use App\Factories\PDOFactory;
use App\Framework\Entity\BaseController;
use App\Framework\Route\Route;
use App\Helpers\Filters;
use App\Helpers\Tools;
use App\Managers\ProjectManager;
use App\Types\HttpMethods;

class ProjectController extends BaseController
{
    #[Route("/projects", name: "project-list", methods: [HttpMethods::GET])]
    public function list(): void
    {
        try {
            $manager = new ProjectManager(new PDOFactory());
            $projects = $manager->findAll();
            http_response_code(200);
            $this->renderJSON($projects);
        } catch (ProjectException $e) {
            http_response_code(404);
            $this->renderJSON([
                "message" => $e->getMessage()
            ]);
        }
    }

    #[Route("/projects", name: "project-create", methods: [HttpMethods::POST])]
    public function create(): void
    {
        try {
            $project = new Project([
                'name' => Filters::postString('name'),
                'description' => Filters::postString('description'),
                'owner_id' => $this->getUser()->getId(),
            ]);
            $manager = new ProjectManager(new PDOFactory());
            $manager->insertOne($project);
            http_response_code(201);
            $this->renderJSON([
                "message" => "project created"
            ]);
        } catch (ProjectException $e) {
            http_response_code(403);
            $this->renderJSON([
                "message" => "project not created"
            ]);
        }
    }

    #[Route("/projects/{id}", name: "project-show", methods: [HttpMethods::GET])]
    public function show(int $id): void
    {
        try {
            $manager = new ProjectManager(new PDOFactory());
            $project = $manager->findOne($id);
            http_response_code(200);
            $this->renderJSON($project);
        } catch (ProjectException $e) {
            http_response_code(404);
            $this->renderJSON([
                "message" => $e->getMessage()
            ]);
        }
    }

    #[Route("/projects/{id}", name: "project-update", methods: [HttpMethods::PUT])]
    public function update(int $id): void
    {
        try {
            $project = new Project([
                'id' => $id,
                'name' => Filters::postString('name'),
                'description' => Filters::postString('description'),
                'owner_id' => $this->getUser()->getId(),
            ]);
            $manager = new ProjectManager(new PDOFactory());
            $manager->updateOne($project);
            http_response_code(201);
            $this->renderJSON([
                "message" => "project updated"
            ]);
        } catch (ProjectException $e) {
            http_response_code(403);
            $this->renderJSON([
                "message" => "project not updated"
            ]);
        }
    }

    #[Route("/projects/{id}", name: "project-delete", methods: [HttpMethods::DELETE])]
    public function delete(int $id): void
    {
        try {
            $manager = new ProjectManager(new PDOFactory());
            $manager->deleteOne(new Project(['id' => $id]));
            http_response_code(200);
            $this->renderJSON([
                "message" => "project deleted"
            ]);
        } catch (ProjectException $e) {
            http_response_code(400);
            $this->renderJSON([
                "message" => "project not deleted"
            ]);
        }
    }
}
