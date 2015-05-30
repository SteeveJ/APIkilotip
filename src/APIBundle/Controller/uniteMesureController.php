<?php

namespace APIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APIBundle\Entity\uniteMesure;
use APIBundle\Form\uniteMesureType;

/**
 * uniteMesure controller.
 *
 * @Route("/unitemesure")
 */
class uniteMesureController extends Controller
{

    /**
     * Lists all uniteMesure entities.
     *
     * @Route("/", name="unitemesure")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APIBundle:uniteMesure')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new uniteMesure entity.
     *
     * @Route("/", name="unitemesure_create")
     * @Method("POST")
     * @Template("APIBundle:uniteMesure:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new uniteMesure();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('unitemesure_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a uniteMesure entity.
     *
     * @param uniteMesure $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(uniteMesure $entity)
    {
        $form = $this->createForm(new uniteMesureType(), $entity, array(
            'action' => $this->generateUrl('unitemesure_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new uniteMesure entity.
     *
     * @Route("/new", name="unitemesure_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new uniteMesure();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a uniteMesure entity.
     *
     * @Route("/{id}", name="unitemesure_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:uniteMesure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find uniteMesure entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing uniteMesure entity.
     *
     * @Route("/{id}/edit", name="unitemesure_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:uniteMesure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find uniteMesure entity.');
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
    * Creates a form to edit a uniteMesure entity.
    *
    * @param uniteMesure $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(uniteMesure $entity)
    {
        $form = $this->createForm(new uniteMesureType(), $entity, array(
            'action' => $this->generateUrl('unitemesure_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing uniteMesure entity.
     *
     * @Route("/{id}", name="unitemesure_update")
     * @Method("PUT")
     * @Template("APIBundle:uniteMesure:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:uniteMesure')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find uniteMesure entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('unitemesure_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a uniteMesure entity.
     *
     * @Route("/{id}", name="unitemesure_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('APIBundle:uniteMesure')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find uniteMesure entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('unitemesure'));
    }

    /**
     * Creates a form to delete a uniteMesure entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitemesure_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
