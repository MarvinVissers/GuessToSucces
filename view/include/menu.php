
    <!-- Sidebar menu -->
    <nav class="navbar" id="navbar">
        <ul class="navbar__list">
            <div class="navbar__top">
                <li class="navbar__item"><a href="profile" class="navbar__link" id="profile"><i class="fas fa-user-alt navbar--icon"></i> <div class="mobile--hide">Profile</div></a></li>
                <li class="navbar__item"><a href="bet-overview" class="navbar__link" id="bet-overview"><i class="fas fa-clipboard-list navbar--icon"></i> <div class="mobile--hide">Your bets</div></a></li>
                <li class="navbar__item"><a href="achievement-overview" class="navbar__link" id="achievement-overview"><i class="fas fa-trophy navbar--icon"></i> <div class="mobile--hide">Achievements</div></a></li>
                <li class="navbar__item"><a href="index" class="navbar__link" id="index"><i class="fas fa-home navbar--icon"></i> <div class="mobile--hide">Next Grand Prix</div></a></li>
                <li class="navbar__item"><a href="calender-overview" class="navbar__link" id="calender-overview"><i class="far fa-calendar-alt navbar--icon"></i> <div class="mobile--hide">Calender</div></a></li>
                <li class="navbar__item"><a href="constructor-overview" class="navbar__link" id="constructor-overview"><i class="fas fa-car navbar--icon"></i> <div class="mobile--hide">Constructors</div></a></li>
                <li class="navbar__item"><a href="driver-overview" class="navbar__link" id="driver-overview"><i class="fas fa-user-astronaut navbar--icon"></i> <div class="mobile--hide">Drivers</div></a></li>
            </div>

            <div class="navbar__bottom">
                <!-- Setting the points of the user in the sidebar -->
                <li class="navbar__item"><a href="#" class="navbar__link"><i class="fas fa-coins navbar--icon"></i> <div class="mobile--hide"><?php echo $userModel->getPoints(); ?> Points</div></a></li>
                <li class="navbar__item"><a href="logout" class="navbar__link"><i class="fas fa-sign-out-alt navbar--icon"></i> <div class="mobile--hide">Log out</div></a></li>
            </div>
        </ul>

        <!-- Navbar toggle desktop -->
        <div class="navbar__toggle" onclick="toggleNavbar()">
            <i class="fas fa-chevron-left navbar--icon" id="navbar-toggle"></i>
        </div>
    </nav>
