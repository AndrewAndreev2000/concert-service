<?php

namespace App\Controller;

use App\Entity\Rule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rule')]
class RuleCrudController extends AbstractController
{
    #[Route('/', name: 'app_rule_index')]
    public function indexAction(): Response
    {
        return $this->render(
            '@RuleCrud/index.html.twig',
            [
                'entity_class' => Rule::class,
            ]
        );
    }

    #[Route('/view/{id}', name: 'app_rule_view', requirements: ['id' => '\d+'])]
    public function viewAction(Rule $rule): Response
    {
        return $this->render(
            '@Rule/RuleCrud/view.html.twig',
            [
                'entity' => $rule,
            ]
        );
    }

    #[Route('/create', name: 'app_rule_create')]
    #[Template('@Rule/RuleCrud/update.html.twig')]
    public function createAction(Request $request): Response|array
    {
        $rule = new Rule();
    }

    /**
     * @return RedirectResponse|array<mixed>
     */
    #[Route('/update/{id}', name: 'app_rule_update', requirements: ['id' => '\d+'])]
    #[Template]
    public function updateAction(Request $request, Rule $customer): RedirectResponse|array
    {

    }
}
