<?php
$conn = new mysqli("localhost", "root", "", "robot_arm_db");

$m1 = $_POST['motor1'];
$m2 = $_POST['motor2'];
$m3 = $_POST['motor3'];
$m4 = $_POST['motor4'];
$m5 = $_POST['motor5'];
$m6 = $_POST['motor6'];

$stmt = $conn->prepare("INSERT INTO poses (motor1, motor2, motor3, motor4, motor5, motor6) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiii", $m1, $m2, $m3, $m4, $m5, $m6);
$stmt->execute();
?>