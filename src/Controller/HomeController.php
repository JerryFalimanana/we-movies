<?php

namespace App\Controller;

use App\Service\ApiTmdb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ApiTmdb $apiTmdb): Response
    {
        $data = $apiTmdb->getData();

        return $this->render('home/index.html.twig', [
            'data' => $data,
        ]);
    }
}