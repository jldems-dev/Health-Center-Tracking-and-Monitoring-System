<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion hide" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon" >
                    <img src="img/HCTM.png" alt="" width="38px" >
                </div>
                <div class="sidebar-brand-text mx-3">HCT & M <sup>System</sup></div>
            </a>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Adding
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Patient.php">
                <i class="fa fa-wheelchair"></i>
                    <span>Patient</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Selecting
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages"><i class="fas fa-desktop"></i>
                    <span>Monitoring</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="Illness.php"><i class='fas fa-clinic-medical'></i>
                        <span>Illness</span>
                    </a>
                    <a class="collapse-item" href="Immunization.php"><i class='fas fa-crutch'></i>
                        <span>Immunization</span>
                    </a>
                    <a class="collapse-item" href="Prenatal.php"><i class="fas fa-female"></i>
                        <span>Prenatal</span>
                    </a>
                    <a class="collapse-item" href="Bloodpressure.php"><img src="img/bp.png" alt="" width="14px">
                        <span>Blood Pressure</span>
                    </a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Records</div>
            <li class="nav-item">
                <a class="nav-link" href="Appointment.php">
                <i class="fas fa-calendar-check"></i>
                    <span>Appointment Schedule</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Medical.php">
                <i class='fas fa-notes-medical'></i>
                    <span>Medical Records</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="User.php">
                <i class='fas fa-user-md'></i>
                    <span>Health Worker</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Print.php">
                <i class="fas fa-print"></i>
                    <span>Print Reports</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h3 class="d-none d-sm-block">Health Center Tracking and Monitoring System</h3>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $rowh['lname'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $rowh['profile_image']; ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="Profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="Settings.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
       
    
