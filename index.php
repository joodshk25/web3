<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Robot Arm Control Panel</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    input[type=range] { width: 300px; }
    table { border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 10px; text-align: center; }
    button { padding: 5px 10px; }
  </style>
</head>
<body>

<h2>Robot Arm Control Panel</h2>

<div id="sliders">
  <?php
    for ($i = 1; $i <= 6; $i++) {
      echo "Motor $i: <input type='range' id='m$i' min='0' max='180' value='90' oninput='updateLabel($i)'>
            <span id='label$i'>90</span><br><br>";
    }
  ?>
</div>

<button onclick="reset()">Reset</button>
<button onclick="savePose()">Save Pose</button>
<button onclick="runPose()">Run</button>

<h3>Saved Poses</h3>
<table>
  <tr>
    <th>#</th><th>Motor 1</th><th>Motor 2</th><th>Motor 3</th>
    <th>Motor 4</th><th>Motor 5</th><th>Motor 6</th><th>Action</th>
  </tr>
  <?php
    $conn = new mysqli("localhost", "root", "", "robot_arm_db");
    $result = $conn->query("SELECT * FROM poses ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['motor1']}</td>
        <td>{$row['motor2']}</td>
        <td>{$row['motor3']}</td>
        <td>{$row['motor4']}</td>
        <td>{$row['motor5']}</td>
        <td>{$row['motor6']}</td>
        <td>
          <button onclick='loadPose({$row['id']})'>Load</button>
          <button onclick='removePose({$row['id']})'>Remove</button>
        </td>
      </tr>";
    }
    $conn->close();
  ?>
</table>

<script>
  function updateLabel(i) {
    document.getElementById("label" + i).textContent = document.getElementById("m" + i).value;
  }

  function reset() {
    for (let i = 1; i <= 6; i++) {
      document.getElementById("m" + i).value = 90;
      updateLabel(i);
    }
  }

  function savePose() {
    let formData = new URLSearchParams();
    for (let i = 1; i <= 6; i++) {
      formData.append("motor" + i, document.getElementById("m" + i).value);
    }

    fetch("save_pose.php", {
      method: "POST",
      body: formData
    }).then(() => location.reload());
  }

  function loadPose(id) {
    fetch("load_pose.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + id
    })
    .then(res => res.json())
    .then(data => {
      for (let i = 1; i <= 6; i++) {
        document.getElementById("m" + i).value = data["motor" + i];
        updateLabel(i);
      }
    });
  }

  function removePose(id) {
    fetch("remove_pose.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "id=" + id
    }).then(() => location.reload());
  }

  function runPose() {
    fetch("update_status.php", { method: "POST" }) // reset status
    .then(() => {
      let formData = new URLSearchParams();
      for (let i = 1; i <= 6; i++) {
        formData.append("motor" + i, document.getElementById("m" + i).value);
      }
      fetch("save_pose.php", {
        method: "POST",
        body: formData
      }).then(() => location.reload());
    });
  }
</script>

</body>
</html>