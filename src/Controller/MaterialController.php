<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MaterialController extends AbstractController
{
    #[Route('/materials', name: 'materials')]
    public function index(MaterialRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $mat = new Material();
        $formMat = $this->createForm(MaterialType::class, $mat);
        $formMat->handleRequest($request);
        if ($formMat->isSubmitted() && $formMat->isValid()) {
            $manager->persist($mat);
            $manager->flush();
            return $this->redirectToRoute('materials');
        }


        return $this->render('material/index.html.twig', [
            'materials' => $repo->findAll(),
            'formMat' => $formMat->createView(),
            ]);
    }
}
