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
        $genre = $apiTmdb->getGenre()['genres'];
        $topRated = $apiTmdb->getTopRated()['results'];
        $topRatedVideo = $apiTmdb->getMovie($topRated[0]['id'])['results'][0];
        $video['site'] = $topRatedVideo['site'];
        $video['link'] = 'https://www.youtube.com/embed/' . $topRatedVideo['key'];

        return $this->render('home/index.html.twig', [
            'genres' => $genre,
            'topMovies' => $topRated,
            'topRatedVideo' => $video,
        ]);
    }
}
