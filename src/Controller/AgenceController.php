<?php

namespace App\Controller;

use App\Repository\AgenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AgenceController extends AbstractController
{
    #[Route('/agence/liste', name: 'app_agence_liste')]
    public function ShowAgence(AgenceRepository $AgenceRepository,Request $request): Response
    {
                /* Pagination */
                $totalElement=$AgenceRepository->count();
                $page=$request->query->getInt('page',1); //default value ('page',1)
                $nombreElementParPage=4;

                $offset=($page-1)*$nombreElementParPage; 
                $datas=$AgenceRepository->findBy([],["id"=>"asc"],$nombreElementParPage,$offset);
                $nbrePage=ceil($totalElement/$nombreElementParPage);
        // $datas=$AgenceRepository->findAll();
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
            'datas'=>$datas,
            'nbrePage'=>$nbrePage,
            'pageAcive'=>$page,
        ]);
    }
}
