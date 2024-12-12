CREATE DATABASE FitnessLab;
USE FitnessLab;
CREATE TABLE Member (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone_number VARCHAR(20),
    date_of_birth DATE,
    gender ENUM('Male', 'Female'),
    address TEXT,
    join_date DATE NOT NULL,é
    status ENUM('Active', 'Inactive') NOT NULL
);


CREATE TABLE Activity (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_name VARCHAR(255) NOT NULL,
    description TEXT,
    duration INT,
    capacity INT,
    price DECIMAL(10, 2),
    schedule_time TIME,
    status ENUM('Available', 'Unavailable') NOT NULL
);


CREATE TABLE Admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    role ENUM('Manager', 'Staff', 'SuperAdmin') NOT NULL
);

CREATE TABLE Reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    activity_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    status ENUM('Pending', 'Confirmed', 'Cancelled') NOT NULL,
    FOREIGN KEY (member_id) REFERENCES Member(member_id),
    FOREIGN KEY (activity_id) REFERENCES Activity(activity_id)
);

CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date DATE NOT NULL,
    payment_method ENUM('Cash', 'Credit Card', 'Online') NOT NULL,
    FOREIGN KEY (reservation_id) REFERENCES Reservations(reservation_id)
);

INSERT INTO Admin (username, password, email, role) VALUES ('admin', 'admin', 'osama2code79@gmail.com', 'Manager');


INSERT INTO Member (name, email, phone_number, date_of_birth, gender, address, join_date, status) 
VALUES
('mohhamed rabh', 'mohhamed@example.com', '1234567890', '1990-05-15', 'Male', 'hay el farah sidi slimane', '2023-12-01', 'Active'),
('jamal jamal', 'jamal@example.com', '0987654321', '1995-07-20', 'Male', 'safi lot nassara rue el moir 19', '2023-12-01', 'Active'),
('fatom fatima', 'fatima@example.com', '5551234567', '1988-03-10', 'Female', 'casa anfa hay wrida rue al mostagim 14', '2023-12-01', 'Inactive');


INSERT INTO Activity (activity_name, description, duration, capacity, price, schedule_time, status)
VALUES
('Yoga', 'A calming yoga session.', 60, 20, 15.00, '09:00:00', 'Available'),
('Treadmail', 'A Motorized jogging machine.', 45, 15, 20.00, '10:30:00', 'Available'),
('Aqua Aerobics', 'Practice aerobics in the pool.', 50, 25, 18.50, '11:00:00', 'Available');


INSERT INTO Reservations (member_id, activity_id, reservation_date, reservation_time, status)
VALUES
(1, 1, '2023-12-11', '09:00:00', 'Confirmed'),
(2, 2, '2023-12-11', '10:30:00', 'Confirmed'),
(3, 3, '2023-12-11', '11:00:00', 'Pending');


INSERT INTO Payments (reservation_id, amount, payment_date, payment_method)
VALUES
(1, 15.00, '2023-12-10', 'Credit Card'),
(2, 20.00, '2023-12-10', 'Online'),
(3, 0.00, '2023-12-10', 'Cash');

SELECT 
    Member.name AS MemberName,
    Member.email AS MemberEmail,
    Activity.activity_name AS ActivityName,
    Reservations.reservation_date AS ReservationDate,
    Reservations.reservation_time AS ReservationTime,
    Reservations.status AS ReservationStatus
FROM Reservations
INNER JOIN Member ON Reservations.member_id = Member.member_id
INNER JOIN Activity ON Reservations.activity_id = Activity.activity_id;


SELECT 
    Payments.payment_id AS PaymentID,
    Member.name AS MemberName,
    Activity.activity_name AS ActivityName,
    Payments.amount AS PaymentAmount,
    Payments.payment_date AS PaymentDate,
    Payments.payment_method AS PaymentMethod
FROM Payments
INNER JOIN Reservations ON Payments.reservation_id = Reservations.reservation_id
INNER JOIN Member ON Reservations.member_id = Member.member_id
INNER JOIN Activity ON Reservations.activity_id = Activity.activity_id;
