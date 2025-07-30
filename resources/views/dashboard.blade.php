 @include('common.header')

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Attendance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a4b8c;
            --primary-dark: #2c3a6d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #fd7e14;
            --light-bg: #f8f9fa;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            color: #333;
            height: 100vh;
            overflow: hidden;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 0;
        }

        .dashboard-header {
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            padding: 1rem 2rem;
            box-shadow: var(--card-shadow);
            z-index: 10;
        }

        .dashboard-content {
            flex: 1;
            overflow: auto;
            padding: 2rem;
        }

        .stat-card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            height: 100%;
            background-color: white;
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-card .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .stat-card.present .icon-wrapper { background-color: rgba(40, 167, 69, 0.1); color: var(--success-color); }
        .stat-card.absent .icon-wrapper { background-color: rgba(220, 53, 69, 0.1); color: var(--danger-color); }
        .stat-card.holiday .icon-wrapper { background-color: rgba(253, 126, 20, 0.1); color: var(--warning-color); }
        .stat-card.percentage .icon-wrapper { background-color: rgba(58, 75, 140, 0.1); color: var(--primary-color); }

        .calendar-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            background: white;
            height: 100%;
            padding: 1rem;
        }

        /* FullCalendar custom styles */
        .fc {
            height: 100%;
        }

        .fc .fc-toolbar-title {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.50rem;
        }

        .fc .fc-button {
            background-color: white;
            border: 1px solid #e0e0e0;
            color: #555;
            transition: var(--transition);
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .fc .fc-button:hover {
            background-color: var(--light-bg);
            color: var(--primary-dark);
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .fc-daygrid-day {
            transition: var(--transition);
        }

        .fc-daygrid-day:hover {
            background-color: #f8f9fa;
        }

        .attendance-badge {
            font-size: 0.6875rem;
            font-weight: 500;
            padding: 2px 6px;
            border-radius: 4px;
            margin-top: 2px;
            display: inline-block;
        }

        .present-badge { background-color: var(--success-color); color: white; }
        .absent-badge { background-color: var(--danger-color); color: white; }
        .holiday-badge { background-color: var(--warning-color); color: white; }

        .summary-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            background: white;
            height: 100%;
        }

        .summary-card .card-header {
            background-color: white;
            color: var(--primary-dark);
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .form-select, .form-control {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            border: 1px solid #e0e0e0;
            font-size: 0.875rem;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(58, 75, 140, 0.1);
        }

        .btn-elegant {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.25rem;
            transition: var(--transition);
            font-size: 0.875rem;
        }

        .btn-elegant:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .fc-daygrid-day-number {
            font-size: 0.875rem;
        }

        .fc-col-header-cell-cushion {
            font-size: 0.8125rem;
            font-weight: 500;
            color: #555;
        }

        .fc-daygrid-event {
            margin-top: 1px;
        }

        .h-100 {
            height: 100% !important;
        }

        .dashboard-title {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.5rem;
            margin: 0;
        }

        .current-month {
            font-size: 0.875rem;
            color: #666;
        }

        .nav-buttons .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Ensure calendar has proper height */
        #calendar {
            height: 100% !important;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="dashboard-title">Attendance Dashboard</h1>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <span class="current-month me-3" id="current-month"><?php echo date('F Y'); ?></span>
                            <div class="btn-group nav-buttons">
                                <button class="btn btn-sm btn-outline-secondary" id="prevMonth">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary mx-1" id="currentMonth">
                                    Today
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" id="nextMonth">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="container-fluid">
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card present h-100">
                            <div class="card-body">
                                <div class="icon-wrapper">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="text-muted mb-2">Present Days</h6>
                                <h2 id="presentCount" class="mb-0">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card absent h-100">
                            <div class="card-body">
                                <div class="icon-wrapper">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h6 class="text-muted mb-2">Absent Days</h6>
                                <h2 id="absentCount" class="mb-0">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card holiday h-100">
                            <div class="card-body">
                                <div class="icon-wrapper">
                                    <i class="fas fa-umbrella-beach"></i>
                                </div>
                                <h6 class="text-muted mb-2">Holidays</h6>
                                <h2 id="holidayCount" class="mb-0">0</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card percentage h-100">
                            <div class="card-body">
                                <div class="icon-wrapper">
                                    <i class="fas fa-percentage"></i>
                                </div>
                                <h6 class="text-muted mb-2">Attendance %</h6>
                                <h2 id="attendancePercent" class="mb-0">0%</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3" style="height: calc(100% - 180px);">
                    <div class="col-lg-8" style="height: 100%;">
                        <div class="calendar-container h-100">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="height: 100%;">
                        <div class="summary-card h-100">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i> Monthly Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-medium">Select Employee</label>
                                    <select class="form-select" id="employeeSelect">
                                        <option value="1">John Doe</option>
                                        <option value="2">Jane Smith</option>
                                        <option value="3">Robert Johnson</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-medium">Select Month</label>
                                    <input type="month" class="form-control" id="monthSelect" value="<?php echo date('Y-m'); ?>">
                                </div>

                                <div id="attendanceSummary" style="height: calc(100% - 150px); overflow-y: auto;">
                                    <div class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="fas fa-user-clock fa-3x text-primary opacity-25"></i>
                                        </div>
                                        <h6 class="text-muted">Select an employee and month</h6>
                                        <p class="small text-muted">Attendance details will appear here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('common.footer')
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize calendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                height: '100%',
                contentHeight: 'auto',
                aspectRatio: 1.5,
                eventDidMount: function(info) {
                    // Add custom styling to events
                    if(info.event.extendedProps.description) {
                        info.el.setAttribute('title', info.event.extendedProps.description);
                    }
                },
                events: [
                    // Sample data - replace with your actual data from backend
                    {
                        title: 'Present',
                        start: new Date().toISOString().split('T')[0],
                        color: 'var(--success-color)',
                        display: 'background',
                        className: 'present-badge'
                    },
                    {
                        title: 'Present',
                        start: new Date(new Date().setDate(new Date().getDate() - 1)).toISOString().split('T')[0],
                        color: 'var(--success-color)',
                        display: 'background',
                        className: 'present-badge'
                    },
                    {
                        title: 'Absent',
                        start: new Date(new Date().setDate(new Date().getDate() - 2)).toISOString().split('T')[0],
                        color: 'var(--danger-color)',
                        display: 'background',
                        className: 'absent-badge'
                    },
                    {
                        title: 'Holiday',
                        start: new Date(new Date().setDate(new Date().getDate() - 3)).toISOString().split('T')[0],
                        color: 'var(--warning-color)',
                        display: 'background',
                        className: 'holiday-badge'
                    }
                ],
                eventContent: function(arg) {
                    return {
                        html: `<div class="attendance-badge ${arg.event.title.toLowerCase()}-badge">${arg.event.title}</div>`
                    };
                },
                datesSet: function(info) {
                    updateSummaryCounts(info.start, info.end);
                    document.getElementById('current-month').textContent =
                        info.view.title;
                    document.getElementById('monthSelect').value =
                        `${info.start.getFullYear()}-${String(info.start.getMonth() + 1).padStart(2, '0')}`;
                }
            });

            calendar.render();

            // Navigation buttons
            document.getElementById('prevMonth').addEventListener('click', function() {
                calendar.prev();
                this.blur();
            });

            document.getElementById('nextMonth').addEventListener('click', function() {
                calendar.next();
                this.blur();
            });

            document.getElementById('currentMonth').addEventListener('click', function() {
                calendar.today();
                this.blur();
            });

            // Update summary counts
            function updateSummaryCounts(start, end) {
                // This should be replaced with actual API calls to your backend
                // Sample counts for demo
                const present = Math.floor(Math.random() * 10) + 15;
                const absent = Math.floor(Math.random() * 5) + 1;
                const holiday = Math.floor(Math.random() * 3) + 1;
                const totalDays = new Date(end.getFullYear(), end.getMonth() + 1, 0).getDate();
                const workingDays = totalDays - holiday;
                const attendancePercent = Math.round((present / workingDays) * 100);

                document.getElementById('presentCount').textContent = present;
                document.getElementById('absentCount').textContent = absent;
                document.getElementById('holidayCount').textContent = holiday;
                document.getElementById('attendancePercent').textContent = attendancePercent + '%';
            }

            // Initial update
            updateSummaryCounts(
                calendar.view.currentStart,
                calendar.view.currentEnd
            );

            // Month/employee selection
            document.getElementById('monthSelect').addEventListener('change', function() {
                const date = new Date(this.value + '-01');
                calendar.gotoDate(date);
            });

            document.getElementById('employeeSelect').addEventListener('change', function() {
                fetchAttendanceData(this.value, document.getElementById('monthSelect').value);
            });

            // Sample function to fetch attendance data
            function fetchAttendanceData(employeeId, month) {
                // Show loading state
                document.getElementById('attendanceSummary').innerHTML = `
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted">Loading attendance data...</p>
                    </div>
                `;

                // Simulate API call delay
                setTimeout(() => {
                    // Sample response handling
                    const summaryHTML = `
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <h6 class="fw-medium">Attendance Overview</h6>
                                    <p class="small text-muted">${document.getElementById('current-month').textContent}</p>
                                </div>
                                <span class="badge bg-primary">Employee #${employeeId}</span>
                            </div>

                            <div class="row g-2 mb-4">
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded">
                                        <p class="small text-muted mb-1">Working Days</p>
                                        <h5 class="mb-0">22</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded">
                                        <p class="small text-muted mb-1">Present</p>
                                        <h5 class="mb-0">18 <small class="text-success">(82%)</small></h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded">
                                        <p class="small text-muted mb-1">Absent</p>
                                        <h5 class="mb-0">2 <small class="text-danger">(9%)</small></h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded">
                                        <p class="small text-muted mb-1">Leaves</p>
                                        <h5 class="mb-0">2 <small class="text-warning">(9%)</small></h5>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-medium mb-3">Attendance Trend</h6>
                            <canvas id="attendanceChart" height="180"></canvas>

                            <div class="mt-4">
                                <button class="btn btn-elegant w-100">
                                    <i class="fas fa-download me-2"></i> Export Report
                                </button>
                            </div>
                        </div>
                    `;

                    document.getElementById('attendanceSummary').innerHTML = summaryHTML;

                    // Sample chart
                    const ctx = document.getElementById('attendanceChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                            datasets: [{
                                label: 'Present',
                                data: [4, 5, 4, 5],
                                backgroundColor: 'var(--success-color)',
                                borderRadius: 4
                            }, {
                                label: 'Absent',
                                data: [1, 0, 1, 0],
                                backgroundColor: 'var(--danger-color)',
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        boxWidth: 12,
                                        padding: 16,
                                        font: {
                                            size: 11
                                        }
                                    }
                                },
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 10
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 5,
                                    ticks: {
                                        stepSize: 1,
                                        font: {
                                            size: 10
                                        }
                                    }
                                }
                            },
                            maintainAspectRatio: false
                        }
                    });
                }, 800);
            }
        });
    </script>
</body>
</html>

