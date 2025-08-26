<?php
        // use PHPMailer\PHPMailer\Exception;
        // use PHPMailer\PHPMailer\PHPMailer;
        // use PHPMailer\PHPMailer\SMTP;

    function guidv4($data = null) {
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

    function sendMail($to, $subject, $body) {

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = "MIME-Version: 1.0\r\n";
        $headers[] = "X-Priority: 1\r\n";
   
        // En-têtes additionnels
        $headers[] = 'From: no-reply <no-reply@cyde.fr>';

        mail($to, $subject, $body, implode("\r\n", $headers));
    }

    function is_dev() {
        if($_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
            return true;
        }
        else {
            return false;
        }
    }

    function get_db_info() {
        $DB_SERVER = !is_dev() ? "127.0.0.1:3307" : "185.98.131.90";
        $DB_DATABASE = !is_dev() ? "coinn1465238" : "coinn1465238";
        $DB_USER = !is_dev() ? "root" : "coinn1465238";
        $DB_PASSWORD = !is_dev() ? "" : "mxvisuigu1";
        $DEBUG = !is_dev();

        return array(
            "DB_USER" => $DB_USER,
            "DB_PASSWORD" => $DB_PASSWORD,
            "DB_DSN" => "mysql:host=$DB_SERVER;dbname=$DB_DATABASE;charset=utf8",
            "DEBUG" => $DEBUG
        );
    }
?>