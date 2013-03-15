<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'mail.php';
include_once 'config_mail.php';

$directory = realpath(dirname(__FILE__)) . '/email/';

$files = glob(rtrim($directory, '/') . '/*');

foreach ($files as $file) {
    $fileRead = fopen($file, "r");
    $dataJson = fread($fileRead, filesize($file));
    $data = json_decode($dataJson);

    $mail = new Mail();
    $mail->protocol = Constant::config_mail_protocol;
    $mail->parameter = Constant::config_mail_parameter;
    $mail->hostname = Constant::config_smtp_host;
    $mail->username = Constant::config_smtp_username;
    $mail->password = Constant::config_smtp_password;
    $mail->port = Constant::config_smtp_port;
    $mail->timeout = Constant::config_smtp_timeout;
    $mail->setTo($data->to);
    $mail->setFrom(Constant::config_email);
    $mail->setSender(Constant::config_name);
    $mail->setSubject(html_entity_decode($data->subject, ENT_QUOTES, 'UTF-8'));
    if ($data->text != '')
        $mail->setText(html_entity_decode($data->text, ENT_QUOTES, 'UTF-8'));
    elseif ($data->html != '')
        $mail->setHtml($data->html);
    $mail->send();

    unlink($file);
    fclose($fileRead);
}die;

function sendMail($data) {
    $mail = new Mail();
    $mail->protocol = Constant::config_mail_protocol;
    $mail->parameter = Constant::config_mail_parameter;
    $mail->hostname = Constant::config_smtp_host;
    $mail->username = Constant::config_smtp_username;
    $mail->password = Constant::config_smtp_password;
    $mail->port = Constant::config_smtp_port;
    $mail->timeout = Constant::config_smtp_timeout;
    $mail->setTo($data['to']);
    $mail->setFrom(Constant::config_email);
    $mail->setSender(Constant::config_name);
    $mail->setSubject(html_entity_decode($data['subject'], ENT_QUOTES, 'UTF-8'));
    $mail->setText(html_entity_decode($data[''], ENT_QUOTES, 'UTF-8'));
    $mail->send();
}

?>
