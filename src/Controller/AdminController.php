<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController{
    /**
     * @Route("/admin")
     * @Method({"GET","POST"})
     */
    public function index(){
        if (isset($_SESSION['admin_id']))
        {
            return $this->render('views/admin.html.twig');
        }
        else
        {
            return $this->render('views/login.html.twig', array('user' => 'Администратор', 'logged' => FALSE));
        }
        
    }
}