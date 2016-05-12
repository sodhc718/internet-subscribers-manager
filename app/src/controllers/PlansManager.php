<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\beans\Plan;
use App\model\dao\PlanDAO;


final class PlansManager
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
        $category = $request->getAttribute("category");
        $sub_category = $request->getAttribute("sub_category");

        $planDAO = new PlanDAO($this->db);
        $planList = $planDAO->getAllPlans();
        $this->view->render($response, 'plans_manager.twig',
                            ["plans" => $planList,
                             "category" => $category,
                             "sub_category"=> $sub_category]);
        return $response;
    }
}
