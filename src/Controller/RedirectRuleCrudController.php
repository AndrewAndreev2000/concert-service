<?php

namespace App\Controller;

use App\Entity\RedirectRule;
use App\Entity\Rule;
use App\Form\RedirectRuleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/redirect-rule')]
class RedirectRuleCrudController extends AbstractController
{
    #[Route('/', name: 'app_redirect_rule_index')]
    public function indexAction(): Response
    {
        return $this->render(
            '@RedirectRuleCrud/index.html.twig',
            [
                'entity_class' => RedirectRule::class,
            ]
        );
    }

    #[Route('/view/{id}', name: 'app_redirect_rule_view', requirements: ['id' => '\d+'])]
    public function viewAction(RedirectRule $redirectRule): Response
    {
        return $this->render(
            '@RedirectRuleCrud/view.html.twig',
            [
                'entity' => $redirectRule,
            ]
        );
    }

    #[Route('/create', name: 'app_redirect_rule_create')]
    public function createAction(Request $request): Response
    {
        $rule = new RedirectRule();
        $form = $this->createForm(RedirectRuleType::class, $rule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_redirect_rule_index');
        }

        return $this->render('@RedirectRuleCrud/create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @return RedirectResponse|array<mixed>
     */
    #[Route('/update/{id}', name: 'app_redirect_rule_update', requirements: ['id' => '\d+'])]
    #[Template]
    public function updateAction(Request $request, Rule $customer): RedirectResponse|array
    {

    }
}
