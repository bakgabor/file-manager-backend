<?php

namespace App\Controller\File;

use App\Entity\Files\Images;
use App\Entity\Files\SimpleFile;
use App\Services\File\FileList;
use App\Services\File\FileUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SimpleFileController extends AbstractController
{

    /**
     * Matches /api/simple/list/{page} exactly
     *
     * @Route("/api/simple/list/{page}", methods={"GET"}, name="public-simple-list")
     */
    public function fileList(
        $page,
        FileList $fileList
    ) {
        $files = $fileList->loadRepository(SimpleFile::class)->getFiles($page);
        return $this->json($files);
    }


    /**
     * Matches /api/simple/data/{id} exactly
     *
     * @Route("/api/simple/data/{id}", methods={"GET"}, name="public-simple-data")
     */
    public function getFile($id) {
        $entityManager = $this->getDoctrine();
        $files = $entityManager->getRepository(SimpleFile::class)->find($id);
        return $this->json($files);
    }

}