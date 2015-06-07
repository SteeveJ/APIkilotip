<?php

namespace APIBundle\Controller;

use APIBundle\Entity\AlimentsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use APIBundle\Entity\Aliments;
use APIBundle\Form\AlimentsType;

/**
 * Aliments controller.
 *
 * @Route("/aliments")
 */
class AlimentsController extends Controller
{
    /**
     * @Route("/api_aliment/{id}", name="api_aliments", defaults={"id" = null}, requirements={"id" =  "\d+"})
     */
    public function alimentsAction($id)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $em = $this->getDoctrine()->getManager();
        /** @var AlimentsRepository $repo */
        $repo = $em->getRepository('APIBundle:Aliments');
        $article = $repo->findCatchThemAll($id);
        return new JsonResponse($article);
    }
    
    /**
     * Lists all Aliments entities.
     *
     * @Route("/", name="aliments")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('APIBundle:Aliments')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aliments entity.
     *
     * @Route("/", name="aliments_create")
     * @Method("POST")
     * @Template("APIBundle:Aliments:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aliments();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aliments_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aliments entity.
     *
     * @param Aliments $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aliments $entity)
    {
        $form = $this->createForm(new AlimentsType(), $entity, array(
            'action' => $this->generateUrl('aliments_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aliments entity.
     *
     * @Route("/new", name="aliments_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aliments();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aliments entity.
     *
     * @Route("/{id}", name="aliments_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Aliments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aliments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aliments entity.
     *
     * @Route("/{id}/edit", name="aliments_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Aliments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aliments entity.');
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
    * Creates a form to edit a Aliments entity.
    *
    * @param Aliments $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aliments $entity)
    {
        $form = $this->createForm(new AlimentsType(), $entity, array(
            'action' => $this->generateUrl('aliments_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aliments entity.
     *
     * @Route("/{id}", name="aliments_update")
     * @Method("PUT")
     * @Template("APIBundle:Aliments:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APIBundle:Aliments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aliments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aliments_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aliments entity.
     *
     * @Route("/{id}", name="aliments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('APIBundle:Aliments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aliments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aliments'));
    }

    /**
     * Creates a form to delete a Aliments entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aliments_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
