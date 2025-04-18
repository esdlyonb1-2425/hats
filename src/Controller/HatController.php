<?php

namespace App\Controller;

use App\Entity\Hat;
use App\Entity\Image;
use App\Form\HatType;
use App\Form\ImageType;
use App\Repository\HatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HatController extends AbstractController
{
    #[Route('/hats', name: 'app_hats')]
    public function index(HatRepository $repo): Response
    {
        return $this->render('hat/index.html.twig', [
            'hats'=>$repo->findAll(),
        ]);
    }

    #[Route('/hats/{id}', name: 'app_hat')]
    public function show(Hat $hat): Response
    {
        return $this->render('hat/show.html.twig', [
            'hat'=>$hat,
        ]);
    }

    #[Route('/hat/create', name: 'create_hat')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $hat = new Hat();
        $form = $this->createForm(HatType::class, $hat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($hat);
            $manager->flush();
            return $this->redirectToRoute('app_hats');

        }
        return $this->render('hat/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/hat/addimage/{id}', name: 'image_hat')]
    public function addImage(Hat $hat, Request $request, EntityManagerInterface $manager): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image->setHat($hat);
            $manager->persist($image);
            $manager->flush();
            return $this->redirectToRoute('app_hats');
        }
        return $this->render('hat/addimage.html.twig', [
            'form' => $form->createView(),

        ]);
    }

}
