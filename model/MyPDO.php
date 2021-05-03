<?php

/**
 * Class myPDO extends PDO (Singleton)
 */
class myPDO extends PDO {

    // SINGLETON
    private static $instance = null;

    public function __construct($dsn, $username = null, $password = null, $error = null) {
        // CONSTRUCT OF PDO
        parent::__construct($dsn, $username, $password);
        // WHEN ERRORS OCCUR
        if ($error === true) {
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    // GET A UNIQUE INSTANCE
    public static function getInstance($dsn, $username = null, $password = null, $error = null) {

        // CREATION
        if (is_null(self::$instance)) {
            self::$instance = new MyPDO($dsn, $username, $password, $error);
        }

        // CALL
        return self::$instance;
    }
}