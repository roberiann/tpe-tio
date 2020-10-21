<?php

$pass = "0004";
$hash = password_hash($pass, PASSWORD_DEFAULT);

echo $hash;
