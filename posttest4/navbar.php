<nav>
    <input type="checkbox" id="menu-toggle" style="display: none;">
    <div class="hamburger-icon" onclick="toggleMenu()" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </div>
    <ul class="menu" role="menu">
        <li role="menuitem"><a href="index.php" onclick="closeMenu()">Home</a></li>
        <li role="menuitem"><a href="register.php" onclick="closeMenu()">Register</a></li>
        <li role="menuitem"><a href="about.php" onclick="closeMenu()">About</a></li>
    </ul>
    <div class="logo"><a href="index.php">ZManga</a></div>
    <label class="switch">
        <input type="checkbox" id="mode-toggle" onclick="toggleMode()">
        <span class="slider round"></span>
    </label>
</nav>
