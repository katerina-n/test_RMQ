<?php

namespace AppBundle\Controller;

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
     */
    public function indexAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $newUserMail = new UserMail();
        $newUserMail->setCreator($user);

        $form = $this->createForm(UserMailType::class, $newUserMail, ['method' => 'POST']);
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->get('old_sound_rabbit_mq.send_email_producer')->publish('Сообщенька для отправки на мыло...');
              dump(5);die;
            }
        }

        $formView = $form->createView();

        return $this->render('@App/default/index.html.twig', [
            'form' => $formView
            ]);
    }
}
