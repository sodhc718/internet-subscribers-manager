<?php
/**
*
*/
class Plan
{
    protected $plan_id;
    protected $plan_name;
    protected $plan_desc;
    protected $plan_cost;

    function __construct(array $data)
    {
        if (isset($data['plan_id'])) {
            $this->plan_id = $data['plan_id'];
        }

        $this->plan_name = $data['plan_name'];
        $this->plan_desc = $data['plan_desc'];
        $this->plan_cost = $data['plan_cost'];
    }

    /**
     * Gets the value of plan_id.
     *
     * @return mixed
     */
    public function getPlanId()
    {
        return $this->plan_id;
    }

    /**
     * Sets the value of plan_id.
     *
     * @param mixed $plan_id the plan id
     *
     * @return self
     */
    protected function setPlanId($plan_id)
    {
        $this->plan_id = $plan_id;

        return $this;
    }

    /**
     * Gets the value of plan_name.
     *
     * @return mixed
     */
    public function getPlanName()
    {
        return $this->plan_name;
    }

    /**
     * Sets the value of plan_name.
     *
     * @param mixed $plan_name the plan name
     *
     * @return self
     */
    protected function setPlanName($plan_name)
    {
        $this->plan_name = $plan_name;

        return $this;
    }

    /**
     * Gets the value of plan_desc.
     *
     * @return mixed
     */
    public function getPlanDesc()
    {
        return $this->plan_desc;
    }

    /**
     * Sets the value of plan_desc.
     *
     * @param mixed $plan_desc the plan desc
     *
     * @return self
     */
    protected function setPlanDesc($plan_desc)
    {
        $this->plan_desc = $plan_desc;

        return $this;
    }

    /**
     * Gets the value of plan_cost.
     *
     * @return mixed
     */
    public function getPlanCost()
    {
        return $this->plan_cost;
    }

    /**
     * Sets the value of plan_cost.
     *
     * @param mixed $plan_cost the plan cost
     *
     * @return self
     */
    protected function setPlanCost($plan_cost)
    {
        $this->plan_cost = $plan_cost;

        return $this;
    }
}
