<?php

namespace WorkshopBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use WorkshopBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{

    /**
     * Update tables
     *
     * @Route("/update-table", name="user_table_update")
     * @Method("GET")
     */
    public function updateScores()
    {
        $users = $this->get('workshop.repository.user')->findAll();

        // update user score
        foreach ($users as $user) {
            /** @var User $user */
            $totalScore = $this->get('workshop.repository.score')->findTotalScoreByUser($user);
            $user->setTotalScore($totalScore['totalPoints']);

            $this->getDoctrine()->getManager()->flush();
        }

        // update user positions
        $users = $this->get('workshop.repository.user')->findAll();
        foreach ($users as $key => $user) {
            /** @var User $user */
            $user->setPreviousPosition($user->getCurrentPosition());
            $user->setCurrentPosition($key + 1);

            $this->getDoctrine()->getManager()->flush();
        }


        return new Response('Table updated');
    }

    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $users = $this->get('workshop.repository.user')->findAll();

        return $this->render(
            'WorkshopBundle::user/index.html.twig',
            array(
                'users' => $users,
            )
        );
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('WorkshopBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $users = $this->get('workshop.repository.user')->findAll();

            // update user score
            foreach ($users as $user) {
                /** @var User $user */
                $totalScore = $em->getrepository('WorkshopBundle:Score')->findTotalScoreByUser($user);
                $user->setTotalScore($totalScore['totalPoints']);

                $em->flush();
            }

            // update user positions
            $users = $this->get('workshop.repository.user')->findAll();
            foreach ($users as $key => $user) {
                /** @var User $user */
                $user->setPreviousPosition($user->getCurrentPosition());
                $user->setCurrentPosition($key + 1);

                $em->flush();
            }

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render(
            'WorkshopBundle::user/new.html.twig',
            array(
                'user' => $user,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render(
            'WorkshopBundle::user/show.html.twig',
            array(
                'user' => $user,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('WorkshopBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render(
            'WorkshopBundle::user/edit.html.twig',
            array(
                'user' => $user,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        $em = $this->getDoctrine()->getManager();

        $users = $this->get('workshop.repository.user')->findAll();

        // update user score
        foreach ($users as $user) {
            /** @var User $user */
            $totalScore = $em->getrepository('WorkshopBundle:Score')->findTotalScoreByUser($user);
            $user->setTotalScore($totalScore['totalPoints']);

            $em->flush();
        }

        // update user positions
        $users = $this->get('workshop.repository.user')->findAll();
        foreach ($users as $key => $user) {
            /** @var User $user */
            $user->setPreviousPosition($user->getCurrentPosition());
            $user->setCurrentPosition($key + 1);

            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
