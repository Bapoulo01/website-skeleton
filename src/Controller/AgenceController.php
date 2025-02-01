<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Dto\AgenceSearchDto;
use App\Form\AgenceSearchType;
use App\Repository\AgenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface; 

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
                $agenceSearchDto = new AgenceSearchDto();
                $formSearchAgence=$this->createForm(AgenceSearchType::class,$agenceSearchDto);

                
        $formSearchAgence->handleRequest($request);
        $filtre=[];
        if ($formSearchAgence->isSubmitted()) {
            //critere de filtre
            $filtre=[
                'Telephone'=>$agenceSearchDto->getTelephone(),
                'Adresse'=>$agenceSearchDto->getAdresse(),
            ];
        }
        $datas=$AgenceRepository->findBy($filtre,["id"=>"asc"],$nombreElementParPage,$offset);
        // $datas=$AgenceRepository->findAll();
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
            'datas'=>$datas,
            'nbrePage'=>$nbrePage,
            'pageAcive'=>$page,
            'formSearchAgence' => $formSearchAgence->createView(),

        ]);
    }

    #[Route('/agence/add', name: 'app_agence_add')]

    public function add(Request $request,EntityManagerInterface $manager):Response
    {

      $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
          // Gérer la soumission du formulaire
          $form->handleRequest($request);
        //   dd($form);
          if ($form->isSubmitted() && $form->isValid()) {
                $agence = $form->getData();
                // dd($classe);
                $manager->persist($agence);
                $manager->flush();
                $this->addFlash('success', 'Classe ajoutée avec succcess!');
  
              // Redirection après la soumission
              return $this->redirectToRoute('agence');
          }
        return $this->render('agence/add.html.twig', [
            // 'controller_name' => 'ClasseController',
            'form' => $form->createView(),
        ]);
    }
}
