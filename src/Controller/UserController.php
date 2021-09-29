<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Shape;
use App\Entity\Color;
use App\Entity\User;
use App\Entity\Image;


class UserController extends AbstractController{
    /**
     * @Route("/")
     * @Method({"GET","POST"})
     */
    public function index(){
        $shapes = $this->getDoctrine()->getRepository(Shape::class)->findAll();
        $colors = $this->getDoctrine()->getRepository(Color::class)->findAll();

        return $this->render('views/index.html.twig', array('user' => 'Пользователь',
                                                             'shapes' => $shapes,
                                                            'colors' => $colors));
    }

    /**
     * @Route("/save_user_data", options={"expose" =true}, name = "SaveUserData")
     * @Method({"GET","POST"})
     */
    public function save_user_data(){
            if(isset($_POST['ajax']))
            {
                $validation = TRUE;
                $notification = "";
                $allowTypes = array('jpg','png','jpeg','JPG','JPEG','PNG');
                $targetDir = "C:/xampp/htdocs/zadacha_symfony/src/user_pictures/";

                $message = $_POST['message'];
                $email = $_POST['email'];
                $color = $_POST['color'];
                $shape = $_POST['shape'];  
                $files = $_FILES;

                if ($message=="" || $email=="" || $color=="" || $shape == "" || sizeof($files) == 0)
                {
                    $validation = FALSE;
                    $notification .= "Запольните все поля|";
                }
                //наяало проверки
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $check_email = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);;
                    if (!empty($check_email))
                    {
                        $validation = FALSE;
                        $notification .= "Электронная почта уже зарегистрирована|";
                    }
                }
                else {
                    $validation = FALSE;
                    $notification .= "Неправильный формат электронной почты|";
                }                

                if (strlen($message)>255)
                {
                    $validation = FALSE;
                    $notification .= "Длина электронной почты превышает 255 зкаков|";
                }

                if (sizeof($files)>4)
                {
                    $validation = FALSE;
                    $notification .= "Выбрано больше 4 файлов|";
                }

                foreach ($files as $f)
                {
                    $fileName = basename($f["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(!(in_array($fileType, $allowTypes))){
                        $validation = FALSE;
                        $notification .= "Неправильный формат файлов|";
                    }

                } 

                if(!($validation))
                {
                    return new JsonResponse(array('code'=> 1, 'msg' => $notification));
                }
                else
                {   $entityManager = $this->getDoctrine()->getManager();

                    $user = new User();
                    $user->setMessage($message);
                    $user->setEmail($email);
                    $user->setShapeId($shape);
                    $user->setColorId($color);
                    
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $user_id = $user->getId();

                    foreach ($files as $f)
                    {
                        $fileName = basename($f["name"]);
                        $token = hash('sha256', $email);
                        $targetFilePath = $targetDir . $token."_".$fileName;
                
                        if(move_uploaded_file($f["tmp_name"], $targetFilePath))
                        {
                            $image = new Image();
                            $image->setDir($targetFilePath);
                            $image->setUserId($user_id);

                            $entityManager->persist($image);
                            $entityManager->flush();
                        }
                        else  return new JsonResponse(array('code'=> 1, 'msg' => "Ошивка загрузки файлов"));
                    }
                    
                    return new JsonResponse(array('code'=> 0, 'msg' => "Успешно"));
                }
            }
    }
}