<?php
/**
 * DbPSec.inc.php
 * parameters for secure sessions and database connectivity
 * @author nml
 * @copyright (c) 2018, nml
 * @license http://www.fsf.org/licensing/ GPLv3
 */
abstract class DbPSec {
    // database connectivity
    const DBHOST = 'localhost';     // host
    const DBUSER = 'root';        // mysql user
    const USERPWD = '';         // mysql password
    const CHARSET = 'utf8';         // preferred charset
    const DB = 'yaddaSecVariant';   // current database
    const DSN = "mysql:host=".self::DBHOST.";dbname=".self::DB.";charset=".self::CHARSET;

    // secure sessions
    const SECURE = false;           // dev only, true in production
    const HTTP_ONLY = true;         // enforces cookie only sessions
    const SESS_NAME = 'nml42';      // application session name
}