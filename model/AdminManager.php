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

    // SIGN IN
    public function signIn(Admin $admin) : bool {

        $query = "SELECT * FROM admin WHERE nickname_admin = ? ;";
        $req = $this->db->prepare($query);
        $req->bindValue(1, $admin->getNicknameAdmin(), PDO::PARAM_STR);

        try {
            $req->execute();

            // IF THERE IS A RESULT
            if ($req->rowCount()) {
                $connectedAdmin = $req->fetch(PDO::FETCH_ASSOC);
                if ($this->verifyPassword($connectedAdmin['pwd_admin'], $admin->getPwdAdmin())) {
                    $this->createSession($connectedAdmin);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // SIGN IN RIGHTS VERIFICATION
    public function signInRightVerification(Admin $admin): string {
        $sql = "SELECT nickname_admin, status_admin, validation_status_admin FROM admin WHERE nickname_admin = ? ;";
        $req = $this->db->prepare($sql);
        $req->bindValue(1,$admin->getNicknameAdmin(),PDO::PARAM_STR);
        try{
            $req->execute();
            if($req->rowCount()){
                $adminInfo = $req->fetch(PDO::FETCH_ASSOC);
                if ($adminInfo['validation_status_admin'] == 2 ){
                    return "Vous devez confirmer votre adresse e-mail avant de vous connecter";
                } else if ($adminInfo['status_admin'] == 2){
                    return "Un administrateur étudie votre demande, vous serez prévenu si votre compte est accepté";
                } else {
                    return "";
                }
            }else{
                return "Something went wrong, please retry";
            }
        }catch (PDOException $e){
            return $e->getMessage();
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

    // VERIFY PASSWORD
    protected function verifyPassword(string $cryptPwd, string $pwd): bool {
        return password_verify($pwd, $cryptPwd);
    }

    // SESSION
    protected function createSession(array $datas): bool {
        unset($datas['pwd_admin']);
        $_SESSION = $datas;
        $_SESSION['session_id'] = session_id();
        return true;
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

    // SELECT VALIDATED ADMIN
    public function selectValidatedAdmins(): array {
        $sql = "SELECT mail_admin FROM admin WHERE status_admin = ? AND validation_status_admin = ? ;";
        $prepare = $this->db->prepare($sql);

        try {

            $prepare->execute([1,1]);

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
    function updateAdminValidationStatus(string $admin, string $key) : bool {

        $sql = "UPDATE admin SET validation_status_admin= ? WHERE nickname_admin= ? AND confirmation_key_admin = ?; ";
        $prepare = $this->db->prepare($sql);

        $prepare->bindValue(1, 1, PDO::PARAM_INT);
        $prepare->bindValue(2, $admin, PDO::PARAM_STR);
        $prepare->bindValue(3, $key, PDO::PARAM_STR);

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