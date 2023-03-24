<?php

session_start();
session_destroy();

header("location: ../views/users-login.php");
