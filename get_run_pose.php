<?php
$conn = new mysqli("localhost", "root", "", "robot_arm_db");
$result = $conn->query("SELECT * FROM poses WHERE status = 1 ORDER BY id DESC LIMIT 1");
echo json_encode($result->fetch_assoc());
?>