# 🤖 Robot Arm Control Panel

A simple web interface to control and save positions of a robotic arm using sliders and PHP/MySQL backend.

---

## 📌 Features

- Choose positions for 6 motors (0 to 180 degrees).
- Save each pose to a MySQL database.
- View all saved poses in a table.
- Load a pose into the sliders to re-edit or reuse it.
- Delete any pose from the database.

---

## 🛠️ Technologies Used

- *Frontend:* HTML, CSS, JavaScript
- *Backend:* PHP (no framework)
- *Database:* MySQL (via phpMyAdmin / XAMPP)

---

📁 Files Description

File	Description

index.php	Main UI to enter motor values and view data
save_pose.php	Saves a new pose to the database
load_pose.php	Loads a specific pose into sliders
delete_pose.php	Deletes a pose from the database

---

🧠 Notes

Data is ordered ascending (oldest pose at top)

---

✅ Example Use Case

1. Set motor values → Click "Save Pose"


2. Repeat to add multiple poses


3. Use "Load" to copy values back into sliders


4. Use "Remove" to delete a pose
