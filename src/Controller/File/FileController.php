<?php

namespace App\Controller\File;

use App\Entity\Files\File;
use App\Services\File\FileList;
use App\Services\File\FileResponse;
use App\Services\File\FileUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{

    /**
     * Matches /api/file/save exactly
     *
     * @Route("/api/file/save", methods={"POST"}, name="file-save")
     */
    public function save(
        Request $request,
        FileUpdate $fileUpdate
    ) {
        if ($request->get('type') == 'simple') {
            $file = $fileUpdate->setData($request)->updateSimpleFile();
            return $this->json($file);
        }
        $file = $fileUpdate->setData($request)->updateFile();
        return $this->json($file);
    }

    /**
     * Matches /{type}/download/{id} exactly
     *
     * @Route("/{type}/download/{id}", methods={"GET"}, name="file-open-private")
     */
    public function createDownload(
        FileResponse $fileResponse,
        $id,
        $type
    ) {
        $response = $fileResponse->setType($type)->setId($id)->create();

        if (!$response) {
            throw $this->createNotFoundException('File not found.');
        }
        return $response;
    }

    /**
     * Matches /api/file/list exactly
     *
     * @Route("/api/file/list/{page}", methods={"GET"}, name="public-file-list")
     */
    public function fileList(
        $page,
        FileList $fileList
    ) {
        $files = $fileList->loadRepository(File::class)->getFiles($page);
        return $this->json($files);
    }


    /**
     * Matches /api/file/search exactly
     *
     * @Route("/api/file/search/{page}/{text}", methods={"GET"}, name="searcg-file")
     */
    public function searchPublicFile(
        $text,
        $page,
        FileList $fileList
    ) {
        $text = base64_decode($text);
        $files = $fileList->loadRepository(File::class)->search($page, $text);
        return $this->json($files);
    }

    /**
     * Matches /api/{type}/data/{id} exactly
     *
     * @Route("/api/{type}/data/{id}", methods={"GET"}, name="public-file-data")
     */
    public function getFile($id, $type) {
        $entityManager = $this->getDoctrine();
        $files = $entityManager->getRepository(File::class)->find($id);
        return $this->json($files);
    }

}