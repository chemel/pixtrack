<?php

namespace App\Controller;

require_once(__DIR__.'/../../config.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;

class IndexController
{
    public function index(Request $request): Response
    {
        $path = $request->getPathInfo();
        $imagePath = IMAGES_PATH . $path;

        if (!file_exists($imagePath) || !is_file($imagePath)) {
            return new Response('<h1>Not Found</h1><p>The requested URL was not found on this server.</p>', Response::HTTP_NOT_FOUND);
        }

        $this->track($request);

        $file = new File($imagePath);
        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-Type', mime_content_type($imagePath));

        return $response;
    }

    protected function track(Request $request): void
    {
        $date = new \DateTime();
        $file = LOGS_PATH . '/access-' . $date->format('Y-m-d') . '.log';

        $data = [
            'timestamp' => $date->format('Y-m-d H:i:s'),
            'ip' => $request->getClientIp(),
            'path' => $request->getPathInfo(),
            'uri' => $request->getUri(),
            'user_agent' => $request->headers->get('User-Agent'),
        ];

        $fp = fopen($file, 'a');
        fputcsv($fp, $data, ';', '"', '\\');
        fclose($fp);
    }
}
