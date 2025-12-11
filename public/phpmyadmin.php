<?php
$params = [
    'db' => 'iccv1',
    'pma_username' => 'root',
    'pma_password' => ''
];

$url = 'http://localhost/phpmyadmin/index.php?' . http_build_query($params);
header('Location: ' . $url);