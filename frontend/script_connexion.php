<?php
session_start();

$_SESSION['page'] = 'home';

$data = json_decode(file_get_contents('php://input'));
if (isset($data->login)) {
  $_SESSION['utilisateur'] = $data->login;
}
