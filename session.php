<?php
session_start();
require "function.php";

if (!isset($_SESSION['login'])){
    header("location: ../home.php");
    exit;
}
?>