const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e)=>{
    navLinks.classList.toggle("open");


    const isOpen = navLinks.classList.contains("open");
    menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line":"ri-menu-line");
});

navLinks.addEventListener("click", (e)=>{
    navLinks.classList.remove("open")
    .menuBtnIcon.setAttribute("class", "ri-menu-line")
});

// Scroll Reveal Animation
const scrollRevealOption = {
    distance: "5000px",
    origin: "bottom",
    duration: 500,


}

//header container
ScrollReveal().reveal(".header_container .section_subheader",{
    ...scrollRevealOption,
})
ScrollReveal().reveal(".header_container h1",{
    ...scrollRevealOption,
    delay:500,
})
ScrollReveal().reveal(".header_container .btn",{
    ...scrollRevealOption,
    delay:100,
})

// ROOMS CONTAINER
ScrollReveal().reveal(".room_card", {
    ...scrollRevealOption,
    interval:100,

})


// Feature CONTAINER
ScrollReveal().reveal(".feature_card", {
    ...scrollRevealOption,
    interval:100,
    
})

// News CONTAINER
ScrollReveal().reveal(".news_card", {
    ...scrollRevealOption,
    interval:500,
    
})


// NOTIFICATION

// Function to show a custom notification
function showNotification(message, isSuccess) {
    const notification = document.getElementById('notification');
    const messageElement = document.getElementById('notification-message');
    
    // Set the message and style
    messageElement.textContent = message;
    notification.style.backgroundColor = isSuccess ? '#28a745' : '#dc3545'; // Green for success, red for error
    notification.classList.remove('hidden');
    notification.classList.add('show');

    // Add a one-time event listener to hide the notification on click
    document.addEventListener('click', hideNotification, { once: true });
}

// Function to hide the notification
function hideNotification() {
    const notification = document.getElementById('notification');
    notification.classList.remove('show');
    notification.classList.add('hidden');
}
