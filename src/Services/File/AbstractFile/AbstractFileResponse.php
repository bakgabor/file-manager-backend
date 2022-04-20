<?php

namespace App\Services\File\AbstractFile;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AbstractFileResponse
{

    // Services
    private $entityManager;

    // Data
    private $kernelDir;
    private $id;
    private $user;
    private $type;
    private $entity;

    protected $response;

    public function __construct(
        EntityManagerInterface $entityManager,
        ParameterBagInterface $params
    ) {
        $this->entityManager = $entityManager;
        $this->kernelDir =  $params->get('kernel.project_dir');
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    protected function createResponse() {
        $path = $this->kernelDir . '/public/' . $this->entity->getPath();
        $this->response = new BinaryFileResponse($path);
        $this->response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $this->entity->getOriginalName()
        );
    }

    protected function checkUser() {
        if (!$this->user || $this->fileUser->getId() != $this->user->getId()) {
            throw new NotFoundHttpException('File not found.');
        }
    }

    protected function loadEntity() {
        $this->entity = $this->entityManager
            ->getRepository($this->typeClass[$this->type])
            ->find($this->id);
        if (!$this->entity) {
            throw new NotFoundHttpException('File not found.');
        }
    }

}