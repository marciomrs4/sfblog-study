<?php

namespace MRS\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexControllerController extends Controller
{
    /**
     * @Route("/",name="index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('MRSModelBundle:Post')->findAllInOrder();


        $paginator = $this->get('knp_paginator')->paginate($posts, $request->query->get('page', 1), 3);

        return array(
                'pagination' => $paginator
            );

/*        return array(
                'posts' => $posts
            );*/
    }

    /**
     * @Route("/show/{slug}",name="show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('MRSModelBundle:Post')->findOneBy(['slug' => $slug]);

        if(!$post){
            throw $this->createNotFoundException('O post não existe! Volte para home!');
        }

        return array(
                'post' => $post
            );
    }

}
