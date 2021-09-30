<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Connection;
use App\Entity\Administrator;
use App\Entity\User;
use App\Entity\Shape;
use App\Entity\Color;
use App\Entity\Image;

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
     * @Route("/new_admin" , options={"expose" =true}, name = "SaveNewAdmin")
     * @Method({"GET","POST"})
     */
    public function setNewAdmin(){
        if(isset($_POST['ajax']))
        {
            $validation = TRUE;
            $notification = "";
            $password = $_POST['password'];
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $login = $_POST['login'];
            $check_login = $this->getDoctrine()->getRepository(Administrator::class)->findOneBy(['login' => $login]);

            if (!empty($check_login))
                {
                    $validation = FALSE;
                    $notification = "Логин уже зарегистрирован";
                }
            
            if($validation)
            {
                $entityManager = $this->getDoctrine()->getManager();
            
            $admin = new Administrator();
            $admin->setLogin($login);
            $admin->setPassword($hash);

            $entityManager->persist($admin);
            $entityManager->flush();

            return new JsonResponse(array('code'=> 0, 'msg' => "Успешно"));
            }
            else
            {
                return new JsonResponse(array('code'=>1, 'msg'=>$notification));
            }
        
        }
    }

     /**
     * @Route("/user_expand", options={"expose" =true}, name = "UserExpand")
     * @Method({"GET","POST"})
     */
    public function user_expand(){
        if(isset($_POST['ajax']))
        {
        $id = $_POST['id'];
        $users = $this->getDoctrine()->getRepository(User::class)->find($id);
        $email = $users->getEmail();
        $message = $users->getMessage();

        $shape = $this->getDoctrine()->getRepository(Shape::class)->find($users->getShapeId());
        $color = $this->getDoctrine()->getRepository(Color::class)->find($users->getColorId());

        $shape = $shape->getName();
        $color_code = $color->getCode();
        $color = $color->getName();
        $color = '<h4 style="color:'.$color_code.'">'.$color.'</h4>';

        $images = $this->getDoctrine()->getRepository(Image::class)->findBy(['user_id' => $id]);

        $img_list ="";

        foreach ($images as $img)
        {
          $img_list .='<div class="row">
          <img src="'.$img->getDir().'">
            </div>';
        }

        return new JsonResponse(
            array('message'=>$message,
            'email'=>$email,
            'shape'=>$shape,
            'color'=>$color,
            'img_list'=>$img_list)
        );

        }
    
    }

     /**
     * @Route("/user_paginate", options={"expose" =true}, name = "UserPaginate")
     * @Method({"GET","POST"})
     */
    public function user_paginate(){

        $page = $_POST['page'];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $total_registries = sizeof($users);

        $per_page = 10;
        $adjacents  = 9; 
        $offset = ($page - 1) * $per_page;
        $count_query   = $total_registries;
        $total_pages = ceil($total_registries/$per_page);

        $sql = '
        SELECT * FROM user u
        ORDER BY u.id ASC
        LIMIT '.$per_page.' OFFSET '.$offset;
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $registries = $stmt->fetchAll();

        $i=1+$offset;

        $table='<div class="table-pagination pull-right">';
        $table.=''. $this->paginate_table("index.php", $page, $total_pages, $adjacents,"get_table_page").'';
        $table.='</div>';
        $table .= '<table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">№</th>
            <th scope="col">Электронная почта</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>';
        foreach ($registries as $r)
        {
          $table.='<tr class="table-light">
            <th scope="row">'.$i.'</th>
            <td>'.$r['email'].'</td>
            <td><button class="btn btn-success my-2 my-sm-0" type="button" onclick="expand('.$r['id'].')">Посмотреть</button></td>
          </tr>';
          $i++;
        }
          
        $table .= '</tbody>
         </table>';

         return new JsonResponse($table);

    }

    public function paginate_table($reload, $page, $tpages, $adjacents, $funcion='') {
        
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = '<ul class="pagination">';
        
        // previous label
        
        if($page==1) {
            $out.= "<li class='page-item disabled'><span><a class='page-link'>$prevlabel</a></span></li>";
        } else if($page==2) {
            $out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='$funcion(1)'>$prevlabel</a></span></li>";
        }else {
            $out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='$funcion(".($page-1).")'>$prevlabel</a></span></li>";     
        }
        
        // first label
        if($page>($adjacents+1)) {
            $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='$funcion(1)'>1</a></li>";
        }
        // interval
        if($page>($adjacents+2)) {
            $out.= "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        
        // pages
        
        $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
        $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
        for($i=$pmin; $i<=$pmax; $i++) {
            if($i==$page) {
                $out.= "<li class='page-item active'><a class='page-link'>$i</a></li>";
            }else if($i==1) {
                $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='$funcion(1)'>$i</a></li>";
            }else {
                $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='$funcion(".$i.")'>$i</a></li>";
            }
        }
        
        // interval
        
        if($page<($tpages-$adjacents-1)) {
            $out.= "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        
        // last
        
        if($page<($tpages-$adjacents)) {
            $out.= "<li class='page-item'><a class='page-link' href='javascript:void(0);' onclick='$funcion($tpages)'>$tpages</a></li>";
        }
        
        // next
        
        if($page<$tpages) {
            $out.= "<li class='page-item'><span><a class='page-link' href='javascript:void(0);' onclick='$funcion(".($page+1).")'>$nextlabel</a></span></li>";
        }else {
            $out.= "<li class='page-item disabled'><span><a class='page-link'>$nextlabel</a></span></li>";
        }
        
        $out.= "</ul>";
        return $out;
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
