<?php

namespace App\Controller;

use App\Entity\PicturePrint;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PictureTrackController extends AbstractController
{
    /**
     * @Route("/pix/{filename}", name="picture_track")
     */
    public function track(Request $request, EntityManagerInterface $em, PictureRepository $pictureRepository)
    {
        $filename = $request->get('filename');

        $picture = $pictureRepository->findOneByFilename($filename);

        if(!$picture) {
            throw $this->createNotFoundException('Picture not found');
        }

        $print = new PicturePrint();
        $print->setDate(new \DateTime());
        $print->setIp($request->getClientIp());
        $print->setUseragent($request->headers->get('User-Agent'));

        $em->persist($print);
        $em->flush();

        $directory = $this->getParameter('kernel.project_dir') . '/' . $this->getParameter('pictures_directory');
        $file = $directory . '/' . $picture->getFilename();
        $response = new BinaryFileResponse($file);

        return $response;
    }
}
