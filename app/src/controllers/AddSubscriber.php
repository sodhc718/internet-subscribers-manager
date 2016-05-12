<?php
namespace App\controllers;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\model\beans\Customer;
use App\model\dao\CustomerDAO;
use App\model\beans\Plan;
use App\model\dao\PlanDAO;

final class AddSubscriber
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
        if(!isset($_SESSION['auth'])) {
            return $response->withRedirect('login');
        }
        if ($request->isGet()) {
            $planDAO = new PlanDAO($this->db);
            $planList = $planDAO->getAllPlans();
            $this->view->render($response, 'add_subscriber.twig',
                                ["plans" => $planList,
                                 "category" => "Thuê bao",
                                 "sub_category"=> "Thêm thuê bao"]);
            return $response;
        } elseif ($request->isPost()) {
            $customerDAO = new CustomerDAO($this->db);

            $data = $request->getParsedBody();
            $customer_data = [];
            $customer_data['so_thue_bao'] = filter_var($data['contractCode'], FILTER_SANITIZE_STRING);
            $customer_data['hoten'] = filter_var($data['fullName'], FILTER_SANITIZE_STRING);
            $customer_data['dia_chi'] = filter_var($data['address'], FILTER_SANITIZE_STRING);
            $customer_data['cmnd'] = filter_var($data['passport'], FILTER_SANITIZE_STRING);
            $customer_data['ngay_cap_cmnd'] = filter_var($data['passportIssueDate'], FILTER_SANITIZE_STRING);
            $customer_data['noi_cap_cmnd'] = filter_var($data['passportIssueAddress'], FILTER_SANITIZE_STRING);
            $customer_data['email'] = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
            $customer_data['so_dien_thoai'] = filter_var($data['phoneNumber'], FILTER_SANITIZE_STRING);
            $customer_data['ma_goi_cuoc'] = filter_var($data['planSelect'], FILTER_SANITIZE_NUMBER_INT);
            $customer_data['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);
            $customer_data['mat_khau'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
            $customer_data['ngay_dang_ki'] = filter_var($data['registerDate'], FILTER_SANITIZE_STRING);;

            $customer = new Customer($customer_data);

            $customerDAO->insert($customer);

            $response = $response->withRedirect("/subs-manager");
            return $response;
        }
    }
}
