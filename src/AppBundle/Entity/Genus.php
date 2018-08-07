<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRepository")
 * @ORM\Table(name="genus")
 */
class Genus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $passwords;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="Negative species! Come on...")
     */
    private $number;

    /**
     * Gets Id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets Id.
     *
     * @param mixed $id
     *
     * @return Genus
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets Name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets Name.
     *
     * @param mixed $name
     *
     * @return Genus
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets Passwords.
     *
     * @return mixed
     */
    public function getPasswords()
    {
        return $this->passwords;
    }

    /**
     * Sets Passwords.
     *
     * @param mixed $passwords
     *
     * @return Genus
     */
    public function setPasswords($passwords)
    {
        $this->passwords = $passwords;
        return $this;
    }

    /**
     * Gets Email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets Email.
     *
     * @param mixed $email
     *
     * @return Genus
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Gets Number.
     *
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Sets Number.
     *
     * @param mixed $number
     *
     * @return Genus
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function getUpdate()
    {
        return new \DateTime('-'. rand(1,100).'days');
    }
}