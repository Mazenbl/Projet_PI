<?php

namespace App\Controller;

use App\Entity\Hopital;
use App\Form\HopitalType;
use App\Repository\HopitalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/hopital')]
class HopitalController extends AbstractController
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    #[Route('/', name: 'app_hopital_index', methods: ['GET'])]
    public function index(HopitalRepository $hopitalRepository): Response
    {
        return $this->render('hopital/index.html.twig', [
            'hopitals' => $hopitalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hopital_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hopital = new Hopital();
        $form = $this->createForm(HopitalType::class, $hopital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $hopital->getImageFile();
            $fileName = $this->generateUniqueFileName($imageFile);
             // Déplacer le fichier téléchargé vers le répertoire de destination
             $imageFile->move(
                $this->getParameter('uploads/images/hopitals'),
                $fileName
            );
            $hopital->setImageName($fileName);
            $entityManager->persist($hopital);
            $entityManager->flush();

            return $this->redirectToRoute('app_hopital_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hopital/new.html.twig', [
            'hopital' => $hopital,
            'form' => $form,
        ]);
    }
    private function generateUniqueFileName(UploadedFile $file): string
    {
        // Générer un nom de fichier unique en fonction du nom original du fichier
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        return $fileName;
    }

    #[Route('/{id}', name: 'app_hopital_show', methods: ['GET'])]
    public function show(Hopital $hopital): Response
    {
        return $this->render('hopital/show.html.twig', [
            'hopital' => $hopital,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hopital_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hopital $hopital, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HopitalType::class, $hopital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hopital_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hopital/edit.html.twig', [
            'hopital' => $hopital,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hopital_delete', methods: ['POST'])]
    public function delete(Request $request, Hopital $hopital, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hopital->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hopital);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hopital_index', [], Response::HTTP_SEE_OTHER);
    }
}
