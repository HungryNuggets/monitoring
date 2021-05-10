<?php

/**
 * Class CustomerManager
 * Manager for the customer table
 */
class CustomerManager extends ManagerTable {

    // CREATING NEW CUSTOMER
    public function newCustomer(Customer $customer): bool {

        // CUSTOMER INSERT
        $sql = "INSERT INTO customer (name_customer, domain_customer, contact_person_customer, mail_customer, phone_customer) VALUES (?,?,?,?,?)";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([
                $customer->getNameCustomer(),
                $customer->getDomainCustomer(),
                $customer->getContactPersonCustomer(),
                $customer->getMailCustomer(),
                $customer->getPhoneCustomer()
            ]);

            // IF OKAY
            return true;

        } catch (Exception $e) {

            trigger_error($e->getMessage());

            // IF NOT
            return false;
        }
    }

    function updateCustomer(Customer $customer) : bool {

        $sql = "UPDATE customer SET name_customer= ?, domain_customer= ?,contact_person_user= ?, mail_customer= ?, phone_customer= ? WHERE id_customer=?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $customer->getNameCustomer(), PDO::PARAM_STR);
        $prepare->bindValue(2, $customer->getDomainCustomer(), PDO::PARAM_STR);
        $prepare->bindValue(3, $customer->getContactPersonCustomer(), PDO::PARAM_STR);
        $prepare->bindValue(4, $customer->getMailCustomer(), PDO::PARAM_STR);
        $prepare->bindValue(5, $customer->getPhoneCustomer(), PDO::PARAM_STR);
        $prepare->bindValue(6, $customer->getIdCustomer(), PDO::PARAM_INT);

        try {

            $prepare->execute();

            // IF OKAY
            return true;

        } catch (Exception $e) {

            trigger_error($e->getMessage());

            // IF NOT
            return false;
        }
    }

    // SELECT ALL CUSTOMERS
    public function selectAllCustomers(): array {

        $sql = "SELECT * FROM customer ORDER BY id_customer DESC;";
        $query = $this->db->query($sql);

        // IF THERE IS AT LEAST 1 RESULT
        if ($query->rowCount()) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        // IF NOT
        return [];
    }

    // SELECT ONE CUSTOMER
    public function selectOneCustomer(int $idCustomer): array {
        $sql = "SELECT * FROM customer WHERE id_customer = ?";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([$idCustomer]);

            // IF THERE IS A RESULT
            if ($prepare->rowCount()) {

                return $prepare->fetch(PDO::FETCH_ASSOC);

            // IF NOT
            } else {
                return [];
            }

        } catch (Exception $e) {

            trigger_error($e->getMessage());
            // IF NOT
            return [];

        }
    }

    public function deleteCustomer(int $idCustomer) : bool {

        $sql = "DELETE FROM customer WHERE id_customer= ?";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([$idCustomer]);

            // IF OKAY
            return true;

        } catch (Exception $e) {

            trigger_error($e->getMessage());

            // IF NOT
            return false;
        }

    }
}