<?php

namespace App\Controller\File;

use App\Entity\Files\Images;
use App\Services\File\FileList;
use App\Services\File\FileUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{

    /**
     * Matches /api/image/list/{page} exactly
     *
     * @Route("/api/image/list/{page}", methods={"GET"}, name="public-images-list")
     */
    public function fileList(
        $page,
        FileList $fileList
    ) {
        $files = $fileList->loadRepository(Images::class)->getFiles($page);
        return $this->json($files);
    }


    /**
     * Matches /api/image/data/{id} exactly
     *
     * @Route("/api/image/data/{id}", methods={"GET"}, name="public-images-data")
     */
    public function getFile($id) {
        $entityManager = $this->getDoctrine();
        $files = $entityManager->getRepository(Images::class)->find($id);
        return $this->json($files);
    }

}