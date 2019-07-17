<?php


namespace App\Controller;


use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Showw;
use App\Repository\ShowwRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ShowController extends AbstractController


{

    /**
     * @Route("/shows", name="all_shows")
     */

    public function index(Request $request, ShowwRepository $repository): Response
    {
        $shows = $repository->findAll();

        return $this->render('shows.html.twig', array(
            'shows' => $shows,
        ));
    }

    /**
     * @Route("shows/detail/{id}", name="detail_show"))
     */
    public function getOneShow(ShowwRepository $repository, Showw $showw): Response
    {
        $show = $repository->findOneBy(array(
            'id' => $showw->getId(),
            'detail_picture1' => $showw->getDetailPicture1(),
            'detail_picture2' => $showw->getDetailPicture2(),
            'detail_picture3' => $showw->getDetailPicture3(),
            'detail_picture4' => $showw->getDetailPicture4()
        ));
        $shows = $repository->findAll();

        return $this->render('show.html.twig', array(
            'showw' => $show,
            'shows' => $shows
        ));

    }
}