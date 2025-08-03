<?php
$conn = new mysqli("localhost", "root", "", "robot_arm_db");
$id = $_POST['id'];
$conn->query("DELETE FROM poses WHERE id = $id");
?>