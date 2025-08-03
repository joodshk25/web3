<?php
$conn = new mysqli("localhost", "root", "", "robot_arm_db");
$id = $_POST['id'];

$result = $conn->query("SELECT * FROM poses WHERE id = $id");
$data = $result->fetch_assoc();

echo json_encode($data);
?>