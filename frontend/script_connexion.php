<?php
session_start();

$_SESSION['page'] = 'track_food';

$data = json_decode(file_get_contents('php://input'));
if (isset($data->login)) {
  $_SESSION['utilisateur'] = $data->login;
}
