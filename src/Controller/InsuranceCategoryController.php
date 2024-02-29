<?php

namespace App\Controller;

use App\Entity\InsuranceCategory;
use App\Form\InsuranceCategoryType;
use App\Repository\InsuranceCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/insurance/category')]
class InsuranceCategoryController extends AbstractController
{
    #[Route('/', name: 'app_insurance_category_index', methods: ['GET'])]
    public function index(InsuranceCategoryRepository $insuranceCategoryRepository): Response
    {
        return $this->render('insurance_category/index.html.twig', [
            'insurance_categories' => $insuranceCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_insurance_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $insuranceCategory = new InsuranceCategory();
        $form = $this->createForm(InsuranceCategoryType::class, $insuranceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($insuranceCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_insurance_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insurance_category/new.html.twig', [
            'insurance_category' => $insuranceCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insurance_category_show', methods: ['GET'])]
    public function show(InsuranceCategory $insuranceCategory): Response
    {
        return $this->render('insurance_category/show.html.twig', [
            'insurance_category' => $insuranceCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_insurance_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InsuranceCategory $insuranceCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InsuranceCategoryType::class, $insuranceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_insurance_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insurance_category/edit.html.twig', [
            'insurance_category' => $insuranceCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insurance_category_delete', methods: ['POST'])]
    public function delete(Request $request, InsuranceCategory $insuranceCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$insuranceCategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($insuranceCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_insurance_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
