<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\beans\Plan;
use App\model\dao\PlanDAO;

final class AddPlan
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
        if ($request->isGet()) {
        $this->view->render($response, 'add_plan.twig',
                            ["category" => "Gói cước dịch vụ",
                             "sub_category"=> "Thêm gói cước"]);
        return $response;
        }
        elseif ($request->isPost()) {
            $planDAO = new PlanDAO($this->db);

            $data = $request->getParsedBody();
            $plan_data = [];
            $plan_data['ten_goi_cuoc'] = filter_var($data['planName'], FILTER_SANITIZE_STRING);
            $plan_data['mo_ta'] = filter_var($data['planDes'], FILTER_SANITIZE_STRING);
            $plan_data['cuoc_phi'] = filter_var($data['planPrice'], FILTER_SANITIZE_NUMBER_INT);
            $plan = new Plan($plan_data);

            $planDAO->insert($plan);

            $response = $response->withRedirect("/plans-manager");
            return $response;
        }
    }
}
