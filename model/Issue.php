<?php

/**
 * Class Issue
 * Mapping of issue's table
 */
class Issue extends MappingTable {

    // PROPERTIES
    protected int $id_issue;
    protected string $timestamp_issue;
    protected string $desc_issue;
    protected string $status_issue;
    protected string $admin_id_admin;
    protected string $customer_id_customer;

    // GETTERS

    /**
     * $id_issue's getter
     * @return int
     */
    public function getIdIssue(): int {
        return $this->id_issue;
    }

    /**
     * $timestamp_issue's getter
     * @return string
     */
    public function getTimestampIssue(): string {
        return $this->timestamp_issue;
    }

    /**
     * $desc_issue's getter
     * @return string
     */
    public function getDescIssue(): string {
        return $this->desc_issue;
    }

    /**
     * $status_issue's getter
     * @return int
     */
    public function getStatusIssue(): int {
        return $this->status_issue;
    }

    /**
     * $admin_id_admin's getter
     * @return int
     */
    public function getAdminIdAdmin(): int {
        return $this->admin_id_admin;
    }

    /**
     * $customer_id_customer's getter
     * @return int
     */
    public function getCustomerIdCustomer(): int {
        return $this->customer_id_customer;
    }

    // SETTERS

    /**
     * $id_issue's setter
     * @param int $id_issue
     */
    public function setIdIssue(int $id_issue): void {
        $id_issue = (int) $id_issue;
        if (empty($id_issue)) {
            trigger_error("The issue ID can't be 0", E_USER_NOTICE);
        } else {
            $this->id_issue = $id_issue;
        }
    }

    /**
     * $timestamp_issue's setter
     * @param string $timestamp_issue
     * @throws Exception
     */
    public function setTimestampIssue(string $timestamp_issue): void {
        $verifyTimestamp = new DateTime($timestamp_issue);
        if (empty($timestamp_issue)) {
            trigger_error('The timestamp of the occurrence of the issue cannot be empty', E_USER_NOTICE);
        } else if (!is_object($verifyTimestamp)) {
            trigger_error('The timestamp of the occurrence of the issue isn\'t valid', E_USER_NOTICE);
        } else {
            $this->timestamp_issue = $timestamp_issue;
        }
    }

    /**
     * $desc_issue's setter
     * @param string $desc_issue
     */
    public function setDescIssue(string $desc_issue): void {
        $desc_issue = strip_tags(trim($desc_issue));
        if (empty($desc_issue)) {
            trigger_error("The description of the issue can't be empty", E_USER_NOTICE);
        } elseif (strlen($desc_issue) > 80) {
            trigger_error("The description of the issue can't be longer than 200 characters", E_USER_NOTICE);
        } else {
            $this->desc_issue = $desc_issue;
        }
    }

    /**
     * $status_issue's setter
     * @param int $status_issue
     */
    public function setStatusIssue(int $status_issue): void {
        $status_issue = (int)$status_issue;
        if($status_issue === 1 || $status_issue === 2){
            $this->status_issue = $status_issue;
        } else {
            trigger_error("The status has to be 1 (resolved) or 2(ongoing)",E_USER_NOTICE);
        }
    }

    /**
     * $admin_id_admin's setter
     * @param int $admin_id_admin
     */
    public function setAdminIdAdmin(int $admin_id_admin): void {
        $admin_id_admin = (int) $admin_id_admin;
        $this->admin_id_admin = $admin_id_admin;
    }

    /**
     * $customer_id_customer's setter
     * @param int $customer_id_customer
     */
    public function setCustomerIdCustomer(int $customer_id_customer): void
    {
        $customer_id_customer = (int)$customer_id_customer;
        if (empty($customer_id_customer)) {
            trigger_error('The foreign key for the customer is not valid', E_USER_NOTICE);
        } else {
            $this->customer_id_customer = $customer_id_customer;
        }
    }
}