<?php

/**
 * Class Customer
 * Mapping of customer's table
 */
class Customer extends MappingTable {

    // PROPERTIES
    protected int $id_customer;
    protected string $name_customer;
    protected string $domain_customer;
    protected string $contact_person_customer;
    protected string $mail_customer;
    protected string $phone_customer;

    // GETTERS

    /**
     * $id_customer's getter
     * @return int
     */
    public function getIdCustomer(): int {
        return $this->id_customer;
    }

    /**
     * $name_customer's getter
     * @return string
     */
    public function getNameCustomer(): string {
        return $this->name_customer;
    }

    /**
     * $domain_customer's getter
     * @return string
     */
    public function getDomainCustomer(): string {
        return $this->domain_customer;
    }

    /**
     * $contact_person_customer's getter
     * @return string
     */
    public function getContactPersonCustomer(): string {
        return $this->contact_person_customer;
    }

    /**
     * $mail_customer's getter
     * @return string
     */
    public function getMailCustomer(): string {
        return $this->mail_customer;
    }

    /**
     * $phone_customer's getter
     * @return string
     */
    public function getPhoneCustomer(): string {
        return $this->phone_customer;
    }

    // SETTERS

    /**
     * $id_customer's setter
     * @param int $id_customer
     */
    public function setIdCustomer(int $id_customer): void {
        $id_customer = (int) $id_customer;
        if (empty($id_customer)) {
            trigger_error("The customer ID can't be 0", E_USER_NOTICE);
        } else {
            $this->id_customer = $id_customer;
        }
    }

    /**
     * $name_customer's setter
     * @param string $name_customer
     */
    public function setNameCustomer(string $name_customer): void {
        $name_customer = strip_tags(trim($name_customer));
        if (empty($name_customer)) {
            trigger_error("The customer name can't be empty", E_USER_NOTICE);
        } elseif (strlen($name_customer) > 80) {
            trigger_error("The customer name can't be longer than 85 characters", E_USER_NOTICE);
        } else {
            $this->name_customer = $name_customer;
        }
    }

    /**
     * $domain_customer's setter
     * @param string $domain_customer
     */
    public function setDomainCustomer(string $domain_customer): void {
        $domain_customer = strip_tags(trim($domain_customer));
        if (empty($domain_customer)) {
            trigger_error("The domain name can't be empty", E_USER_NOTICE);
        } elseif (strlen($domain_customer) > 80) {
            trigger_error("The domain name can't be longer than 140 characters", E_USER_NOTICE);
        } else {
            $this->domain_customer = $domain_customer;
        }
    }

    /**
     * $contact_person_customer's setter
     * @param string $contact_person_customer
     */
    public function setContactPersonCustomer(string $contact_person_customer): void {
        $contact_person_customer = strip_tags(trim($contact_person_customer));
        if (empty($contact_person_customer)) {
            trigger_error("The name of the contact person can't be empty", E_USER_NOTICE);
        } elseif (strlen($contact_person_customer) > 80) {
            trigger_error("The name of the contact person can't be longer than 100 characters", E_USER_NOTICE);
        } else {
            $this->contact_person_customer = $contact_person_customer;
        }
    }

    /**
     * $mail_customer's setter
     * @param string $mail_customer
     */
    public function setMailCustomer(string $mail_customer): void {
        if (!(filter_var($mail_customer, FILTER_VALIDATE_EMAIL))) {
            trigger_error("The e-mail address needs to be in the right format", E_USER_NOTICE);
        } else if (strlen($mail_customer) > 150) {
            trigger_error("The e-mail address can't be too long", E_USER_NOTICE);
        } else {
            $this->mail_customer = $mail_customer;
        }
    }

    /**
     * $phone_customer's setter
     * @param string $phone_customer
     */
    public function setPhoneCustomer(string $phone_customer): void {
        $phone_customer = strip_tags(trim($phone_customer));
        if (empty($phone_customer)) {
            trigger_error("The name of the contact person can't be empty", E_USER_NOTICE);
        } elseif (strlen($phone_customer) > 40) {
            trigger_error("The name of the contact person can't be longer than 100 characters", E_USER_NOTICE);
        } else {
            $this->phone_customer = $phone_customer;
        }
    }
}