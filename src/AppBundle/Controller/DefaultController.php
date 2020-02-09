<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\UserMail;
use UserBundle\Form\UserMailType;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function indexAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $newUserMail = new UserMail();
        $newUserMail->setCreator($user);

        $form = $this->createForm(UserMailType::class, $newUserMail, ['method' => 'POST']);
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $message = \Swift_Message::newInstance()
                    ->setSubject('subject')
                    ->setFrom($user->getEmail())
                    ->setTo($newUserMail->getSendTo())
                    ->setBody($newUserMail->getMessage(), 'text/html');
                /** @var \Swift_Mailer $mailer */
                $mailer = $this->get('mailer');
                $mailer->send($message);
                $newUserMail->setIsSend(true);

                $em->persist($newUserMail);
                $em->flush();

                return $this->redirectToRoute('app_default_index');
            }
        }

        $formView = $form->createView();

        return $this->render('@App/default/index.html.twig', [
            'form' => $formView,
            'creator' => $user->getUsername()
            ]);
    }
}
