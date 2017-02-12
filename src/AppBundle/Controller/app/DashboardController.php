<?php

namespace AppBundle\Controller\app;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('pages/dashboard.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Render Gentelella page.
     *
     * @Route("gentelella/{page}", name="app_gentelella", defaults={"page": "index"})
     *
     * @param Request $request
     * @param string  $page
     *
     * @return Response
     */
    public function gentelellaAction(Request $request, $page)
    {
        $templateName = basename(sprintf('gentelella/%s.html.twig', $page));
        if ($templateName !== sprintf('%s.html.twig', $page)) {
            throw $this->createNotFoundException('Page not found');
        }
        if (!$this->get('templating')->exists(sprintf('gentelella/%s', $templateName))) {
            throw $this->createNotFoundException(
                sprintf(
                    'Page "%s" not found',
                    $page
                )
            );
        }
        return $this->render(sprintf('gentelella/%s.html.twig', $page));
    }
}
