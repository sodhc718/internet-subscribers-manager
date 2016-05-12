<?php
namespace App\model\dao;

use App\model\dao\Mapper;
use App\model\beans\Plan;

/**
*
*/
class PlanDAO extends Mapper
{

    public function getAllPlans()
    {
        $sql = "SELECT * FROM goi_cuoc";
        $stmt = $this->db->query($sql);

        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new Plan($row);
        }
        return $results;
    }

    public function getAllPlansToArray()
    {
        $plans = $this->getAllPlans();
        $results = [];
        foreach ($plans as $plan) {
            $results[$plan->getPlanId()] = $plan->getPlanName();
        }
        return $results;
    }

    public function getPlanById($plan_id)
    {
        $sql = "SELECT * FROM goi_cuoc WHERE ma_goi_cuoc = :plan_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["plan_id" => $plan_id]);

        if ($result) {
            return new Plan($result->fetch());
        }
    }

    public function insert(Plan $plan)
    {
        $sql = "insert into goi_cuoc(ten_goi_cuoc, cuoc_phi, mo_ta)
                values(:planName, :planPrice, :planDes)";
        $stmt = $this->db->prepare($sql);
        echo $plan->getPlanDesc();
        $result = $stmt->execute(["planName" => $plan->getPlanName(),
                                  "planPrice" => $plan->getPlanCost(),
                                  "planDes" => $plan->getPlanDesc()]);
        if (!$result) {
            throw new Exception("Could not save record");
        }
    }
}