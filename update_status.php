<?php
$conn = new mysqli("localhost", "root", "", "robot_arm_db");
$conn->query("UPDATE poses SET status = 0");
?>