<div class="app-sidebar app-sidebar--light">
	<div class="app-sidebar--header" stylee="background: #0074fc;">
		<div class="nav-logo w-100 text-center d-flex justify-content-center align-items-center">
			<a href="/" class="d-block" data-toggle="tooltip" title="Background Checker"> <img src="/assets/images/logo/your-logo.webp" alt="Background Checker" class="img-fluid" width="120px"> </a>
		</div>
		<button class="toggle-sidebar rounded-circle btn btn-sm bg-white shadow-sm-dark text-primary" data-toggle="tooltip" data-placement="right" title="Expand sidebar" type="button"> <i class="fas fa-arrows-alt-h"></i> </button>
	</div>
	<div class="app-sidebar--content scrollbar-container mt-3">
		<div class="sidebar-navigation">
			<ul id="sidebar-nav" class="m-menu__nav">
				<li class="m-menu__item m-menu__item--submenu">
					<a href="/dashboard" aria-expanded="true">
						<span>
							<i data-feather="pie-chart"></i>
							<span>Dashboard</span>
						</span>
					</a>
				</li>
				<li class="m-menu__item m-menu__item--submenu d-none">
					<a href="/appointmentList" aria-expanded="true">
						<span>
							<i data-feather="clipboard"></i>
							<span>Appointments</span>
						</span>
					</a>
				</li>
				<li class="m-menu__item m-menu__item--submenu d-none">
					<a href="/package" aria-expanded="true">
						<span>
							<i data-feather="package"></i>
							<span>Packages</span>
						</span>
					</a>
				</li>
				<li class="m-menu__item m-menu__item--submenu d-none">
					<a href="/credibility" aria-expanded="true">
						<span>
							<i data-feather="book"></i>
							<span>Credibility</span>
						</span>
					</a>
				</li>
				<?php if ($_SESSION['role'] == "admin"): ?>
					<li class="m-menu__item m-menu__item--submenu">
						<a href="/blogList" aria-expanded="true">
							<span>
								<i data-feather="activity"></i>
								<span>Blogs</span>
							</span>
						</a>
					</li>
					<li class="m-menu__item m-menu__item--submenu">
						<a href="/serviceList" aria-expanded="true">
							<span>
								<i data-feather="bookmark"></i>
								<span>Services</span>
							</span>
						</a>
					</li>
					<li class="m-menu__item m-menu__item--submenu">
						<a href="/industryList" aria-expanded="true">
							<span>
								<i data-feather="bookmark"></i>
								<span>Industries</span>
							</span>
						</a>
					</li>
				<?php endif; ?>
				<li class="m-menu__item m-menu__item--submenu d-none">
					<a href="/contactList" aria-expanded="true">
						<span>
							<i data-feather="phone"></i>
							<span>Contact</span>
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="app-sidebar--footer d-block text-center py-3">
		<a href="./logout" class="btn btn-secondary-orio btn-logout font-weight-bold"><i class="fas fa-power-off mr-1" aria-hidden="true"></i> Log Out</a>
	</div>
</div>
<div class="sidebar-mobile-overlay"></div>