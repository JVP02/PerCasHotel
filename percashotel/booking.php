<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
    // Retrieve room details from URL parameters
    $room_number = isset($_GET['room_number']) ? $_GET['room_number'] : '';
    $room_price = isset($_GET['room_price']) ? $_GET['room_price'] : '';
    $room_type = isset($_GET['room_type']) ? $_GET['room_type'] : '';
    ?>

    <?php
    // booking.php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'hotelDB');
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Get form data
        $guest_name = $_POST['guest_name'];
        $room_id = $_POST['room_id'];
        $arrival_date = $_POST['arrival_date'];
        $departure_date = $_POST['departure_date'];
        $guests = $_POST['guests'];
        $total_price = $_POST['total_price']; // You can calculate this from room price * number of nights
    
        // Insert into bookings table
        $stmt = $conn->prepare("INSERT INTO bookings (guest_name, room_id, arrival_date, departure_date, guests, total_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissid", $guest_name, $room_id, $arrival_date, $departure_date, $guests, $total_price);
    
        if ($stmt->execute()) {
            echo "Booking successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }
    ?>

    

<section class="booking">
    <div class="section_container booking_container">
        <h2>Book Your Room</h2>
        <form action="process_booking.php" method="POST">
            <div class="input_group">
                <label for="room_number">Room Number</label>
                <input type="text" id="room_number" name="room_number" value="<?php echo $room_number; ?>" readonly>
            </div>
            <div class="input_group">
                <label for="room_type">Room Type</label>
                <input type="text" id="room_type" name="room_type" value="<?php echo $room_type; ?>" readonly>
            </div>
            <div class="input_group">
                <label for="room_price">Room Price ($)</label>
                <input type="text" id="room_price" name="room_price" value="<?php echo $room_price; ?>" readonly>
            </div>
            <div class="input_group">
                <label for="arrival_date">Arrival Date</label>
                <input type="date" id="arrival_date" name="arrival_date" required>
            </div>
            <div class="input_group">
                <label for="departure_date">Departure Date</label>
                <input type="date" id="departure_date" name="departure_date" required>
            </div>
            <div class="input_group">
                <label for="guests">Guests</label>
                <input type="number" id="guests" name="guests" required>
            </div>
            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
    </section>

    <div id="notification" class="notification hidden">
    <p id="notification-message"></p>
</div>

</body>
</html>

