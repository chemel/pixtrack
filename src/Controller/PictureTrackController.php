<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PictureTrackController extends AbstractController
{
    /**
     * @Route("/pix/{filename}", name="picture_track")
     */
    public function track(string $filename, PictureRepository $pictureRepository)
    {
        $picture = $pictureRepository->findOneByFilename($filename);

        if(!$picture) {
            throw $this->createNotFoundException('Picture not found');
        }

        $file = $this->getPictureDirectory() . '/' . $picture->getFilename();
        $response = new BinaryFileResponse($file);

        return $response;
    }

    /**
     * Get Picture directory
     *
     * @return string $directory
     */
    protected function getPictureDirectory() {
        $directory = $this->getParameter('kernel.project_dir');
        $directory = realpath($directory.'/storage/picture');
        return $directory;
    }
}
