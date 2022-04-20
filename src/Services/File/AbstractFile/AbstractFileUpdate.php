<?php

namespace App\Services\File\AbstractFile;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class AbstractFileUpdate
{

    //Data
    protected $type;
    protected $originalName;
    protected $fileName;
    protected $file;
    protected $extension;
    protected $folder;
    protected $patch;
    protected $publicFolder = true;

    // Entity
    protected $user;
    protected $entity;

    // Services
    protected $entityManager;
    protected $params;
    protected $request;

    public function __construct(
        EntityManagerInterface $entityManager,
        ParameterBagInterface $params
    ) {
        $this->entityManager = $entityManager;
        $this->params = $params;
    }

    protected function createEntity() {
        $this->entity = new $this->typeClass[$this->type]();
    }

    protected function saveFile() {
        $this->moveFile();
        $this->entityManager->persist($this->entity);
        $this->entityManager->flush();
    }

    protected function moveFile() {
        try {
            $patch = $this->params->get('kernel.project_dir') . $this->folder;
            $this->file->move($patch, $this->fileName);
        } catch (FileException $e) {}
    }

    protected function getExtension() {
        $sections = explode(".", $this->originalName);
        $this->extension = $sections[count($sections) - 1];
    }

    protected function createPatch() {
        $this->folder = date("Y") . '/' . date("m");
        $this->folder = $this->updateFolder[$this->type] . '/' . $this->folder;
        $this->patch = $this->folder . '/' . $this->fileName;
        if ($this->publicFolder) {
            $this->folder = '/public' . $this->folder;
        }
        return $this->patch;
    }

    protected function createFileName()
    {
        $filename = random_int(1, 10000).'-';
        $filename .= time();
        $this->fileName  .= $filename . '.' . $this->extension;
    }

    public function setPrivate(): self
    {
        $this->publicFolder = false;
        return $this;
    }

    public function setData(
        Request $request,
        $user = null
    ): self
    {
        $this->request = $request;
        $this->user = $user;
        $this->file = $request->files->get('file');
        $this->type = $request->get('type');
        $this->originalName = $this->file->getClientOriginalName();
        $this->getExtension();
        $this->createFileName();
        $this->createEntity();
        return $this;
    }

}