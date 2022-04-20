<?php

namespace App\Services\File;

use App\Entity\Files\File;
use App\Entity\Files\Images;
use App\Entity\Files\SimpleFile;
use App\Services\File\AbstractFile\AbstractFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileResponse extends AbstractFileResponse
{

    protected $typeClass = [
        'file' => File::class,
        'image' => Images::class,
        'simple' => SimpleFile::class,
    ];

    public function create() {
        try {
            $this->loadEntity();
            $this->createResponse();
            return $this->response;
        } catch (FileException $e) {
            throw new NotFoundHttpException('File not found.');
        }
    }

}