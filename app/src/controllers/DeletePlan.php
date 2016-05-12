<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\beans\Plan;
use App\model\dao\PlanDAO;

final class DeletePlan
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
        $planDAO = new PlanDAO($this->db);
        $planID = $request->getParam('planID');

        $planDAO->deletePlanByID($planID);
        return $response;
    }
}
