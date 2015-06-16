<?php

namespace APIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APIBundle\Entity\Archives;
use APIBundle\Form\ArchivesType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Archives controller.
 *
 * @Route("/archives")
 */
class ArchivesController extends Controller
{


    /**
     * Lists all Archives entities.
     *
     * @Route("/api_archives/{id}", name="api_archives", defaults={"id" = null}, requirements={"id" =  "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function archivesAction()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $em = $this->getDoctrine()->getManager();
        /** @var ArchivesRepository $repo */
        $repo = $em->getRepository('APIBundle:Archives');
        $archives = $repo->findCatchThemAll($id);
        return new JsonResponse($archives);
    }

    /**
     * @Route("/create/{idUser}/{name}/{calorie}",
     * name="Create_archives",
     * methods = { "GET", "POST" })
     */
    public function userCreateAction($idUser, $name, $calorie)
    {
        header("Access-Control-Allow-Origin: *");
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('APIBundle:User')->findOneBy(['id' => $idUser]);
        //var_dump($user->getCalorie());
        $user->setCalorie(($user->getCalorie()+$calorie));
        //var_dump($user->getCalorie());
        //die;
        $em->persist($user);
        $em->flush();
        $archive = new Archives();
        //var_dump($archive);
        $archive->setCalories($calorie)->setUser($user)->setDate()->setName($name);
        //var_dump($archive);
        $em->persist($archive);
        $em->flush();
        return new JsonResponse($user->getCalorie());
    }

    /**
     * Lists all Archives entities.
     *
     * @Route("/", name="archives")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APIBundle:Archives')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Archives entity.
     *
     * @Route("/", name="archives_create")
     * @Method("POST")
     * @Template("APIBundle:Archives:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Archives();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('archives_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Archives entity.
     *
     * @param Archives $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Archives $entity)
    {
        $form = $this->createForm(new ArchivesType(), $entity, array(
            'action' => $this->generateUrl('archives_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Archives entity.
     *
     * @Route("/new", name="archives_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Archives();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Archives entity.
     *
     * @Route("/{id}", name="archives_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Archives')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archives entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Archives entity.
     *
     * @Route("/{id}/edit", name="archives_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Archives')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archives entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Archives entity.
    *
    * @param Archives $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Archives $entity)
    {
        $form = $this->createForm(new ArchivesType(), $entity, array(
            'action' => $this->generateUrl('archives_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Archives entity.
     *
     * @Route("/{id}", name="archives_update")
     * @Method("PUT")
     * @Template("APIBundle:Archives:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Archives')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Archives entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('archives_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Archives entity.
     *
     * @Route("/delete/{idUser}/{id}/{calorie}", name="archives_delete")
     * @Method("GET")
     */
    public function deleteAction($idUser,$id, $calorie)
    {
        header("Access-Control-Allow-Origin: *");
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('APIBundle:Archives')->find($id);

        $user = $em->getRepository('APIBundle:User')->findOneBy(['id' => $idUser]);
        //var_dump($user->getCalorie());
        $user->setCalorie(($user->getCalorie()-$calorie));
        //var_dump($user->getCalorie());
        //die;
        $em->persist($user);
        $em->flush();
            $em->remove($entity);
            $em->flush();
        return new JsonResponse($user->getCalorie());

    }

    /**
     * Creates a form to delete a Archives entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('archives_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
