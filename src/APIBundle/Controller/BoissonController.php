<?php

namespace APIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APIBundle\Entity\Boisson;
use APIBundle\Form\BoissonType;

/**
 * Boisson controller.
 *
 * @Route("/boisson")
 */
class BoissonController extends Controller
{

    /**
     * Lists all Boisson entities.
     *
     * @Route("/", name="boisson")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APIBundle:Boisson')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Boisson entity.
     *
     * @Route("/", name="boisson_create")
     * @Method("POST")
     * @Template("APIBundle:Boisson:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Boisson();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boisson_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Boisson entity.
     *
     * @param Boisson $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Boisson $entity)
    {
        $form = $this->createForm(new BoissonType(), $entity, array(
            'action' => $this->generateUrl('boisson_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Boisson entity.
     *
     * @Route("/new", name="boisson_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Boisson();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Boisson entity.
     *
     * @Route("/{id}", name="boisson_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Boisson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boisson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Boisson entity.
     *
     * @Route("/{id}/edit", name="boisson_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Boisson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boisson entity.');
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
    * Creates a form to edit a Boisson entity.
    *
    * @param Boisson $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Boisson $entity)
    {
        $form = $this->createForm(new BoissonType(), $entity, array(
            'action' => $this->generateUrl('boisson_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Boisson entity.
     *
     * @Route("/{id}", name="boisson_update")
     * @Method("PUT")
     * @Template("APIBundle:Boisson:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Boisson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boisson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('boisson_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Boisson entity.
     *
     * @Route("/{id}", name="boisson_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('APIBundle:Boisson')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Boisson entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('boisson'));
    }

    /**
     * Creates a form to delete a Boisson entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('boisson_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
