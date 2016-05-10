<?php
namespace App\model\dao;

use App\model\Customer;

/**
*
*/
class CustomerDAO
{

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
}