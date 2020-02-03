<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
//        $orderService = $this->get('application_frontend.service.order');
//        $result = $orderService->create(json_decode($request->getContent(), true));
//
//        return new Response($result);
    }
}