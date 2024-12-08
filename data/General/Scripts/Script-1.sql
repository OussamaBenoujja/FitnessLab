

USE gym_management;

-- Step 2: Create the Tables

-- Members Table
CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(15),
    date_of_birth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    address TEXT,
    join_date DATE DEFAULT CURRENT_DATE,
    status ENUM('Active', 'Inactive') DEFAULT 'Active'
);

-- Activities Table
CREATE TABLE activities (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    activity_name VARCHAR(100) NOT NULL,
    description TEXT,
    duration INT NOT NULL, -- Duration in minutes
    capacity INT NOT NULL, -- Max participants
    price DECIMAL(10, 2) NOT NULL, -- Cost per session
    schedule_time TIME NOT NULL,
    status ENUM('Available', 'Unavailable') DEFAULT 'Available'
);

-- Reservations Table (For Activities)
CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    activity_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL DEFAULT 0, -- Total price for the reservation
    status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE CASCADE,
    FOREIGN KEY (activity_id) REFERENCES activities(activity_id) ON DELETE CASCADE
);

-- Equipments Table
CREATE TABLE equipments (
    equipment_id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_name VARCHAR(100) NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    usage_fee DECIMAL(10, 2) NOT NULL, -- Cost for equipment usage
    status ENUM('Available', 'In Use', 'Under Maintenance') DEFAULT 'Available'
);

-- Equipment Reservations Table
CREATE TABLE equipment_reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    equipment_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL DEFAULT 0, -- Total price for the reservation
    status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE CASCADE,
    FOREIGN KEY (equipment_id) REFERENCES equipments(equipment_id) ON DELETE CASCADE
);

-- Admins Table
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('Super Admin', 'Admin') DEFAULT 'Admin'
);

-- Logs Table
CREATE TABLE logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    details TEXT,
    FOREIGN KEY (admin_id) REFERENCES admins(admin_id) ON DELETE CASCADE
);

-- Payments Table
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL, -- Can be an activity or equipment reservation
    amount DECIMAL(10, 2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method ENUM('Cash', 'Credit Card', 'Online') DEFAULT 'Online',
    FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id) ON DELETE CASCADE
);

-- Step 3: Add Indexes (Optional for Optimization)
CREATE INDEX idx_member_email ON members(email);
CREATE INDEX idx_activity_name ON activities(activity_name);
CREATE INDEX idx_equipment_name ON equipments(equipment_name);

-- Database with pricing and payments is ready for use.

