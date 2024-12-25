<div class="app-header">
    <div class="d-flex">
        <button class="navbar-toggler hamburger hamburger--elastic toggle-sidebar" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        <button class="navbar-toggler hamburger hamburger--elastic toggle-sidebar-mobile" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
    <div class="d-flex align-items-center">
        <div class="user-box">
            <a href="#" data-trigger="click" data-popover-class="popover-secondary popover-custom-wrapper popover-custom-lg" data-rel="popover-close-outside" data-tip="account-popover" class="p-0 d-flex align-items-center popover-custom" data-placement="bottom" data-boundary="'viewport'">
                <div class="d-block p-0 avatar-icon-wrapper">
                    <span class="badge badge-circle badge-success p-top-a">Online</span>
                    <div class="avatar-icon rounded bg-neutral-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>
                <div class="d-none d-md-block pl-2">
                    <div class="font-weight-bold">
                        <?= $_SESSION['full_name'] ?>
                    </div>
                    <span class="text-black-50 text-uppercase">
                        <?= $_SESSION['role']; ?>
                    </span>
                </div>
                <span class="pl-3"><i class="fas fa-angle-down opacity-5"></i></span>
            </a>
        </div>
    </div>
    <div id="account-popover" class="d-none">
        <ul class="list-group list-group-flush text-left bg-transparent">
            <li class="list-group-item rounded-top">
                <ul class="nav nav-pills nav-pills-hover flex-column">
                    <li class="nav-header d-flex text-primary pt-1 pb-2 font-weight-bold align-items-center">
                        <div class="font-weight-light text-black h6 mb-0">
                            Profile options
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cursor-pointer" href="/profile">
                            My Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cursor-pointer" href="/changePassword">
                            Change Password
                        </a>
                    </li>
                </ul>
            </li>
            <li class="list-group-item rounded-bottom p-2 text-center border-top">
                <a href="./logout" class="btn-logout-icon">
                    <i class="fas fa-power-off mr-1" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </div>
</div>