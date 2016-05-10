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

    public function getPlanById($plan_id)
    {
        $sql = "SELECT * FROM goi_cuoc WHERE ma_goi_cuoc = :plan_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["plan_id" => $plan_id]);

        if ($result) {
            return new Plan($result->fetch());
        }
    }
}