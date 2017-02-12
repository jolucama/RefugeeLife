<?php

namespace AppBundle\Controller\api;

use AppBundle\Entity\RefugeeStory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Refugeestory controller.
 *
 * @Route("ios")
 */
class IosApiController extends Controller
{
    /**
     * Creates a new category entity.
     *
     * @Route("/getStory/{id}", name="ios_api_get_story")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $refugeeStory = $em->getRepository('AppBundle:RefugeeStory')->find($id);

        return new JsonResponse($refugeeStory->__sleep());
    }
    
    
}
