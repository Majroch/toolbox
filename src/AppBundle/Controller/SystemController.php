<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Service\SystemInfoService;

class SystemController extends Controller
{
    /**
     * @Route("/status", name="systemstatuspage")
     */
    public function statusAction()
    {
        
        return $this->render('system/index.html.twig');
    }

    /**
     * @Route("/status/json", name="systemstatusapi")
     */
    public function statusjsonAction(Request $request, SystemInfoService $sis) {
        
        return new JsonResponse($sis->returnAll());
    }
}
