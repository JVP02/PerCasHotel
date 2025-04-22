<?php
// Handle form submission
$rooms = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hotel_booking');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $guests = $_POST['guests'];

    // Query rooms from hotel_booking database, filter by room_capacity only if guests are provided
    $sql = "SELECT * FROM hotel_booking.roomlist";
    
    // Apply guest filter only if guests are set
    if (!empty($guests)) {
        $sql .= " WHERE room_capacity >= ?";
    }

    $stmt = $conn->prepare($sql);

    // Bind the guest parameter only if guests are specified
    if (!empty($guests)) {
        $stmt->bind_param("i", $guests);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch rooms
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    $stmt->close();
    $conn->close();
} else {
    // If no form submission, fetch all rooms
    $conn = new mysqli('localhost', 'root', '', 'hotel_booking');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM hotel_booking.roomlist";  // Fetch all rooms
    $result = $conn->query($sql);

    // Fetch rooms
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    $conn->close();
}
?>


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
    <nav>
        <div class="nav_bar">
            <div class="nav_header">
                <div class="nav_logo">
                    <div>PH</div>
                    <span>Percas <br> Hotel</span>
                </div>
                <div class="nav_menu_btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav_links" id="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#room">Room</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>

            </ul>
        </div>
    </nav>

    <header class="header" id="home">
        <div class="section_container header_container">
            <p class="section_subheader">About Us</p>
            <h1>The Perfect <br> Base For Ypu</h1>
            <button class="btn">Take A Tour</button>
        </div>
    </header>

    <section class="booking">
        <div class="section_container booking_container">
            <form action="" method="POST">
                <div class="input_group">
                    <label for="arrival">Arrival Date</label>
                    <input type="date" id="arrival" name="arrival_date" placeholder="Your Arrival Date" required>
                </div>
                <div class="input_group">
                    <label for="departure">Departure Date</label>
                    <input type="date" id="departure" name="departure_date" placeholder="Your Departure Date" required>
                </div>
                <div class="input_group">
                    <label for="guests">Guests</label>
                    <input type="number" id="guests" name="guests" placeholder="No of Guests" required>
                </div>
                <button type="submit" class="btn">Check Availability</button>
            </form>
        </div>
    </section>

    <?php if (!empty($rooms)): ?>
    <section class="room_container" id="room">
    <p class="section_subheader">ROOMS</p>
    <h2 class="section_header">Available Rooms</h2>
    <div class="room_grid">
        <?php foreach ($rooms as $room): ?>
            <div class="room_card">
                <img src="assets/rooms/<?php echo htmlspecialchars($room['room_img']); ?>" alt="room">
                <div class="room_card_detail">
                    <div>
                        <h4><?php echo htmlspecialchars($room['room_type']); ?></h4>
                        <p><?php echo htmlspecialchars($room['room_desc']); ?></p>
                    </div>
                    <h3>$<?php echo htmlspecialchars($room['room_price']); ?> <span>/night</span></h3>
                    <a href="booking.php?room_number=<?php echo htmlspecialchars($room['room_number']); ?>&room_price=<?php echo htmlspecialchars($room['room_price']); ?>&room_type=<?php echo urlencode($room['room_type']); ?>" class="btn">Book Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </section>
