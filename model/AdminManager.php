<?php

/**
 * Class AdminManager
 * Manager for the admin table
 */
class AdminManager extends ManagerTable {

    // SIGN UP METHOD
    public function signUp(Admin $admin) : bool {

        // PASSWORD CRYPT
        $cryptPassword = $this->passwordHash($admin->getPwdAdmin());
        // VALIDATION KEY
        $validationKey = $this->validationKey();

        // ADMIN INSERT
        $sql = "INSERT INTO admin (nickname_admin, pwd_admin, mail_admin, status_admin, confirmation_key_admin, validation_status_admin) VALUES (?,?,?,?,?,?)";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([
                $admin->getNicknameAdmin(),
                $cryptPassword,
                $admin->getMailAdmin(),
                2,
                $validationKey,
                2
            ]);

            // IF OKAY
            return true;

        } catch (Exception $e) {

            trigger_error($e->getMessage());

            // IF NOT
            return false;
        }
    }

    // SELECT DATAS FOR SIGN UP VERIFICATION
    public function selectSignUp(string $mail) : array {
        $sql = "SELECT nickname_admin, confirmation_key_admin FROM admin WHERE mail_admin = ? ;";
        $request = $this->db->prepare($sql);
        $request->execute([$mail]);
        // IF OKAY
        if ($request->rowCount()) {
            return $request->fetch(PDO::FETCH_ASSOC);
        }
        // IF NOT
        return [];
    }

    // AUTOMATICALLY GENERATED KEY
    protected function validationKey(): string {
        return md5(microtime(TRUE) * 100000);
    }

    // PASSWORD HASH
    protected function passwordHash(string $pwd): string {
        return password_hash($pwd, PASSWORD_DEFAULT);
    }

    // VERIFY EXISTENCE
    public function verifyExistence(string $nickname, string $mail): int {

        $sql = "SELECT * FROM admin WHERE nickname_admin = ? OR mail_admin = ?;";

        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $nickname, PDO::PARAM_STR);
        $prepare->bindValue(2, $mail, PDO::PARAM_STR);

        $prepare->execute();

        return $prepare->rowCount();
    }

    // DISCONNECTION
    public static function disconnection(): bool {

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        return true;
    }

    // UPDATE ADMIN'S MAIN INFOS
    function updateAdminInfos(Admin $admin) : bool {

        $sql = "UPDATE admin SET nickname_admin= ?, mail_admin= ? WHERE id_admin= ?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $admin->getNicknameAdmin(), PDO::PARAM_STR);
        $prepare->bindValue(2, $admin->getMailAdmin(), PDO::PARAM_STR);
        $prepare->bindValue(3, $admin->getIdAdmin(), PDO::PARAM_INT);

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

    // UPDATE ADMIN'S PASSWORD
    function updateAdminPassword(Admin $admin) : bool {

        // PASSWORD CRYPT
        $cryptPassword = $this->passwordHash($admin->getPwdAdmin());

        $sql = "UPDATE admin SET pwd_admin= ? WHERE id_admin= ?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, $cryptPassword, PDO::PARAM_STR);
        $prepare->bindValue(2, $admin->getIdAdmin(), PDO::PARAM_INT);

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

    // UPDATE ADMIN'S STATUS
    function updateAdminStatus(Admin $admin) : bool {

        $sql = "UPDATE admin SET status_admin= ? WHERE id_admin= ?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, 1, PDO::PARAM_INT);
        $prepare->bindValue(2, $admin->getIdAdmin(), PDO::PARAM_INT);

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

    // UPDATE ADMIN'S VALIDATION STATUS
    function updateAdminValidationStatus(Admin $admin) : bool {

        $sql = "UPDATE admin SET validation_status_admin= ? WHERE id_admin= ?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, 1, PDO::PARAM_INT);
        $prepare->bindValue(2, $admin->getIdAdmin(), PDO::PARAM_INT);

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

    // READ ALL
    public function selectAllAdmin() : array {

        $sql = "SELECT * FROM admin WHERE status_admin = ?";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([1]);

            // IF THERE IS AT LEAST ONE RESULT
            if ($prepare->rowCount()) {

                return $prepare->fetchAll(PDO::FETCH_ASSOC);

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
}