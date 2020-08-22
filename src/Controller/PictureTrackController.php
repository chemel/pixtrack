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

        $directory = $this->getParameter('kernel.project_dir') . '/' . $this->getParameter('pictures_directory');
        $file = $directory . '/' . $picture->getFilename();
        $response = new BinaryFileResponse($file);

        return $response;
    }
}
