<?php

namespace App\Services\File;

use App\Entity\Files\File;
use App\Entity\Files\Images;
use App\Entity\Files\PrivateFile;
use App\Entity\Files\SimpleFile;
use App\Services\File\AbstractFile\AbstractFileUpdate;

class FileUpdate extends AbstractFileUpdate
{

    protected $typeClass = [
        'file' => File::class,
        'image' => Images::class,
        'simple' => SimpleFile::class,
    ];

    protected $updateFolder = [
        'file' => '/uploads/files',
        'image' => '/uploads/images',
        'simple' => '/uploads/simple',
    ];

    public function updateFile() {
        $this->entity->setTitle($this->request->get('title'))
            ->setPath($this->createPatch())
            ->setMimeType($this->file->getMimeType())
            ->setOriginalName($this->originalName)
            ->setDescription($this->request->get('description'))
            ->setKeywords($this->request->get('keywords'));

        $this->saveFile();
        return $this->entity;
    }

    public function updateSimpleFile() {
        $this->entity->setPath($this->createPatch())
            ->setMimeType($this->file->getMimeType())
            ->setOriginalName($this->originalName);

        $this->saveFile();
        return $this->entity;
    }

}