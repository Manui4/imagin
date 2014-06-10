<?php

namespace Man\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use JMS\SecurityExtraBundle\Annotation\Secure;

class DashboardController extends Controller
{
    /**
     * @Route("/admin", name="man_admin_dashboard")
     * @Template()
     * @Method({"GET", "HEAD"})
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        return $this->render('ManAdminBundle:Dashboard:index.html.twig', array(
            'contentInfo' => [
                ['name' => 'articles','nb'=>12],
                ['name' => 'commentaires','nb'=>15],
            ]
        ));
    }
}
