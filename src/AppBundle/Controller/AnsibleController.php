<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\AnsibleService;

class AnsibleController extends Controller {
    /**
     * @Route("/ansible", name="ansiblepage")
     */
    public function ansibleAction(Request $request, AnsibleService $ansible)
    {
        if($request->query->has("ansibleTask")) {
            $ansibleTask = $ansible->sanitizeString($request->get("ansibleTask"));
            $task = $ansible->executeTask($ansibleTask);
            if($task == false) $request->getSession()->getFlashBag()->set("error", "Cannot start task!");
            else $request->getSession()->getFlashBag()->set("success", "Task Started! ");
            // $request->getSession()->getFlashBag()->set('warning', $ansible->executeTask($ansibleTask));
            // return $this->redirectToRoute("homepage");
        }
        return $this->render('ansible/index.html.twig', [
            "ansibleTasks" => $ansible->getAnsibleTasks(),
        ]);
    }
}