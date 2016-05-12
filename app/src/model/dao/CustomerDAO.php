<?php
namespace App\model\dao;

use App\model\dao\Mapper;
use App\model\beans\Customer;

/**
*
*/
class CustomerDAO extends Mapper
{

    public function getAllCustomers()
    {
        $sql = "SELECT * FROM khach_hang";
        $stmt = $this->db->query($sql);

        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new Customer($row);
        }
        return $results;
    }

    public function getCustomerBySubNum($sub_num)
    {
        $sql = "SELECT * FROM khach_hang WHERE so_thue_bao = :sub_num";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["sub_num" => $sub_num]);

        if ($result) {
            return new Customer($result->fetch());
        }
    }

    public function getCustomerByPlanId($plan_id)
    {
        $sql = "SELECT * FROM khach_hang WHERE ma_goi_cuoc = :plan_id";
        $stmt = $this->db->prepare($sql);
        $results = $stmt->execute(["plan_id" => $plan_id]);

        $customerList = [];
        while ($row = $result->fetch()) {
            $customerList = new Customer($row);
        }
    }

    public function insert(Customer $customer)
    {
        $sql = "insert into khach_hang(so_thue_bao, hoten, dia_chi, cmnd, ngay_cap_cmnd, noi_cap_cmnd, email, so_dien_thoai, ma_goi_cuoc, username, mat_khau)
                values(:contractCode, :fullName, :address, :passport, :passportIssueDate, :passportIssueLoc, :email, :phoneNum, :planId, :username, :passwd)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["contractCode" => $customer->getSubcribersNum(),
                                  "fullName" => $customer->getName(),
                                  "address" => $customer->getAddress(),
                                  "passport" => $customer->getPassport(),
                                  "passportIssueDate" => $customer->getPassportIssueDate(),
                                  "passportIssueLoc" => $customer->getPassportIssueLoc(),
                                  "email" => $customer->getEmail(),
                                  "phoneNum" => $customer->getPhoneNum(),
                                  "planId" => $customer->getPlanId(),
                                  "username" => $customer->getUsername(),
                                  "passwd" => $customer->getPasswd()]);
        if (!$result) {
            throw new Exception("Could not save record");
        }
    }
}