<?php
 
require 'dbConf.php';
 
 

$result = $conn->query("SELECT * FROM Member");

$res = $conn->query("SELECT * FROM Admin");

if (isset($_POST['add_member'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $join_date = $_POST['join_date'];
    $status = $_POST['status'];
 
    $sql = "INSERT INTO Member (name, email, phone_number, date_of_birth, price, schedule_time, status)
            VALUES ('$name', '$email', '$phone_number', '$date_of_birth', '$gender', '$address', '$join_date', '$status')";
    $conn->query($sql);
}
 
 
if (isset($_POST['update_member'])) {
    $member_id = $_POST['member_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $join_date = $_POST['join_date'];
    $status = $_POST['status'];
 
    $sql = "UPDATE Member SET 
                name='$name', 
                email='$email', 
                phone_number='$phone_number', 
                date_of_birth='$date_of_birth', 
                gender='$gender', 
                address='$address', 
                join_date='$join_date', 
                status='$status' 
            WHERE member_id=$member_id";
    $conn->query($sql);
}
 
 
if (isset($_GET['delete_member'])) {
    $member_id = $_GET['delete_member'];
    $sql = "DELETE FROM Member WHERE member_id=$member_id";
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

    <title>Admin</title>
</head>
<body>
 
    <h1 font='bold'>ADMIN DASHBOARD...</h1>
    <h2>Add Member</h2>
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


