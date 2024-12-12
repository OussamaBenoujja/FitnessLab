<?php

require 'dbConf.php';

$result = $conn->query("SELECT * FROM Activity");

if (isset($_POST['add_activity'])) {
    $activity_name = $_POST['activity_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $schedule_time = $_POST['schedule_time'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Activity (activity_name, description, duration, capacity, price, schedule_time, status)
            VALUES ('$activity_name', '$description', '$duration', '$capacity', '$price', '$schedule_time', '$status')";
    $conn->query($sql);
}

if (isset($_POST['update_activity'])) {
    $activity_id = $_POST['activity_id'];
    $activity_name = $_POST['activity_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $schedule_time = $_POST['schedule_time'];
    $status = $_POST['status'];

    $sql = "UPDATE Activity SET 
                activity_name = '$activity_name',
                description = '$description',
                duration = '$duration',
                capacity = '$capacity',
                price = '$price',
                schedule_time = '$schedule_time',
                status = '$status'
            WHERE activity_id = $activity_id";
    $conn->query($sql);
}

if (isset($_GET['delete_act'])) {
    $activity_id = $_GET['delete_act'];
    $sql = "DELETE FROM Activity WHERE activity_id = $activity_id";
    $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        form input, form textarea, form select, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td input, td textarea, td select {
            width: 100%;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 4px;
            box-sizing: border-box;
        }

        td a {
            color: #ff4d4d;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #ffcccc;
        }

        td a:hover {
            background-color: #e60000;
            color: white;
        }

        /* Additional styling for responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            form input, form select, form textarea, form button {
                font-size: 14px;
            }

            table th, table td {
                font-size: 14px;
            }
        }
    </style>

    <title>Staff-Activities</title>
</head>
<body>

    <h1>ACTIVITIES DASHBOARD</h1>
    <h2>ACTIVITIES</h2>
    <form method="POST">
        <input type="text" name="activity_name" placeholder="Name" required>
        <input type="text" name="duration" placeholder="Duration in hours">
        <input type="text" name="capacity" placeholder="Capacity">
        <input type="text" name="price" placeholder="Price in dollars">
        <textarea name="description" placeholder="Description"></textarea>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select>
        <button type="submit" name="add_activity">Add Activity</button>
    </form>

    <h2>Activity List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Activity</th>
            <th>Duration</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['activity_id'] ?></td>
                <td><input type="text" name="activity_name" value="<?= $row['activity_name'] ?>"></td>
                <td><input type="text" name="duration" value="<?= $row['duration'] ?>"></td>
                <td><input type="text" name="capacity" value="<?= $row['capacity'] ?>"></td>
                <td><input type="text" name="price" value="<?= $row['price'] ?>"></td>
                <td><textarea name="description"><?= $row['description'] ?></textarea></td>
                <td>
                    <select name="status">
                        <option value="Available" <?= $row['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                        <option value="Unavailable" <?= $row['status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
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
