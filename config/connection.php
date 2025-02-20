<?php

require_once('createdb.php');
//connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NagarDB";

//create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// admin start
//creating table for Admin 
$sql = "CREATE TABLE IF NOT EXISTS admin(
    a_id INT PRIMARY KEY AUTO_INCREMENT,
    a_name VARCHAR(30) NOT NULL,
    a_role VARCHAR(30) NOT NULL,
    a_email VARCHAR(30) NOT NULL,
    a_phone BIGINT(10) NOT NULL,
    a_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully, no need to echo anything
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Inserting default admin data
// Hash the password
$hashed_password = password_hash('admin123', PASSWORD_BCRYPT);

// SQL Query
$sql = "INSERT IGNORE INTO admin (a_id, a_name,a_role, a_email, a_phone, a_password) 
        VALUES ('101', 'Admin','admin', 'admin@gmail.com', '9880922648', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
    // Data inserted successfully
} else {
    echo "Error Inserting data: " . mysqli_error($conn);
}

// Admin End



// For vehicle registration
// Creating table for vehicle_categories
$sql = "CREATE TABLE IF NOT EXISTS vehicle_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    vehicle_type VARCHAR(255) NOT NULL,  -- EV, Petrol, Diesel, CNG
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Creating table for vehicle_company
$sql = "CREATE TABLE IF NOT EXISTS vehicle_company (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(255) NOT NULL,
    headquarter VARCHAR(255) NOT NULL,
    global_presence BOOLEAN DEFAULT 0, -- Changed to BOOLEAN with default value 0 (false)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}


// Creating table for Vehicle
$sql = "CREATE TABLE IF NOT EXISTS vehicle (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_company_id INT NOT NULL,
    brand VARCHAR(255) NOT NULL,   
    vehicle_category_id INT NOT NULL,   
    color VARCHAR(255) NOT NULL,   
    vehicle_number VARCHAR(255) NOT NULL UNIQUE,  -- Ensuring uniqueness for vehicle numbers
    thumb_image VARCHAR(255) NOT NULL,   
    description LONGTEXT NOT NULL,
    bill_book_expiry_date DATE NOT NULL,  -- Renamed for clarity
    bill_book_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_company_id) REFERENCES vehicle_company(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_category_id) REFERENCES vehicle_category(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Creating table for User(passanger) Registration
$sql = "CREATE TABLE IF NOT EXISTS passanger (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    -- role VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,  
    password VARCHAR(255) NOT NULL,
    phone BIGINT(10) NOT NULL,
    status INT DEFAULT 1,  -- Changed from ENUM to INT with default 0
    cancel_status INT DEFAULT 0,
    dob DATE NOT NULL,
    gender ENUM('MALE', 'FEMALE', 'OTHERS') NOT NULL,
    image VARCHAR(255),   
    -- experience TEXT,   
    -- location LONGTEXT NOT NULL,
    address TEXT,  -- Added address column
    -- workinghour VARCHAR(255),   
    -- dlnumber VARCHAR(255),   
    -- vehicle_id INT,
    otp VARCHAR(10) NOT NULL,  -- Added OTP column
    otp_expiry DATETIME NOT NULL,  -- Added OTP expiry column
    is_verified BOOLEAN DEFAULT 0,  -- Added is_verified column
    -- FOREIGN KEY (vehicle_id) REFERENCES vehicle(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Creating table for User(Driver) Registration
$sql = "CREATE TABLE IF NOT EXISTS driver (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'driver', -- this is the case when the driver want to book a ride so his/her role will be changed to user automatically and s/he will be alloweded to book a ride.
    email VARCHAR(50) NOT NULL,  
    password VARCHAR(255) NOT NULL,
    phone BIGINT(10) NOT NULL,
    status INT DEFAULT 1,  -- Changed from ENUM to INT with default 0
    cancel_status INT DEFAULT 0,
    dob DATE NOT NULL,
    gender ENUM('MALE', 'FEMALE', 'OTHERS') NOT NULL,
    image VARCHAR(255),   
    experience TEXT,   
    -- location LONGTEXT NOT NULL,
    address TEXT,  -- Added address column
    working_hour VARCHAR(255),   
    dl_number VARCHAR(255),   
    dl_expiry_date DATE,   
    vehicle_id INT,
    otp VARCHAR(10) NOT NULL,  -- Added OTP column
    otp_expiry DATETIME NOT NULL,  -- Added OTP expiry column
    is_verified BOOLEAN DEFAULT 0,  -- Added is_verified column
    FOREIGN KEY (vehicle_id) REFERENCES vehicle(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Creating table for Notifications
$sql = "CREATE TABLE IF NOT EXISTS notification (
    id INT PRIMARY KEY AUTO_INCREMENT,
    message VARCHAR(255) NOT NULL,
    user_id INT NULL,
    driver_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES passanger(id) ON DELETE SET NULL,
    FOREIGN KEY (driver_id) REFERENCES driver(id) ON DELETE SET NULL
);
";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}

// Creating table for notification
$sql = "CREATE TABLE IF NOT EXISTS booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pick_up_place VARCHAR(255) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    estimated_cost DECIMAL(10,2) NOT NULL,
    estimated_ride_duration VARCHAR(50) NOT NULL, -- Duration of the ride (days/hours)
    booking_date DATE NOT NULL,
    rating DECIMAL(3,1) NULL, -- Allows decimal ratings like 4.5, 3.0
    booking_description TEXT NOT NULL,
    status INT DEFAULT 0,  -- Default status set to 0
    booking_end_datetime DATETIME NULL DEFAULT NULL, -- Nullable if not known at booking time
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    // Table created successfully
} else {
    echo "Error Creating table: " . mysqli_error($conn);
}




?>