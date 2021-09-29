<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Administrator;


class AdminController extends AbstractController{
    /**
     * @Route("/admin", name = "Index")
     * @Method({"GET","POST"})
     */
    public function index(){
        session_start();
        if (isset($_SESSION['admin_id']))
        {
            $username = $this->getDoctrine()->getRepository(Administrator::class)->find($_SESSION['admin_id']);
            return $this->render('views/admin.html.twig',  array('user' => $username->getLogin(), 'logged' => TRUE));
        }
        else
        {
            return $this->render('views/login.html.twig', array('user' => 'Администратор', 'logged' => FALSE));
        }
        
    }

    /**
     * @Route("/new_admin")
     * @Method({"GET","POST"})
     */
    public function setNewAdmin(){
        
        $password = "qwerty";
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $login = "admin2@symfony.com";

        $entityManager = $this->getDoctrine()->getManager();
        
        $admin = new Administrator();
        $admin->setLogin($login);
        $admin->setPassword($hash);

        $entityManager->persist($admin);
        $entityManager->flush();
        
    }

    /**
     * @Route("/admin_login", options={"expose" =true}, name = "AdminLogin")
     * @Method({"GET","POST"})
     */
    public function admin_login(){
        if(isset($_POST['ajax']))
        {
            $validation = TRUE;
            $notification = "";

            $login = $_POST['login'];
            $password = $_POST['password'];

            //начало проверки
            $password_check = $this->getDoctrine()->getRepository(Administrator::class)->findOneBy(['login' => $login]);

            if ($login == "" || $password == "")
            {
                $validation = FALSE;
                $notification .= "Введите все данные";

            } else if (empty($password_check))
                    {
                        $validation = FALSE;
                        $notification .= "Неправильный логин или пароль";
                    }
            elseif (!password_verify($password, $password_check->getPassword()))
            {                
                $validation = FALSE;
                $notification .= "Неправильный логин или пароль";
            }
            else
            {
                session_start();
                $_SESSION['admin_id'] = $password_check->getId();
                return new JsonResponse("1");
            }
            
            if (!$validation) return new JsonResponse(array('code'=> 1, 'msg' => $notification));
        }
    }

    /**
     * @Route("/admin_logout", options={"expose" =true}, name = "AdminLogout")
     * @Method({"GET","POST"})
     */
    public function admin_logout(){
        if(isset($_POST['ajax']))
        {
            session_start();
            session_destroy();

            return new JsonResponse("1");
        }
    }
}
