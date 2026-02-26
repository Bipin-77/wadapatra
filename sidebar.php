<div class="navbar">
    <div class="logo">Nagarik Wadapatra</div>
    <div class="nav-links">
        <a href="#"><img src="images/home-icon.png" alt="Home" class="sidebar-icon">Home</a>
        <a href="#"><img src="images/event-icon.png" alt="Local Events" class="sidebar-icon">Local Events</a>
        <a href="#"><img src="images/emergency-icon.png" alt="Emergency Contacts" class="sidebar-icon">Emergency Contacts</a>
        <a href="#"><img src="images/eco-icon.png" alt="Eco Tracker" class="sidebar-icon">Eco Tracker</a>
        <a href="#"><img src="images/poll-icon.png" alt="Polls & Surveys" class="sidebar-icon">Polls & Surveys</a>
        <a href="#"><img src="images/about-icon.png" alt="About Us" class="sidebar-icon">About Us</a>
        <a href="#"><img src="images/contact-icon.png" alt="Contact Us" class="sidebar-icon">Contact Us</a>
        <a href="#"><img src="images/login-icon.png" alt="Login" class="sidebar-icon">Login</a>
    </div>
    <div class="user-profile">
        <img src="images/user.jpg" alt="User Profile">
        <span>User</span>
    </div>
</div>

<style>
    /* Sidebar Icon Styles */
    .sidebar-icon {
        width: 20px;
        height: 20px;
        margin-right: 5px;
        vertical-align: middle; /* Aligns icon with text */
    }

    /* Horizontal Sidebar */
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #004e92;
        color: #ffffff;
        padding: 10px 20px;
        font-family: 'Arial', sans-serif;
    }

    .navbar .logo {
        font-size: 28px;
        font-weight: bold;
        font-family: 'Impact', sans-serif; /* Changed to a bolder font */
        color: #fdc830;
    }

    .navbar .nav-links {
        display: flex;
        gap: 20px;
    }

    .navbar .nav-links a {
        text-decoration: none;
        color: #ffffff;
        font-weight: bold;
        transition: background 0.3s ease;
        padding: 10px 15px;
        border-radius: 5px;
        display: flex; /* Aligns icon and text */
        align-items: center; /* Centers icon and text vertically */
    }

    .navbar .nav-links a:hover {
        background-color: #fdc830;
        color: #004e92;
    }

    .navbar .user-profile {
        display: flex;
        align-items: center;
    }

    .navbar .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #fdc830; /* Yellow Border */
        margin-right: 10px;
    }
</style>
