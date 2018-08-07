<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use AppBundle\Form\GenusFormType;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * main action
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genuses=$em->getRepository('AppBundle:Genus')->findAllPublishedOrderedBySize ();

//dump($genuses);
        return $this->render('default/list.html.twig', array(
            'genuses' => $genuses
        ));
    }
    /*public function indexAction(): void
    {
        $em = $this->getDoctrine()->getManager();
        $genuses=$em->getRepository('AppBundle:Genus')->findAllPublishedOrderedBySize ();

//dump($genuses);
        return $this->render('default/list.html.twig', array(
            'meta' => array(),
            'genuses' => $genuses
        ));
    }*/

    /**
     * @Route("/genus/new")
     *
     */
    public function newAction()
    {
        $object=new Genus();
        $object->setName('Bo'.rand(1,100));
        $object->setPasswords('123');
        $object->setEmail('f');
        $object->setNumber(rand(1,100));
        $note = new GenusNote();
        $note->setUsername( 'AquaWeaver' );
        $note->setUserAvatarFilename( '' );
        $note->setNote( 'I counted 8 legs... as they wrapped around me' );
        $note->setCreatedAt( new \DateTime( '-1 month' ));
        $note->setGenus($object);
        $em= $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->persist($note);
        $em->flush();
        return new Response('<html><body>Genus created</body></html>');
    }


    /**
     * @Route("/genus/{name}", name="genus")
     */
    public function showAction($name)
    {

        $em = $this->getDoctrine()->getManager();
        $genuses=$em->getRepository('AppBundle:Genus')->findOneBy(['name'=>$name]);
        $recentNotes = $em->getRepository('AppBundle:GenusNote')
            ->findAllRecentNotesForGenus($genuses);
        if (!$genuses) {
            throw $this->createNotFoundException('genus not found');
        }

        return $this->render('default/show.html.twig', array(
            'name' => $name, 'notes' => $genuses
        ));

    }

    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        dump($em->getRepository('AppBundle:Genus')->findAll());
        $genuses=$em->getRepository('AppBundle:Genus')->findAll();

        return $this->render('default/list.html.twig', array(
          'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/{name}/notes", name="genus_show_notes")
     * @Method("Get")
     */
    public function getNotesAction()
    {
        $notes = [
            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];
        $data = [
            'notes' => $notes
        ];
        return new JsonResponse($data);
    }

    /**
     * @Route("/form", name="genus_form")
     * @Method("Get")
     */
    public function formAction(){
        $form = $this ->createForm(GenusFormType::class);
        return $this ->render( 'default/new.html.twig' , [
            'genusForm' => $form->createView()
        ]);
    }
}
