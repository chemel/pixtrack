<?php

namespace App\Controller;

require_once(__DIR__.'/../../config.php');

use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function index(Request $request): void
    {
        $path = $request->getPathInfo();
        $images = IMAGES_PATH . $path;

        if(file_exists($images) && is_file($images))
        {
            $this->track($request);
            header('Content-Type: '.mime_content_type($images));
            readfile($images);
        } else {
            header('HTTP/1.0 404 Not Found');
        }
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
