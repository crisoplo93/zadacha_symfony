<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="text", length=255, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Shape")
     * @ORM\JoinColumn(name="figure_id", referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    private $shape_id;

    /**
     * @ORM\ManyToOne(targetEntity="Color")
     * @ORM\JoinColumn(name="color_id", referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    private $color_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getShapeId()
    {
        return $this->shape_id;
    }

    public function setShapeId($shape_id)
    {
        $this->shape_id = $shape_id;
    }

    public function getColorId()
    {
        return $this->color_id;
    }

    public function setColorId($color_id)
    {
        $this->color_id = $color_id;
    }
}
