<?php


namespace App\Controller;

use App\Entity\Showw;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("shows/{id}/favorite",name="show_favorite")
     */
    public function favorite(Showw $showw, EntityManagerInterface $entityManager)
    {
        if ($this->getUser()->getShoww()->contains($showw)) {
            $this->getUser()->removeShoww($showw);
        } else {
            $this->getUser()->addShoww($showw);
        }
        $entityManager->flush();

        $this->addFlash('Success', 'Bien ajouté au panier !');

        return $this->json(
            [
                'isFav' => $this->getUser()->isFavoriteShow($showw)
            ]
        );
    }
}
