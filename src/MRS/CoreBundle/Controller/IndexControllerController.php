<?php

namespace MRS\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexControllerController extends Controller
{
    /**
     * @Route("/",name="index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('MRSModelBundle:Post')->findAllInOrder();

        return array(
                'posts' => $posts
            );
    }

    /**
     * @Route("/show/{id}",name="show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('MRSModelBundle:Post')->find($id);

        if(!$post){
            throw $this->createNotFoundException('O post não existe! VOlte para home!');
        }

        return array(
                'post' => $post
            );
    }

}
