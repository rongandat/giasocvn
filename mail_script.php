<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = 'chk2012';
    $data = $_POST;
    if ($data['server_password'] != $password) {
        echo 'password incorrect';
        die;
    }
    $dataJson['to'] = $data['to'];
    $dataJson['sender'] = $data['sender'];
    $dataJson['subject'] = $data['subject'];
    $dataJson['text'] = $data['text'];
    $dataJson['html'] = $data['html'];
    $filePath = realpath(dirname(__FILE__)) . '/email/';
    if (!is_dir($filePath)) {
        mkdir($filePath, 0777, true);
    }
    $file = $filePath . uniqid() . '_data.txt';
    $fp = fopen($file, 'w');
    fwrite($fp, json_encode($dataJson));
    fclose($fp);
}
?>
