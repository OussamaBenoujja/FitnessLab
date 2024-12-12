


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
                capacity = $capacity,
                price = $price,
                schedule_time = $schedule_time ,
                status ENUM('Available', 'Unavailable') = $status

            WHERE activity_id =$activity_id";
    $conn->query($sql);
}
 
 
if (isset($_GET['delete_act'])) {
    $member_id = $_GET['delete_act'];
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
        <input type="text" name="activity_name" placeholder="Name" required>
        <input type="text" name="duration" placeholder="duration in hours">
        <input type="text" name="capacity" placeholder="capacity">
        <input type="text" name="price" placeholder="price in dollars">
        <textarea name="description" placeholder="descreption"></textarea>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select>

        <button type="submit" name="add_activity">Add Activity</button>
    </form>
 
    <h2>Member List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>activity</th>
            <th>duration</th>
            <th>capacity</th>
            <th>price$</th>
            <th>description</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['activity_id'] ?></td>
                <td><input type="text" name="name" value="<?= $row['activity_name'] ?>"></td>
                <td><input type="text" name="duration" value="<?= $row['duration'] ?>"></td>
                <td><input type="text" name="capacity" value="<?= $row['capacity'] ?>"></td>
                <td><input type="date" name="price" value="<?= $row['price'] ?>"></td>
                <td>
                    <select name="status">
                        <option value="Active" <?= $row['status'] == 'Avaible' ? 'Unavailable' : '' ?>>Avaible</option>
                        <option value="Inactive" <?= $row['status'] == 'Unavailable' ? 'Avaible' : '' ?>>Unavailable</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="activity_id" value="<?= $row['activity_id'] ?>">
                    <button type="submit" name="update_activity">Update</button>
                    <a href="?delete_act=<?= $row['activity_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>


