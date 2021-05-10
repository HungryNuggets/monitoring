<?php

/**
 * Class IssueManager
 * Manager for the issue table
 */
class IssueManager extends ManagerTable {

    // NEW ISSUE
    public function newIssue(Issue $issue, int $idCustomer): bool {

        // NEW DATE
        $newDate = new DateTime();

        // ISSUE INSERT
        $sql = "INSERT INTO issue (timestamp_issue, desc_issue, status_issue, customer_id_customer) VALUES (?,?,?,?)";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $newDate->format("Y-m-d H:i:s"), PDO::PARAM_STR);
        $prepare->bindValue(2, $issue->getDescIssue(), PDO::PARAM_STR);
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

        $sql = "UPDATE issue SET status_issue = ?, admin_id_admin= ? WHERE id_issue=?; ";
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
        $sql = "SELECT issue.*, customer.*, admin.nickname_admin FROM issue 
                LEFT JOIN customer ON customer_id_customer = id_customer 
                LEFT JOIN admin ON admin_id_admin = id_admin
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

}