<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends Controller {
    /**
     * @Route("/debug", name="debugpage")
     */
    public function debugAction(Request $request) {
        $request->getSession()->getFlashBag()->set('error', "Working!");
        $request->getSession()->getFlashBag()->set('warning', "Working!");
        $request->getSession()->getFlashBag()->set('success', "Working!");

        return $this->redirectToRoute("homepage");
    }
}