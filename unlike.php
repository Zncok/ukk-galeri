<?php
include "koneksi.php";
session_start();

$likeid = $_GET['likeid'];

$sql = mysqli_query($conn, "delete from likefoto where likeid='$likeid'");

header("location:home.php");
