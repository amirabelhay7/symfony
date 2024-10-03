<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private $authors;
    public function __construct(){
        $this->authors = [

            ['id' => 1, 'picture' => '/image/vh.png', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100],
      
            ['id' => 2, 'picture' => '/image/ws.png', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200],
      
            ['id' => 3, 'picture' => '/image/th.png', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300],
      
          ];

    }
    #[Route('/author', name: 'app_author', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/author/{name}', name: 'app_showAuthor', defaults: ['name'=>'Victor Hugo'], methods:['GET'])]
    public function showAuthor($name): Response
    {
        return $this->render('author/showAuthor.html.twig', [
            'name' => $name
        ]);
    }
    #[Route('/listauthor', name: 'app_listAuthor', methods:['GET'])]
    public function listAuthor(): Response
    {
        return $this->render('author/listAuthor.html.twig', [
            'authors' => $this -> authors
        ]);
    }
    #[Route('/detailsauthor/{id}', name: 'app_detail', methods:['GET'])]
    public function detail(int $id): Response
    {

        // Trouver l'auteur par son ID
        $author = array_filter($this->authors, fn($author) => $author['id'] === $id);

        $author = array_values($author)[0];
        return $this->render('author/detail.html.twig', [
            'author' => $author
        ]);
    }
}
