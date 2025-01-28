<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface; // Assurez-vous que cette ligne est présente

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

    #[Route('/agence/add', name: 'app_agence_add')]

    public function add(string $name, ?string $type = null, array $options = []):  self
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
              return $this->redirectToRoute('agence'); // Modifier selon ton besoin
          }
        return $this->render('agence/add.html.twig', [
            // 'controller_name' => 'ClasseController',
            'form' => $form->createView(),
        ]);
    }
}
