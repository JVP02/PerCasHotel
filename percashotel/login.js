const adminLoginForm = document.getElementById("adminLoginForm");
const errorMessage = document.getElementById("error-message");

// Admin credentials (for demonstration purposes)
const ADMIN_CREDENTIALS = {
  username: "admin",
  password: "12345",
};

// Form submission handling
adminLoginForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  // Validate credentials
  if (username === ADMIN_CREDENTIALS.username && password === ADMIN_CREDENTIALS.password) {
    errorMessage.style.color = "green";
    errorMessage.textContent = "Login successful!";
    setTimeout(() => {
      window.location.href = "admin-dashboard.html"; // Redirect to dashboard
    }, 1500);
  } else {
    errorMessage.style.color = "red";
    errorMessage.textContent = "Invalid username or password.";
  }
});
