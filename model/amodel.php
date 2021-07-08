<?php

namespace Model;

defined('_Sdef') or exit();

class AModel
{
    /** @var mysqli|null $db */
    static protected ?\mysqli $db = null;

    public function __construct()
    {
        return self::connect();
    }

    public static function connect()
    {

        if (self::$db instanceof \mysqli) {
            return self::$db;
        }

        self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if (self::$db->connect_error) {
            throw new \Exception("Error connection : " . self::$db->connect_errno . '|' . self::$db->connect_error);
        }

        self::$db->query("SET NAMES 'UTF8'");

        return self::$db;
    }

    public function query($sql, $type = 'select')
    {

        if (!empty($sql)) {
            $result = self::$db->query($sql);
        }

        if (!$result) {
            throw new \Exception('Error query :' . self::$db->errno . '|' . self::$db->error);
            return FALSE;
        }

        switch ($type) {
            case 'select':

                $row = array();
                while ($r = $result->fetch_assoc()) {
                    $row[] = $r;
                }

                return $row;
                break;
        }
    }
}
