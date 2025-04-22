<?php
// Database connection
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $room_price = $_POST['room_price'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $guests = $_POST['guests'];

    // Calculate the total price (for now, assume the price is per night)
    $arrival = new DateTime($arrival_date);
    $departure = new DateTime($departure_date);
    $interval = $arrival->diff($departure);
    $nights = $interval->days;
    $total_price = $nights * $room_price;

    // Insert data into the bookings table
    $sql = "INSERT INTO bookings (room_number, room_type, room_price, arrival_date, departure_date, guests, total_price, booking_status)
            VALUES ('$room_number', '$room_type', '$room_price', '$arrival_date', '$departure_date', '$guests', '$total_price', 'Pending')";


    if (mysqli_query($conn, $sql)) {
        // Success
        $notification_message = 'Booking confirmed successfully!';
        $is_success = true;
    } else {
        // Error
        $notification_message = 'Error: ' . mysqli_error($conn);
        $is_success = false;
    }
    
        // Close the database connection
        mysqli_close($conn);
    }
    
?>

<div id="notification" class="notification hidden">
    <p id="notification-message"></p>
</div>
