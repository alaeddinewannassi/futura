<?php

namespace App\Controller;

use App\Entity\InsuranceGuarantee;
use App\Form\InsuranceGuaranteeType;
use App\Repository\InsuranceGuaranteeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/insurance/guarantee')]
class InsuranceGuaranteeController extends AbstractController
{
    #[Route('/', name: 'app_insurance_guarantee_index', methods: ['GET'])]
    public function index(InsuranceGuaranteeRepository $insuranceGuaranteeRepository): Response
    {
        return $this->render('insurance_guarantee/index.html.twig', [
            'insurance_guarantees' => $insuranceGuaranteeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_insurance_guarantee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $insuranceGuarantee = new InsuranceGuarantee();
        $form = $this->createForm(InsuranceGuaranteeType::class, $insuranceGuarantee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($insuranceGuarantee);
            $entityManager->flush();

            return $this->redirectToRoute('app_insurance_guarantee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insurance_guarantee/new.html.twig', [
            'insurance_guarantee' => $insuranceGuarantee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insurance_guarantee_show', methods: ['GET'])]
    public function show(InsuranceGuarantee $insuranceGuarantee): Response
    {
        return $this->render('insurance_guarantee/show.html.twig', [
            'insurance_guarantee' => $insuranceGuarantee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_insurance_guarantee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InsuranceGuarantee $insuranceGuarantee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InsuranceGuaranteeType::class, $insuranceGuarantee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_insurance_guarantee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('insurance_guarantee/edit.html.twig', [
            'insurance_guarantee' => $insuranceGuarantee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_insurance_guarantee_delete', methods: ['POST'])]
    public function delete(Request $request, InsuranceGuarantee $insuranceGuarantee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$insuranceGuarantee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($insuranceGuarantee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_insurance_guarantee_index', [], Response::HTTP_SEE_OTHER);
    }
}
