<nav class="navbar navbar-header navbar-expand navbar-light">
    <header>
        <a href="#" class="burger-btn d-block">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown">
                <a href="javascript:;" onclick="dropdownNavbar(this)" data-bs-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user" aria-expanded="true">
                    <div class="avatar me-2 bg-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user text-white">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end" data-bs-popper="none">
                    <a class="dropdown-item"> Welcome, admin</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="https://access-app.dev.com/logout"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-log-out">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>