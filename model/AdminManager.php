<?php

/**
 * Class AdminManager
 * Manager for the admin table
 */
class AdminManager extends ManagerTable {

    // SIGN UP METHOD
    public function signUp(Admin $admin) : bool {

        // PASSWORD CRYPT
        $cryptPassword = $this->passwordHash($admin->getPwdUser());
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

        $sql = "SELECT * FROM user WHERE nickname_user = ? OR mail_user = ?;";

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
}