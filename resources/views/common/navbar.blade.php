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
    transition: all 0.3s ease;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    z-index: 1000;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
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
        width: 100%;
        height: auto;
        position: relative;
        flex-direction: row;
        flex-wrap: wrap;
        padding: 0;
    }
    .sidebar-header {
        width: 100%;
        order: 1;
    }
    .sidebar-toggle {
        display: block;
    }
    .nav {
        flex-direction: row;
        order: 3;
        width: 100%;
        display: none; /* Hidden by default on mobile */
        padding: 0;
    }
    .nav.show {
        display: flex;
    }
    .nav-item {
        flex: 1;
        text-align: center;
    }
    .nav-link {
        flex-direction: column;
        padding: 0.75rem 0.5rem;
        font-size: 0.75rem;
    }
    .nav-link i {
        margin-right: 0;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }
    .link-text {
        display: block;
    }
    .sidebar-footer {
        display: none;
    }
    .sidebar-brand span {
        display: inline;
    }
}

/* For very small screens */
@media (max-width: 480px) {
    .nav-link {
        padding: 0.5rem 0.25rem;
        font-size: 0.65rem;
    }
    .nav-link i {
        font-size: 0.9rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const nav = document.querySelector('.nav');

    if (sidebarToggle && nav) {
        sidebarToggle.addEventListener('click', function() {
            nav.classList.toggle('show');
        });
    }

    // Close menu when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            const isClickInside = document.querySelector('.sidebar').contains(event.target);
            if (!isClickInside) {
                nav.classList.remove('show');
            }
        }
    });
});
</script>
