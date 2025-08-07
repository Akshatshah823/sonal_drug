<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <i class="fas fa-calendar-check"></i>
            <span class="brand-text">Attendance Pro</span>
        </a>
        <button class="sidebar-toggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="dashboard.html">
                <i class="fas fa-tachometer-alt"></i>
                <span class="link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="attendance.html">
                <i class="fas fa-user-clock"></i>
                <span class="link-text">Attendance</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="employees.html">
                <i class="fas fa-users"></i>
                <span class="link-text">Employees</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="schedule.html">
                <i class="fas fa-calendar-day"></i>
                <span class="link-text">Schedule</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="reports.html">
                <i class="fas fa-file-alt"></i>
                <span class="link-text">Reports</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="settings.html">
                <i class="fas fa-cog"></i>
                <span class="link-text">Settings</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <div class="text-center small">
            <p>v2.1.0</p>
        </div>
    </div>
</nav>

<style>
    /* Sidebar Navigation Styles */
    .sidebar {
        width: 250px;
        background-color: #2c3a6d;
        color: #e0e0e0;
        transition: transform 0.3s ease;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transform: translateX(0);
        left: 0;
        top: 0;
    }

    .sidebar-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-brand {
        font-weight: 600;
        font-size: 1.25rem;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar-brand i {
        margin-right: 10px;
        font-size: 1.5rem;
    }

    .sidebar-toggle {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
    }

    .nav {
        flex-direction: column;
        padding: 1rem 0;
        flex-grow: 1;
    }

    .nav-link {
        color: #e0e0e0;
        padding: 0.75rem 1.5rem;
        margin: 0.25rem 0;
        border-radius: 0;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9375rem;
    }

    .nav-link:hover, .nav-link.active {
        background-color: #3a4b8c;
        color: white;
    }

    .nav-link i {
        width: 24px;
        margin-right: 10px;
        text-align: center;
        font-size: 1.1rem;
    }

    .sidebar-footer {
        margin-top: auto;
        padding: 1rem;
        font-size: 0.75rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Overlay styles */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }
    
    .sidebar-overlay.show {
        display: block;
    }

    /* Mobile First Approach */
    @media (max-width: 992px) {
        .sidebar {
            width: 70px;
            overflow: hidden;
        }
        .brand-text, .link-text {
            display: none;
        }
        .nav-link {
            justify-content: center;
            padding: 1rem 0;
        }
        .nav-link i {
            margin-right: 0;
            font-size: 1.25rem;
        }
        .sidebar-header {
            justify-content: center;
        }
        .sidebar-brand i {
            margin-right: 0;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 250px;
            transform: translateX(-100%);
        }
        .sidebar.show {
            transform: translateX(0);
        }
        .sidebar-toggle {
            display: block;
        }
        .brand-text, .link-text {
            display: inline;
        }
        .nav-link {
            justify-content: flex-start;
            padding: 0.75rem 1.5rem;
        }
        .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
    }

    /* For very small screens */
    @media (max-width: 480px) {
        .sidebar {
            width: 220px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        
        // Create overlay element
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);

        // Touch handling variables
        let touchStartX = 0;
        let touchEndX = 0;
        const swipeThreshold = 50;

        // Toggle sidebar on button click
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
        }

        // Close sidebar when clicking on overlay
        overlay.addEventListener('click', function() {
            closeSidebar();
        });

        // Touch events for mobile swipe
        document.addEventListener('touchstart', function(e) {
            if (window.innerWidth > 768) return;
            touchStartX = e.touches[0].clientX;
        }, {passive: true});

        document.addEventListener('touchmove', function(e) {
            if (window.innerWidth > 768) return;
            e.preventDefault();
            
            const currentX = e.touches[0].clientX;
            const diff = currentX - touchStartX;
            
            // Only allow right swipe to open when closed
            if (!sidebar.classList.contains('show') && diff > 0) {
                const translateX = Math.min(diff - sidebar.offsetWidth, 0);
                sidebar.style.transform = `translateX(${translateX}px)`;
            }
            // Allow left swipe to close when open
            else if (sidebar.classList.contains('show')) {
                const translateX = Math.min(diff, 0);
                sidebar.style.transform = `translateX(${translateX}px)`;
            }
        }, {passive: false});

        document.addEventListener('touchend', function(e) {
            if (window.innerWidth > 768) return;
            
            touchEndX = e.changedTouches[0].clientX;
            const diff = touchEndX - touchStartX;
            
            // Swipe right to open
            if (diff > swipeThreshold && !sidebar.classList.contains('show')) {
                openSidebar();
            } 
            // Swipe left to close
            else if (diff < -swipeThreshold && sidebar.classList.contains('show')) {
                closeSidebar();
            }
            // Return to original state if threshold not met
            else {
                if (sidebar.classList.contains('show')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            }
            
            // Reset transform
            setTimeout(() => {
                sidebar.style.transform = '';
            }, 300);
        }, {passive: true});

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                event.target !== sidebarToggle) {
                closeSidebar();
            }
        });

        // Close sidebar when resizing to larger screens
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        // Helper functions
        function toggleSidebar() {
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        function openSidebar() {
            sidebar.classList.add('show');
            overlay.classList.add('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    });
</script>