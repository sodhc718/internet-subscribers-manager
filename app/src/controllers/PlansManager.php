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
        $planDAO = new PlanDAO($this->db);
        $planList = $planDAO->getAllPlans();
        $this->view->render($response, 'plans_manager.twig',
                            ["plans" => $planList,
                             "category" => "Gói cước dịch vụ",
                             "sub_category"=> "Quản lý gói cước"]);
        return $response;
    }

    public function getPlanData(Request $request, Response $response, $args)
    {
        $planDAO = new PlanDAO($this->db);
        $planList = $planDAO->getAllPlans();
        $planData = [];
        foreach ($planList as $plan) {
            $planData[$plan->getPlanId()] = [$plan->getPlanName(), $plan->getPlanCost(), $plan->getPlanDesc()];
        }
        $response = $response->withJson($planData, 201);
        return $response;
    }

    public function getPlanDataByID(Request $request, Response $response, $args)
    {
        $planID = $request->getParam('planID');
        $planDAO = new PlanDAO($this->db);
        $plan = $planDAO->getPlanById($planID);
        $planData = array($plan->getPlanName(), $plan->getPlanCost(), $plan->getPlanDesc());
        $response = $response->withJson($planData, 201);
        return $response;
    }

    public function updatePlan(Request $request, Response $response, $args)
    {
        $planDAO = new PlanDAO($this->db);
        $planData = $request->getParam("planData");
        // $planData = [];
        // $planData['planID'] = filter_var($data['planID'], FILTER_SANITIZE_NUMBER_INT);
        // $planData['planName'] = filter_var($data['planName'], FILTER_SANITIZE_STRING);
        // $planData['planDes'] = filter_var($data['planDes'], FILTER_SANITIZE_STRING);
        // $planData['planPrice'] = filter_var($data['planPrice'], FILTER_SANITIZE_NUMBER_INT);
        $planDAO->update($planData);

        $response = $response->withJson($planData, 201);
        return $response;
    }
}
