<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Exception\CacheFailOverException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CustomersController extends Controller
{
    /**
     * @Route("/customers/")
     * @Method("GET")
     */
    public function getAction()
    {
        $repository = $this->get('customer_repository');

        try {
            $cacheService = $this->get('cache_service');

            $customers = json_decode($cacheService->get('customers'));

            if (empty($customers)) {
                $customers = iterator_to_array($repository->findAll());
            }
        } catch (CacheFailOverException $e) {
            $customers = iterator_to_array($repository->findAll());
        }

        return new JsonResponse($customers);
    }

    /**
     * @Route("/customers/")
     * @Method("POST")
     */
    public function postAction(Request $request)
    {
        $cacheService = $this->get('cache_service');

        $repository = $this->get('customer_repository');

        $customers = json_decode($request->getContent());

        if (empty($customers)) {
            return new JsonResponse(['status' => 'No donuts for you'], 400);
        }

        foreach ($customers as $customer) {
            $repository->save($customer);
        }

        $cacheService->set('customers', json_encode($customers));

        return new JsonResponse(['status' => 'Customers successfully created']);
    }

    /**
     * @Route("/customers/")
     * @Method("DELETE")
     */
    public function deleteAction()
    {
        $repository = $this->get('customer_repository');

        $repository->delete();

        return new JsonResponse(['status' => 'Customers successfully deleted']);
    }
}
