<?php

require 'dbConf.php';


$reservations = $conn->query("SELECT Reservations.*, Activity.activity_name 
                              FROM Reservations 
                              JOIN Activity ON Reservations.activity_id = Activity.activity_id");
$activities = $conn->query("SELECT activity_id, activity_name FROM Activity");

if (isset($_POST['add_reservation'])) {
    $member_id = $_POST['member_id'];
    $activity_id = $_POST['activity_id'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Reservations (member_id, activity_id, reservation_date, reservation_time, status)
            VALUES ('$member_id', '$activity_id', '$reservation_date', '$reservation_time', '$status')";
    $conn->query($sql);
}

if (isset($_POST['update_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    $member_id = $_POST['member_id'];
    $activity_id = $_POST['activity_id'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $status = $_POST['status'];

    $sql = "UPDATE Reservations SET 
                member_id = '$member_id', 
                activity_id = '$activity_id', 
                reservation_date = '$reservation_date', 
                reservation_time = '$reservation_time', 
                status = '$status'
            WHERE reservation_id = $reservation_id";
    $conn->query($sql);
}

if (isset($_GET['delete_reservation'])) {
    $reservation_id = $_GET['delete_reservation'];
    $sql = "DELETE FROM Reservations WHERE reservation_id = $reservation_id";
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

    <title>Reservations Management</title>
</head>
<body>

    <h1>Reservations Dashboard</h1>

    <!-- reservation Form -->
    <h2>Add Reservation</h2>
    <form method="POST">
        <input type="text" name="member_id" placeholder="Member ID" required>
        <label for="activity_id">Select Activity:</label>
        <select name="activity_id" id="activity_id" required>
            <option value="">Select an activity</option>
            <?php while ($row = $activities->fetch_assoc()): ?>
                <option value="<?= $row['activity_id'] ?>"><?= $row['activity_name'] ?></option>
            <?php endwhile; ?>
        </select>
        <label for="reservation_date">Reservation Date:</label>
        <input type="date" name="reservation_date" required>
        <label for="reservation_time">Reservation Time:</label>
        <input type="time" name="reservation_time" required>
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <button type="submit" name="add_reservation">Add Reservation</button>
    </form>

    
    <h2>Reservations List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Member ID</th>
            <th>Activity</th>
            <th>Reservation Date</th>
            <th>Reservation Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $reservations->fetch_assoc()): ?>
        <tr>
            <form method="POST">
                <td><?= $row['reservation_id'] ?></td>
                <td><input type="text" name="member_id" value="<?= $row['member_id'] ?>"></td>
                <td>
                    <select name="activity_id" required>
                        <?php 
                        // Fetch all activities again for the dropdown
                        $activitiesDropdown = $conn->query("SELECT activity_id, activity_name FROM Activity");
                        while ($activity = $activitiesDropdown->fetch_assoc()): 
                        ?>
                            <option value="<?= $activity['activity_id'] ?>" <?= $activity['activity_id'] == $row['activity_id'] ? 'selected' : '' ?>>
                                <?= $activity['activity_name'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
                <td><input type="date" name="reservation_date" value="<?= $row['reservation_date'] ?>"></td>
                <td><input type="time" name="reservation_time" value="<?= $row['reservation_time'] ?>"></td>
                <td>
                    <select name="status">
                        <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Confirmed" <?= $row['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="Cancelled" <?= $row['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="reservation_id" value="<?= $row['reservation_id'] ?>">
                    <button type="submit" name="update_reservation">Update</button>
                    <a href="?delete_reservation=<?= $row['reservation_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
