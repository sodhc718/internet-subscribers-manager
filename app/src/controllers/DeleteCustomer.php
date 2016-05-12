<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\beans\Customer;
use App\model\dao\CustomerDAO;

final class DeleteCustomer
{
    private $view;
    private $logger;

    public function __construct(Twig $view, LoggerInterface $logger, $db)
    {
        $this->db = $db;
        $this->view = $view;
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $customerDAO = new CustomerDAO($this->db);
        $subNum = $request->getParam('subNum');

        $customerDAO->deleteCustomerBySubNum($subNum);
        return $response;
    }
}
