<nav>
    <div class="nav-left">
        <a href="https://codecademyre.com">
            <img src="assets/logo/logoBlue.png" alt="Logo" class="logo" onmouseover="changeImage(this)"
                onmouseout="restoreImage(this)">
        </a>
        <!-- Dashboard access link - ADMIN Role -->
        <?php
        use app\utils\AdminUI;

        AdminUI::renderControlPanelLink();
        ?>
        <ul class="menu">
            <li><a href="https://codecademyre.com/catalog">Catalog</a></li>
            <li><a href="https://codecademyre.com/pricing">Pricing</a></li>
        </ul>
    </div>
    <div class="nav-right">
        <ul class="desktop-nav">
            <li><img src="assets/icon/searchIcon.png" alt="searchIcon" class="searchIcon"></li>
            <li><a href="https://codecademyre.com/login" class="login">Log in</a></li>
            <li><a href="https://codecademyre.com/signup" class="signup" id="signUpIndex">Sign Up</a></li>
        </ul>
        <ul class="mobile-nav">
            <li><a href="https://codecademyre.com/login" class="login">Log in</a></li>
            <li><img src="assets/icon/menuIcon.png" alt="menuIcon" class="menuIcon" onclick="openNav()"></li>
        </ul>
    </div>
</nav>

<div id="mobile-fullscrenMenu" class="overlay">
    <div class="overlay-header">
        <a href="https://codecademyre.com"><img src="assets/logo/logoBlue.png" alt="Logo" class="logo"
                onmouseover="changeImage(this)" onmouseout="restoreImage(this)"></a>
        <a class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    <form id="searchBox">
        <img src="assets/icon/searchIcon.png">
        <input type="text" name="search" placeholder="Search our catalog">
    </form>
    <div class="overlay-content">
        <a href="https://codecademyre.com/catalog">Catalog</a>
        <a href="https://codecademyre.com/pricing">Pricing</a>
        <a href="https://codecademyre.com/quiz">Take our quiz</a>
    </div>
    <div class="hline"></div>
    <div class="overlay-login">
        <a href="https://codecademyre.com/signup" class="signup" onclick="closeNav()">Sign Up</a>
        <a href="https://codecademyre.com/login" class="signup" onclick="closeNav()">Log in</a>
        <a>
            <i class="fa fa-sign-out" aria-hidden="true" onclick="logoutUser()"></i>
        </a>
    </div>
</div>