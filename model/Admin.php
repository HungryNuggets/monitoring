<?php

/**
 * Class Admin
 * Mapping of admin's table
 */
class Admin extends MappingTable {

    // PROPERTIES
    protected int $id_admin;
    protected string $nickname_admin;
    protected string $pwd_admin;
    protected string $mail_admin;
    protected int $status_admin;
    protected string $confirmation_key_admin;
    protected int $validation_status_admin;

    // GETTERS

    /**
     * $id_admin's getter
     * @return int
     */
    public function getIdAdmin(): int {
        return $this->id_admin;
    }

    /**
     * $nickname_admin's getter
     * @return string
     */
    public function getNicknameAdmin(): string {
        return $this->nickname_admin;
    }

    /**
     * $pwd_admin's getter
     * @return string
     */
    public function getPwdAdmin(): string {
        return $this->pwd_admin;
    }

    /**
     * $mail_admin's getter
     * @return string
     */
    public function getMailAdmin(): string {
        return $this->mail_admin;
    }

    /**
     * status_admin's getter
     * @return int
     */
    public function getStatusAdmin(): int {
        return $this->status_admin;
    }

    /**
     * $confirmation_key_admin's getter
     * @return string
     */
    public function getConfirmationKeyAdmin(): string {
        return $this->confirmation_key_admin;
    }

    /**
     * $validation_status_admin's getter
     * @return int
     */
    public function getValidationStatusAdmin(): int {
        return $this->validation_status_admin;
    }

    // SETTERS

    /**
     * $id_admin's setter
     * @param int $id_admin
     */
    public function setIdAdmin(int $id_admin): void {
        $id_admin = (int) $id_admin;
        if (empty($id_admin)) {
            trigger_error("The admin ID can't be 0", E_USER_NOTICE);
        } else {
            $this->id_admin = $id_admin;
        }
    }

    /**
     * $nickname_admin's setter
     * @param string $nickname_admin
     */
    public function setNicknameAdmin(string $nickname_admin): void {
        $nickname_admin = strip_tags(trim($nickname_admin));
        if (empty($nickname_admin)) {
            trigger_error("The admin nickname can't be empty", E_USER_NOTICE);
        } elseif (strlen($nickname_admin) > 50) {
            trigger_error("The admin nickname can't be longer than 50 characters", E_USER_NOTICE);
        } else {
            $this->nickname_admin = $nickname_admin;
        }
    }

    /**
     * $pwd_admin's setter
     * @param string $pwd_admin
     */
    public function setPwdAdmin(string $pwd_admin): void {
        $pwd_admin = strip_tags(trim($pwd_admin));
        if (empty($pwd_admin)) {
            trigger_error('The password cannot be empty', E_USER_NOTICE);
        } else if (strlen($pwd_admin) > 255) {
            trigger_error('The length of the password can\'t be over 255 characters', E_USER_NOTICE);
        } else {
            $this->pwd_admin = $pwd_admin;
        }
    }

    /**
     * $mail_admin's setter
     * @param string $mail_admin
     */
    public function setMailAdmin(string $mail_admin): void {
        if (!(filter_var($mail_admin, FILTER_VALIDATE_EMAIL))) {
            trigger_error("The e-mail address needs to be in the right format", E_USER_NOTICE);
        } else if (strlen($mail_admin) > 200) {
            trigger_error("The e-mail address can't be too long", E_USER_NOTICE);
        } else {
            $this->mail_admin = $mail_admin;
        }
    }

    /**
     * $status_admin's setter
     * @param int $status_admin
     */
    public function setStatusAdmin(int $status_admin): void {
        $status_admin = (int)$status_admin;
        if($status_admin === 1 || $status_admin === 2){
            $this->status_admin = $status_admin;
        } else {
            trigger_error("The status has to be 1 (Validated by an admin) or 2 (Not yet validated by an admin)",E_USER_NOTICE);
        }
    }

    /**
     * $confirmation_key_admin's setter
     * @param string $confirmation_key_admin
     */
    public function setConfirmationKeyAdmin(string $confirmation_key_admin): void {
        if (empty($confirmation_key_admin)) {
            trigger_error('The confirmation key cannot be empty', E_USER_NOTICE);
        } else if (strlen($confirmation_key_admin) > 60) {
            trigger_error('The length of the confirmation key can\'t be over 60 characters', E_USER_NOTICE);
        } else {
            $this->confirmation_key_admin = $confirmation_key_admin;
        }
    }

    /**
     * $validation_status_admin's setter
     * @param int $validation_status_admin
     */
    public function setValidationStatusAdmin(int $validation_status_admin): void {
        $status_admin = (int)$validation_status_admin;
        if($validation_status_admin === 1 || $validation_status_admin === 2){
            $this->validation_status_admin = $validation_status_admin;
        } else {
            trigger_error("The status has to be 1 (E-mail verified) or 2 (Not yet verified)",E_USER_NOTICE);
        }
    }
}