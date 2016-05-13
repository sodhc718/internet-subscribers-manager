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
            return new Customer($stmt->fetch());
        }
    }

    public function getCustomerByPlanId($plan_id)
    {
        $sql = "SELECT * FROM khach_hang WHERE ma_goi_cuoc = :plan_id";
        $stmt = $this->db->prepare($sql);
        $results = $stmt->execute(["plan_id" => $plan_id]);

        $customerList = [];
        while ($row = $stmt->fetch()) {
            $customerList = new Customer($row);
        }
    }

    public function insert(Customer $customer)
    {
        $sql = "insert into khach_hang(so_thue_bao, hoten, dia_chi, cmnd, ngay_cap_cmnd, noi_cap_cmnd, email, so_dien_thoai, ma_goi_cuoc, ngay_dang_ki, username, mat_khau) values(:contractCode, :fullName, :address, :passport, :passportIssueDate, :passportIssueLoc, :email, :phoneNum, :planId, :registerDate, :username, :passwd)";
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
                                  "registerDate" => $customer->getRegisterDate(),
                                  "username" => $customer->getUsername(),
                                  "passwd" => $customer->getPasswd()]);
        if (!$result) {
            throw new Exception("Could not save record");
        }
    }
    public function deleteCustomerBySubNum($subNum)
    {
        $sql = "delete from khach_hang where so_thue_bao = :subNum";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["subNum" => $subNum]);
        if (!$result) {
            throw new Exception("Could not delete record");
        }
    }

    public function update($subData)
    {
        $sql = "update khach_hang set " .
               "hoten = :fullName, dia_chi = :address, ".
               "so_dien_thoai = :phoneNum, ma_goi_cuoc = :planId, ngay_dang_ki = :registerDate, ".
               "email = :email, cmnd = :passport, ngay_cap_cmnd = :passportIssueDate, ".
               "noi_cap_cmnd = :passportIssueAddress, username = :username ".
               "where so_thue_bao = :subNum";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["fullName" => $subData["fullName"],
                                  "address" => $subData["address"],
                                  "passport" => $subData["passport"],
                                  "passportIssueDate" => $subData["passportIssueDate"],
                                  "passportIssueAddress" => $subData["passportIssueAddress"],
                                  "email" => $subData["email"],
                                  "phoneNum" => $subData["phoneNum"],
                                  "planId" => $subData["planId"],
                                  "registerDate" => $subData["registerDate"],
                                  "username" => $subData["username"],
                                  "subNum" => $subData["subNum"]]);
        if (!$result) {
            throw new Exception("Could not update record");
        }
    }
}