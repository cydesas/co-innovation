<?php

namespace utils;

use DateTime;

class Common
{

    static function init()
    {

    }

    static function showError($message)
    {
        echo '    
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="ms-5 fa-solid fa-triangle-exclamation" style="color: darkred"></i>
            <div class="ms-3">'
                . $message .
            '</div>
        </div>';
    }

    static function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        //assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    static function sendMail($to, $subject, $body): bool
    {

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';

        // En-têtes additionnels
        $headers[] = 'From: no-reply <no-reply@cyde.fr>';

        return mail($to, $subject, $body, implode("\r\n", $headers));
    }

    static function is_dev()
    {
        if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "::1") {
            return true;
        } else {
            return false;
        }
    }

    static function get_db_info()
    {
        $DB_SERVER = Common::is_dev() ? "127.0.0.1:3306" : "185.98.131.90";
        $DB_DATABASE = Common::is_dev() ? "coinn1465238" : "coinn1465238";
        $DB_USER = Common::is_dev() ? "root" : "coinn1465238";
        $DB_PASSWORD = Common::is_dev() ? "" : "mxvisuigu1";
        $DEBUG = Common::is_dev();

        return array(
            "DB_USER" => $DB_USER,
            "DB_PASSWORD" => $DB_PASSWORD,
            "DB_DSN" => "mysql:host=$DB_SERVER;dbname=$DB_DATABASE;charset=utf8",
            "DEBUG" => $DEBUG
        );
    }

    /**
     * Cette fonction permet de convertir la date de publication vers une phrase du type "il y a x jours/ans"
     * @param $date
     */
    static function convertDate($date_creation)
    {

        $date = new DateTime($date_creation);
        $date_jour = new DateTime();
        $diff = $date_jour->diff($date);

        if ($diff->y === 0) {

            if ($diff->m === 0) {

                if ($diff->days === 0) {

                    if ($diff->h === 0) {

                        if ($diff->i === 0) {
                            return "Publiée il y a moins d'une minute";
                        } else {
                            return "Publiée il y a " . $diff->i . " minutes";
                        }

                    } else if ($diff->h === 1) {
                        return "Publiée il y a " . $diff->h . " heure";
                    } else {
                        return "Publiée il y a " . $diff->h . " heures";
                    }

                } else if ($diff->days === 1) {
                    return "Publiée il y a " . $diff->days . " jour";
                } else {
                    return "Publiée il y a " . $diff->days . " jours";
                }

            } else {
                return "Publiée il y a " . $diff->m . " mois";
            }

        } else if ($diff->y === 1) {
            return "Publiée il y a " . $diff->y . " an";
        } else {
            return "Publiée il y a " . $diff->y . " ans";
        }

    }

}