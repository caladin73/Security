<?php
/**
 * DbHSec.inc.php
 * includes function for secure sessions
 * @author nml
 * @copyright (c) 2018, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once 'DbPSec.inc.php';

class DbHSec extends DbPSec {
    private static $instance = FALSE;
    private static $dbh;

    private function __construct() {            // singleton
        try {
            self::$dbh = new PDO(DbPSec::DSN, DbPSec::DBUSER, DbPSec::USERPWD);
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            printf("<p>Connect failed for following reason: <br/>%s</p>\n",
                $e->getMessage());
        }
    }

    public static function getDbH() {           // invoke singleton
        if (! self::$instance) {
            self::$instance = new DbHSec();
        }
        return self::$dbh;
    }

    function better_session_start() {
        /*
         * Inspired by https://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
         */
        // Forces sessions to only use cookies.
        if (!ini_set('session.use_only_cookies', true)) {
            header("Location: ".$_SERVER['HTTP_REFERER']."?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets and changes current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            self::SECURE,
            self::HTTP_ONLY);
        session_name(self::SESS_NAME);// Sets session name
        session_start();            // Start the PHP session
        session_regenerate_id();    // regenerated the session.
    }
}