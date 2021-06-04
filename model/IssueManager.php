<?php

/**
 * Class IssueManager
 * Manager for the issue table
 */
class IssueManager extends ManagerTable {

    // NEW ISSUE
    public function newIssue(string $desc, int $idCustomer): bool {

        // NEW DATE
        $newDate = new DateTime();

        // ISSUE INSERT
        $sql = "INSERT INTO monitoring_hungry_nuggets_issue (timestamp_issue, desc_issue, status_issue, customer_id_customer) VALUES (?,?,?,?)";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $newDate->format("Y-m-d H:i:s"), PDO::PARAM_STR);
        $prepare->bindValue(2, $desc, PDO::PARAM_STR);
        $prepare->bindValue(3, 2, PDO::PARAM_INT);
        $prepare->bindValue(4, $idCustomer, PDO::PARAM_INT);

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

    function updateIssue(int $admin, int $idIssue) : bool {

        $sql = "UPDATE monitoring_hungry_nuggets_issue SET status_issue = ?, admin_id_admin= ? WHERE id_issue=?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, 1, PDO::PARAM_INT);
        $prepare->bindValue(2, $admin, PDO::PARAM_INT);
        $prepare->bindValue(3, $idIssue, PDO::PARAM_INT);

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

    // SELECT ALL ISSUE (ORDER BY)
    public function selectAllIssue() : array {
        $sql = "SELECT issue.*, customer.*, admin.nickname_admin FROM monitoring_hungry_nuggets_issue AS issue 
                LEFT JOIN monitoring_hungry_nuggets_customer AS customer ON customer_id_customer = id_customer 
                LEFT JOIN monitoring_hungry_nuggets_admin AS admin ON admin_id_admin = id_admin
                ORDER BY status_issue DESC,
                timestamp_issue DESC;";
        $query = $this->db->query($sql);

        // IF THERE IS AT LEAST 1 RESULT
        if ($query->rowCount()) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        // IF NOT
        return [];
    }

    // SELECT ONGOING ISSUES
    public function selectOngoingIssue() : int {
        $sql = "SELECT * FROM monitoring_hungry_nuggets_issue 
                WHERE status_issue = 2;";
        $query = $this->db->query($sql);

        // RETURN THE NUMBER OF ONGOING ISSUES
        return $query->rowCount();
    }

    // SELECT THE ONGOING ISSUES
    public function ongoingIssue(int $id_customer) : bool {
        $sql = "SELECT * FROM monitoring_hungry_nuggets_issue WHERE customer_id_customer = ? AND status_issue = ?";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([$id_customer,2]);

            // IF THERE IS A RESULT
            if ($prepare->rowCount()) {

                return true;

                // IF NOT
            } else {
                return false;
            }

        } catch (Exception $e) {

            trigger_error($e->getMessage());
            // IF NOT
            return false;

        }
    }

}