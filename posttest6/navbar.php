<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
?>

<nav>
    <input type="checkbox" id="menu-toggle" style="display: none;">
    <div class="hamburger-icon" onclick="toggleMenu()" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </div>
    
    <ul class="menu" role="menu">
        <li role="menuitem"><a href="index.php" onclick="closeMenu()">Home</a></li>
        <li role="menuitem"><a href="about.php" onclick="closeMenu()">About</a></li>
        
        <?php if (isset($_SESSION['email'])):  ?>
            <li role="menuitem"><a href="akun.php" onclick="closeMenu()">Akun</a></li>
            <li role="menuitem"><a href="logout.php" onclick="closeMenu()">Logout</a></li>
        <?php else:  ?>
            <li role="menuitem"><a href="register.php" onclick="closeMenu()">Register</a></li>
            <li role="menuitem"><a href="login.php" onclick="closeMenu()">Login</a></li>
        <?php endif; ?>
    </ul>

    <div class="logo"><a href="index.php">ZManga</a></div>
    
    <label class="switch">
        <input type="checkbox" id="mode-toggle" onclick="toggleMode()">
        <span class="slider round"></span>
    </label>
</nav>
