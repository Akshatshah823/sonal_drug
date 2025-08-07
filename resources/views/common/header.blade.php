<!-- Elegant Dark Professional Header - Responsive -->
<header class="navbar-dark-premium">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center py-2">
            <!-- Logo/Branding with Sophisticated Animation -->
            <div class="d-flex align-items-center">
                <a href="/" class="brand-logo">
                    <div class="logo-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 0C7.163 0 0 7.163 0 16C0 24.837 7.163 32 16 32C24.837 32 32 24.837 32 16C32 7.163 24.837 0 16 0Z" fill="url(#logo-gradient)"/>
                            <path d="M22 12L14 20L10 16" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <defs>
                                <linearGradient id="logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#8A2BE2" />
                                    <stop offset="100%" stop-color="#4361EE" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <span class="ms-2 fw-bold fs-4 text-white d-none d-sm-inline">Attendance<span class="text-gradient">Pro</span></span>
                </a>
            </div>

         
            <!-- Right Section with Premium White Elements -->
            <div class="d-flex align-items-center gap-4" id="headerControls">
                <!-- Elegant Date Navigation -->
                <div class="date-navigator-premium d-none d-md-flex">
                    <button id="prevMonth" class="btn btn-icon-premium" aria-label="Previous month">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="current-date-premium mx-3">{{ now()->format('F Y') }}</span>
                    <button id="nextMonth" class="btn btn-icon-premium" aria-label="Next month">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Mobile Date Display -->
                <div class="d-md-none mobile-date-display">
                    <span class="current-date-premium">{{ now()->format('M Y') }}</span>
                </div>

                <!-- White Notification Bell with Elegant Badge -->
                <div class="notification-icon-premium">
                    <button class="btn btn-icon-premium position-relative">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-primary">
                            3
                        </span>
                    </button>
                </div>

                <!-- Professional User Dropdown -->
                <div class="dropdown user-dropdown-premium">
                    <button class="btn dropdown-toggle d-flex align-items-center user-avatar-premium" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-premium avatar-sm-premium">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=ffffff&color=4361EE" alt="Admin">
                        </div>
                        <span class="ms-2 d-none d-lg-inline text-white">Admin User</span>
                        <i class="fas fa-chevron-down ms-2 text-white-50 small d-none d-lg-inline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-premium dropdown-menu-end shadow-lg">
                        <li>
                            <a class="dropdown-item-premium d-flex align-items-center" href="#">
                                <div class="avatar-dropdown me-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=4361EE&color=fff" alt="Admin">
                                </div>
                                <div>
                                    <div class="fw-bold text-white">Admin User</div>
                                    <small class="text-white-50">Administrator</small>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider-premium"></li>
                        <li><a class="dropdown-item-premium" href="#"><i class="fas fa-chart-line me-2"></i>Dashboard</a></li>
                        <li><a class="dropdown-item-premium" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><a class="dropdown-item-premium" href="#"><i class="fas fa-envelope me-2"></i>Messages <span class="badge bg-white text-primary ms-2">5</span></a></li>
                        <li><hr class="dropdown-divider-premium"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item-premium">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
      
        
    </div>
</header>

<style>
    /* Elegant Dark Professional Header Styles */
    .navbar-dark-premium {
        background: linear-gradient(90deg, #121212 0%, #1A1A2E 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.75rem 1.5rem;
        position: sticky;
        top: 0;
        z-index: 1030;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }

    .brand-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .logo-icon {
        transition: all 0.4s ease;
        filter: drop-shadow(0 2px 8px rgba(138, 43, 226, 0.4));
        width: 32px;
        height: 32px;
    }

    .text-gradient {
        background: linear-gradient(90deg, #FFFFFF 0%, #E0E0E0 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    /* Premium Date Navigator */
    .date-navigator-premium {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50px;
        padding: 0.5rem 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
    }

    .current-date-premium {
        color: #FFFFFF;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Premium White Buttons */
    .btn-icon-premium {
        color: #FFFFFF;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    /* Premium Avatar */
    .avatar-premium {
        border-radius: 50%;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .avatar-sm-premium {
        width: 36px;
        height: 36px;
    }

    /* Premium Dropdown */
    .dropdown-menu-premium {
        background: #1E1E2E;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 0.5rem 0;
        min-width: 240px;
    }

    /* Mobile Menu Toggle */
    .navbar-toggler-premium {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.25rem;
        padding: 0.5rem;
        display: none;
    }

    /* Mobile Menu */
    .mobile-menu-container {
        background: rgba(30, 30, 46, 0.95);
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transform: translateY(-100%);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1029;
    }

    .mobile-menu-container.show {
        transform: translateY(0);
        opacity: 1;
    }

    .mobile-date-navigator {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 0.5rem 0;
    }

    .mobile-date-display {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 1199px) {
        .navbar-dark-premium {
            padding: 0.75rem 1rem;
        }
        .date-navigator-premium {
            padding: 0.4rem 0.6rem;
        }
        .current-date-premium {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 991px) {
        .navbar-toggler-premium {
            display: block;
        }
        #headerControls {
            display: none !important;
        }
        .mobile-date-display {
            display: block;
        }
    }

    @media (max-width: 767px) {
        .brand-logo span.fs-4 {
            font-size: 1.1rem !important;
        }
        .logo-icon {
            width: 28px;
            height: 28px;
        }
        .avatar-sm-premium {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 575px) {
        .navbar-dark-premium {
            padding: 0.5rem;
        }
        .mobile-date-display {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
    }
</style>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const headerControls = document.getElementById('headerControls');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('show');
                this.querySelector('i').classList.toggle('fa-bars');
                this.querySelector('i').classList.toggle('fa-times');
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenu && mobileMenuToggle && 
                !mobileMenu.contains(event.target) && 
                !mobileMenuToggle.contains(event.target)) {
                mobileMenu.classList.remove('show');
                if (mobileMenuToggle.querySelector('i').classList.contains('fa-times')) {
                    mobileMenuToggle.querySelector('i').classList.replace('fa-times', 'fa-bars');
                }
            }
        });

        // Month navigation for both desktop and mobile
        function setupMonthNavigation(prevBtnId, nextBtnId) {
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    updateMonth(-1);
                    animateButton(this);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    updateMonth(1);
                    animateButton(this);
                });
            }
        }

        function updateMonth(change) {
            // Month change logic here
            console.log(`Month changed by ${change}`);
        }

        function animateButton(btn) {
            btn.classList.add('active');
            setTimeout(() => btn.classList.remove('active'), 300);
        }

        // Initialize navigation for both desktop and mobile
        setupMonthNavigation('prevMonth', 'nextMonth');
        setupMonthNavigation('mobilePrevMonth', 'mobileNextMonth');

        // Notification bell animation
        document.querySelectorAll('.notification-icon-premium button').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.style.transform = 'rotate(15deg)';
                setTimeout(() => {
                    icon.style.transform = 'rotate(-15deg)';
                    setTimeout(() => {
                        icon.style.transform = 'rotate(0)';
                    }, 150);
                }, 150);
            });
        });
    });
</script>