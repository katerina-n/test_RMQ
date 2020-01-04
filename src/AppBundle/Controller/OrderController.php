<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OrderController
{
    private $orderService;
//
//    public function __construct(OrderService $orderService)
//    {
//        $this->orderService = $orderService;
//    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {dump(1); die;
        $result = $this->orderService->create(json_decode($request->getContent(), true));

        return new Response($result);
    }
}