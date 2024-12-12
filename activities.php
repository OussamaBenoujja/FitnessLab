


<?php
 
require 'dbConf.php';
 
 

$result = $conn->query("SELECT * FROM Activity");

$res = $conn->query("SELECT * FROM Admin");



if (isset($_POST['add_activity'])) {

    $activity_name  = $_POST['activity_name'];
    $description = $_POST['description'];
    $duration  = $_POST['duration'];
    $capacity  = $_POST['capacity'];
    $price = $_POST['price'];
    $schedule_time  = $_POST['schedule_time'];
    $status = $_POST['status'];
 
    $sql = "INSERT INTO Activity (activity_name , description, duration, capacity, price, schedule_time, status)
            VALUES ('$activity_name ', '$description ', '$duration', '$capacity', '$price', '$schedule_time', '$status')";
    $conn->query($sql);
}
 
 
if (isset($_POST['update_activity'])) {
    $activity_id  = $_POST['activity_id '];
    $activity_name  = $_POST['activity_name'];
    $description = $_POST['description'];
    $duration  = $_POST['duration'];
    $capacity  = $_POST['capacity'];
    $price = $_POST['price'];
    $schedule_time  = $_POST['schedule_time'];
    $status = $_POST['status'];
 
    $sql = "UPDATE Activity SET 

                activity_id = $activity_id
                activity_name = $activity_name,
                description = $description,
                duration = $duration,
                capacity = ,
                price = $price,
                schedule_time = $schedule_time ,
                status ENUM('Available', 'Unavailable') = $status

            WHERE activity_id =$activity_id";
    $conn->query($sql);
}
 
 
if (isset($_GET['delete_member'])) {
    $member_id = $_GET['delete_member'];
    $sql = "DELETE FROM Activity WHERE activity_id =$activity_id";
    $conn->query($sql);
}
 
 

 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff-Activities</title>
</head>
<body>
 
    <h1 font='bold'>ACTIVITIES DASHBOARD...</h1>
    <h2>ACTIVITIES</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone_number" placeholder="Phone Number">
        <input type="date" name="date_of_birth" placeholder="Date of Birth">
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <textarea name="address" placeholder="Address"></textarea>
        <input type="date" name="join_date" required>
        <select name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <button type="submit" name="add_member">Add Member</button>
    </form>
 
    <h2>Member List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Join Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['member_id'] ?></td>
                <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                <td><input type="email" name="email" value="<?= $row['email'] ?>"></td>
                <td><input type="text" name="phone_number" value="<?= $row['phone_number'] ?>"></td>
                <td><input type="date" name="date_of_birth" value="<?= $row['date_of_birth'] ?>"></td>
                <td>
                    <select name="gender">
                        <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </td>
                <td><textarea name="address"><?= $row['address'] ?></textarea></td>
                <td><input type="date" name="join_date" value="<?= $row['join_date'] ?>"></td>
                <td>
                    <select name="status">
                        <option value="Active" <?= $row['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Inactive" <?= $row['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                    <button type="submit" name="update_member">Update</button>
                    <a href="?delete_member=<?= $row['member_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>


