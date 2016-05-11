<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\dao\PlanDAO;
use App\model\dao\CustomerDAO;


final class SubscribersManager
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
        $this->logger->info("Home page action dispatched");

        $planDAO = new PlanDAO($this->db);
        $plans = $planDAO->getAllPlansToArray();
        $customerDAO = new CustomerDAO($this->db);
        $customers = $customerDAO->getAllCustomers();
        $this->view->render($response, 'subscribers_manager.twig',
                            ["customers" => $customers,
                             "plans" => $plans]);
        return $response;
    }
}
