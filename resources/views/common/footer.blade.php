<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="text-muted">© 2023 Attendance Pro. All rights reserved.</span>
            </div>
            <div class="col-md-6 text-end">
                <span class="text-muted me-3">v2.1.0</span>
                <a href="#" class="text-muted me-3"><i class="fas fa-question-circle"></i> Help</a>
                <a href="#" class="text-muted"><i class="fas fa-shield-alt"></i> Privacy</a>
            </div>
        </div>
    </div>
</footer>
<style>
    /* Footer Styles */
.footer {
    background-color: white;
    border-top: 1px solid #e0e0e0;
    padding: 1rem 2rem;
    font-size: 0.875rem;
    color: #666;
    position: sticky;
    bottom: 0;
    z-index: 10;
}

.footer a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer a:hover {
    color: #3a4b8c;
}

.footer i {
    margin-right: 5px;
}

@media (max-width: 768px) {
    .footer {
        padding: 1rem;
        text-align: center;
    }

    .footer .row {
        flex-direction: column;
        gap: 0.5rem;
    }

    .footer .text-end {
        text-align: center !important;
    }
}
</style>