<?php endif; ?>


    <section class="about" id="about">
        <div class="section_container about_container">
            <div class="about_grid">
                <div class="about_image">
                    <img src="assets/about-1.jpg" alt="about">
                </div>
                <div class="about_card">
                    <span><i class="ri-user-line"></i></span>
                    <h4>Strong Team</h4>
                    <p>
                        Unlocking Hospitality Excellence and Ensures Your Perfect Stay
                    </p>
                </div>
                <div class="about_image">
                    <img src="assets/about-2.jpg" alt="about">
                </div>
                <div class="about_card">
                    <span><i class="ri-calendar-check-line"></i></span>
                    <h4>Strong Team</h4>
                    <p>
                        Unlocking Hospitality Excellence and Ensures Your Perfect Stay
                    </p>
                </div>
            </div>
            <div class="about_content">
                <p class="section_subheader">ABOUT US</p>
                <h2 class="section_header">Discover Our Undergrounds</h2>
                <p class="section_description">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe amet sit iste voluptates voluptatibus. Quas nobis aperiam facere, quibusdam sit modi excepturi deleniti quidem, consequatur non impedit ea officia molestiae?
                </p>
                <button class="btn">Book Now</button>
            </div>
        </div>
    </section>


    <!-- <section class="room_container" id="room">
        <p class="section_subheader">ROOMS</p>
        <h2 class="section_header">Available Rooms</h2>
        <div class="room_grid">
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="room_card">
                        <img src="assets/<?php echo htmlspecialchars($room['room_img']); ?>" alt="room">
                        <div class="room_card_detail">
                            <div>
                                <h4><?php echo htmlspecialchars($room['room_type']); ?></h4>
                                <p><?php echo htmlspecialchars($room['room_desc']); ?></p>
                            </div>
                            <h3>$<?php echo htmlspecialchars($room['room_price']); ?> <span>/night</span></h3>
                            <a id="book-btn-<?php echo htmlspecialchars($room['room_number']); ?>" 
                                href="booking.php?room_number=<?php echo htmlspecialchars($room['room_number']); ?>&room_price=<?php echo htmlspecialchars($room['room_price']); ?>&room_type=<?php echo urlencode($room['room_type']); ?>" 
                                class="btn">Book Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No rooms available for the selected criteria.</p>
            <?php endif; ?>
        </div>
    </section> -->

    

    <section class="intro">
        <div class="section_container intro_container">
            <div class="intro_content">
                <p class="section_subheader">Intro Video</p>
                <h2 class="section_header">Meet with Our Luxury Place</h2>
                <p class="section_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto adipisci sint illo reprehenderit aut molestiae sunt eligendi nostrum blanditiis. Adipisci quae blanditiis aut dignissimos accusamus, praesentium veritatis libero inventore totam.</p>
                <button class="btn">Book Now</button>
            </div>
            <div class="intro_video">
                <video src="assets/luxury.mp4" autoplay muted loop></video>
            </div>
        </div>
    </section>

    <section class="section_container feature_container" id="feature">
        <p class="section_subheader">FACILITIES</p>
        <h2 class="section-header">Core Features</h2>
        <div class="feature_grid">
            <div class="feature_card">
                <span><i class="ri-thumb-up-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>

            <div class="feature_card">
                <span><i class="ri-time-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>

            <div class="feature_card">
                <span><i class="ri-thumb-up-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>

            <div class="feature_card">
                <span><i class="ri-thumb-up-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>

            <div class="feature_card">
                <span><i class="ri-time-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>
            
            <div class="feature_card">
                <span><i class="ri-thumb-up-line"></i></span>
                <h4>Have High Rating</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi esse cupiditate labore minus neque numquam quo, praesentium unde harum nam provide</p>
            </div>
        </div>
    </section>

    <section class="menu" id="menu">
        <div class="section_container menu_container">
            <div class="menu_header">
                <div>
                    <p class="section_subheader">Menu</p>
                    <h2 class="section_header">Our Food Menu</h2>
                </div>
                <div class="section_nav">
                    <span><i class="ri-arrow-left-line"></i></span>
                    <span><i class="ri-arrow-right-line"></i></span>
                </div>
            </div>
            <ul class="menu_items">
                <li>
                    <img src="assets/menu-1.jpg" alt="menu">
                    <div class="menu-details">
                        <h4>Eggs & Bacon</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </li>

                <li>
                    <img src="assets/menu-1.jpg" alt="menu">
                    <div class="menu-details">
                        <h4>Eggs & Bacon</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </li>

                <li>
                    <img src="assets/menu-1.jpg" alt="menu">
                    <div class="menu-details">
                        <h4>Eggs & Bacon</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </li>

                <li>
                    <img src="assets/menu-1.jpg" alt="menu">
                    <div class="menu-details">
                        <h4>Eggs & Bacon</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </li>

                <li>
                    <img src="assets/menu-1.jpg" alt="menu">
                    <div class="menu-details">
                        <h4>Eggs & Bacon</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </li>
            </ul>
            <div class="menu_images">
                <img src="assets/menu-7.jpg" alt="menu">
                <img src="assets/menu-8.jpg" alt="menu">
                <img src="assets/menu-9.jpg" alt="menu">
            </div>
            <ul class="menu_banner">
                <li>
                    <span><i class="ri-file-text-line"></i></span>
                    <h4>84k</h4>
                    <p>Projects are Completed</p>
                </li>

                <li>
                    <span><i class="ri-file-text-line"></i></span>
                    <h4>84k</h4>
                    <p>Projects are Completed</p>
                </li>

                <li>
                    <span><i class="ri-file-text-line"></i></span>
                    <h4>84k</h4>
                    <p>Projects are Completed</p>
                </li>

                <li>
                    <span><i class="ri-file-text-line"></i></span>
                    <h4>84k</h4>
                    <p>Projects are Completed</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="section_container news_container" id="news">
        <div class="news_header">
            <div>
                <p class="section_subheader">BLOG</p>
                <h2 class="section_header">News Feed</h2>
            </div>
            <div class="section_nav">
                <span><i class="ri-arrow-left-line"></i></span>
                <span><i class="ri-arrow-right-line"></i></span>
            </div>
        </div>
        <div class="news_grid">
            <div class="news_card">
                <img src="assets/news-1.jpg" alt="news">
                <div class="news_card_title">
                    <p>24th January 2024</p>
                    <p>By Castillo</p>
                </div>
                <h4>Exploring Culinary Gems</h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis ill
                </p>
            </div>

            <div class="news_card">
                <img src="assets/news-2.jpg" alt="news">
                <div class="news_card_title">
                    <p>24th January 2024</p>
                    <p>By Castillo</p>
                </div>
                <h4>Exploring Culinary Gems</h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis ill
                </p>
            </div>

            <div class="news_card">
                <img src="assets/news-3.jpg" alt="news">
                <div class="news_card_title">
                    <p>24th January 2024</p>
                    <p>By Castillo</p>
                </div>
                <h4>Exploring Culinary Gems</h4>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis ill
                </p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="section_container footer_container">
            <div class="footer_col">
                <div class="logo footer_logo">
                    <div>H</div>
                    <span>PERCAS <br>HOTEL</span>
                </div>
                <p class="section_description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi illo reprehenderit nemo vero sequi. Quo repudiandae veniam error, ducimus nostrum aperiam modi esse, id enim perspiciatis dignissimos architecto voluptas ab.
                </p>
                <ul class="footer_socials">
                    <li><a href="#"><i class="ri-youtube-line"></i></a></li>
                </ul>

                <ul class="footer_socials">
                    <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                </ul>

                <ul class="footer_socials">
                    <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                </ul>
            </div>
            <div class="footer_col">
                <h4>Service</h4>
                <div class="footer_links">
                    <li><a href="#">Online Booking</a></li>
                    <li><a href="#">Virtual Tools</a></li>
                    <li><a href="#">Special Offers</a></li>
                    <li><a href="#">Customer Support</a></li>
                </div>
            </div>
            <div class="footer_col">
                <h4>Contact Us</h4>
                <div class="footer_links">
                    <li>
                        <span><i class="ri-phone-line"></i></span>
                        <div>
                            <h5>Phone Number</h5>
                            <p>+639122345678</p>
                        </div>
                    </li>

                    <li>
                        <span><i class="ri-mail-line"></i></span>
                        <div>
                            <h5>Email</h5>
                            <p>percashotel@gmail.com</p>
                        </div>
                    </li>

                    <li>
                        <span><i class="ri-map-pin-line"></i></span>
                        <div>
                            <h5>Location</h5>
                            <p>kungsaansaan st. Satabi, Pulilan, Bulacan</p>
                        </div>
                    </li>

                </div>
            </div>
        </div>
        <div class="footer_bar">
            Copyright @ 2024 Percas Hotel. All rights reserved.
        </div>
    </footer>



















    <!-- Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
</body>
</html>