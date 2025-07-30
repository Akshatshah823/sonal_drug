<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Punch System | Your Company Name</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --secondary-color: #10b981;
            --error-color: #ef4444;
            --warning-color: #f59e0b;
            --light-color: #f9fafb;
            --dark-color: #111827;
            --gray-color: #6b7280;
            --light-gray: #e5e7eb;
            --border-radius: 12px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            color: var(--dark-color);
            line-height: 1.5;
        }

        .attendance-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 24px;
            text-align: center;
            position: relative;
        }

        .header h2 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .header p {
            opacity: 0.9;
            font-size: 0.875rem;
        }

        .company-logo {
            position: absolute;
            top: 16px;
            left: 16px;
            height: 32px;
        }

        .content {
            padding: 24px;
        }

        .camera-container {
            position: relative;
            width: 100%;
            margin-bottom: 24px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--light-gray);
        }

        #video {
            width: 100%;
            display: block;
            background-color: #f1f1f1;
            aspect-ratio: 4/3;
        }

        .placeholder {
            width: 100%;
            aspect-ratio: 4/3;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--gray-color);
            font-size: 0.875rem;
            gap: 12px;
        }

        .placeholder i {
            font-size: 2rem;
            color: var(--primary-light);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
        }

        button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        button:disabled {
            background: var(--light-gray);
            color: var(--gray-color);
            cursor: not-allowed;
            transform: none;
        }

        button.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--light-gray);
        }

        button.secondary:hover {
            background: #f5f5ff;
            border-color: var(--primary-light);
        }

        .status-container {
            margin-top: 20px;
        }

        .status {
            padding: 12px 16px;
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .status i {
            font-size: 1rem;
        }

        .status.success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--secondary-color);
            border-left: 3px solid var(--secondary-color);
        }

        .status.error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
            border-left: 3px solid var(--error-color);
        }

        .status.warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
            border-left: 3px solid var(--warning-color);
        }

        .info-card {
            background-color: #f8fafc;
            border-radius: var(--border-radius);
            padding: 16px;
            margin-top: 20px;
            border: 1px solid var(--light-gray);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: var(--gray-color);
            font-size: 0.875rem;
        }

        .info-value {
            font-weight: 500;
            text-align: right;
        }

        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        canvas {
            display: none;
        }

        .timestamp {
            text-align: center;
            font-size: 0.75rem;
            color: var(--gray-color);
            margin-top: 16px;
        }

        @media (max-width: 480px) {
            .content {
                padding: 20px;
            }

            .header {
                padding: 20px;
            }

            .header h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="attendance-container">
        <div class="header">
            <h2>Attendance Punch</h2>
            <p>Capture your face to record your attendance</p>
        </div>

        <div class="content">
            <div class="camera-container">
                <video id="video" width="320" height="240" autoplay playsinline></video>
                <div class="placeholder" id="placeholder">
                    <i class="fas fa-camera"></i>
                    <span>Camera access required for attendance</span>
                </div>
            </div>

            <div class="action-buttons">
                <button id="captureBtn" onclick="capture()">
                    <i class="fas fa-camera"></i>
                    <span id="buttonText">Capture & Punch Attendance</span>
                </button>
                <button class="secondary" onclick="retryCamera()">
                    <i class="fas fa-sync-alt"></i>
                    <span>Retry Camera</span>
                </button>
            </div>

            <div class="status-container" id="statusContainer"></div>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Current Time:</span>
                    <span class="info-value" id="currentTime"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Location:</span>
                    <span class="info-value" id="locationText">Detecting...</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Device:</span>
                    <span class="info-value" id="deviceInfo"></span>
                </div>
            </div>

            <div class="timestamp">
                <i class="fas fa-lock"></i> Secure connection • Your data is protected
            </div>
        </div>

        <canvas id="canvas"></canvas>

        <form id="punchForm" method="POST" action="{{ route('attendance.punch') }}">
            @csrf
            <input type="hidden" name="image" id="image">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="timezone" id="timezone">
            <input type="hidden" name="user_agent" id="userAgent">
        </form>
    </div>

    <script>
        // DOM Elements
        const video = document.getElementById('video');
        const placeholder = document.getElementById('placeholder');
        const captureBtn = document.getElementById('captureBtn');
        const buttonText = document.getElementById('buttonText');
        const locationText = document.getElementById('locationText');
        const currentTimeElement = document.getElementById('currentTime');
        const deviceInfoElement = document.getElementById('deviceInfo');
        const statusContainer = document.getElementById('statusContainer');
        const timezoneInput = document.getElementById('timezone');
        const userAgentInput = document.getElementById('userAgent');

        // Initialize camera
       async function initCamera() {
    try {
        // First check if we're on mobile and not HTTPS
        if (isMobile() && window.location.protocol !== 'https:') {
            throw new Error('Camera access requires HTTPS on mobile devices');
        }

        // Hide the placeholder and show loading
        placeholder.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Initializing camera...';

        // Request camera permissions
        const stream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: 'user',
                width: { ideal: 1280 },
                height: { ideal: 720 }
            },
            audio: false
        });

        video.srcObject = stream;
        placeholder.style.display = 'none';
        video.style.display = 'block';
        addStatus('Camera ready', 'success');
        captureBtn.disabled = false;
    } catch (err) {
        console.error("Camera error:", err);

        let errorMessage = 'Camera access required for attendance';
        let statusMessage = 'Camera access denied. Please enable camera permissions.';

        // Specific error handling
        if (err.name === 'NotAllowedError') {
            errorMessage = 'Permission denied. Please allow camera access in your browser settings.';
            statusMessage = 'Camera permission denied. Please check browser settings.';
        } else if (err.name === 'NotFoundError' || err.name === 'OverconstrainedError') {
            errorMessage = 'No camera found or camera not compatible';
            statusMessage = 'No compatible camera found.';
        } else if (err.message.includes('HTTPS')) {
            errorMessage = 'Camera access requires HTTPS on mobile devices';
            statusMessage = 'Secure connection (HTTPS) required for camera access on mobile.';
        }

        placeholder.innerHTML = `
            <i class="fas fa-camera-slash" style="color:var(--error-color)"></i>
            <span>${errorMessage}</span>
        `;
        addStatus(statusMessage, 'error');
        captureBtn.disabled = true;
    }
}

function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

        // Retry camera initialization
      function retryCamera() {
    clearStatus();

    // On mobile, we need user interaction to trigger camera access
    if (isMobile()) {
        addStatus('Tap the "Allow" button when prompted for camera access', 'warning');

        // Create a temporary button to trigger camera access
        const tempButton = document.createElement('button');
        tempButton.innerHTML = '<i class="fas fa-camera"></i> Allow Camera Access';
        tempButton.style.marginTop = '10px';
        tempButton.onclick = async () => {
            tempButton.remove();
            initCamera();
        };

        statusContainer.appendChild(tempButton);
        return;
    }

    // For desktop, proceed normally
    addStatus('Initializing camera...', 'warning');
    initCamera();
}
        // Add status message
        function addStatus(message, type = 'info') {
            clearStatus();
            const statusDiv = document.createElement('div');
            statusDiv.className = `status ${type}`;

            let icon;
            switch(type) {
                case 'success': icon = 'fas fa-check-circle'; break;
                case 'error': icon = 'fas fa-exclamation-circle'; break;
                case 'warning': icon = 'fas fa-exclamation-triangle'; break;
                default: icon = 'fas fa-info-circle';
            }

            statusDiv.innerHTML = `<i class="${icon}"></i> ${message}`;
            statusContainer.appendChild(statusDiv);
        }

        // Clear all status messages
        function clearStatus() {
            statusContainer.innerHTML = '';
        }

        // Reverse geocode coordinates to get location name
    // Improved location name fetching with building-level accuracy
async function getLocationName(latitude, longitude) {
    try {
        // First try with zoom=18 (most detailed)
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`);
        const data = await response.json();

        if (data.error || !data.address) {
            // Fallback to Google Maps API if available (uncomment if you have API key)
             return await getGoogleLocationName(latitude, longitude, 'AIzaSyDNIw0SSOdVl5oaXZcItI7TKeim9liCjNY');
            return "Location name not available";
        }

        const address = data.address;
        let locationParts = [];

        // Building-level details (most specific first)
        if (address.building) locationParts.push(address.building);
        if (address.house_number) locationParts.push(address.house_number);
        if (address.road) locationParts.push(address.road);
        
        // If we don't have building-level details, include more general ones
        if (locationParts.length === 0) {
            if (address.pedestrian) locationParts.push(address.pedestrian);
            if (address.footway) locationParts.push(address.footway);
            if (address.neighbourhood) locationParts.push(address.neighbourhood);
            if (address.suburb) locationParts.push(address.suburb);
        }
        
        // City-level details
        if (address.village) locationParts.push(address.village);
        if (address.town) locationParts.push(address.town);
        if (address.city) locationParts.push(address.city);
        if (address.county) locationParts.push(address.county);
        
        // Regional details
        if (address.state) locationParts.push(address.state);
        if (address.country) locationParts.push(address.country);

        // If we have a named building, that might be enough
        if (address.building && locationParts.length === 1) {
            // Try to get more context
            if (address.road) locationParts.push(address.road);
            if (address.neighbourhood) locationParts.push(address.neighbourhood);
        }

        // Fallback if we still have nothing
        if (locationParts.length === 0) {
            return `Near ${latitude.toFixed(6)}, ${longitude.toFixed(6)}`;
        }

        return locationParts.filter(Boolean).join(', ');
    } catch (error) {
        console.error("Geocoding error:", error);
        return "Location name not available";
    }
}

// Optional: Google Maps API fallback (uncomment and add your API key)

 async function getLocationName(latitude, longitude) {
            const apiKey = 'AIzaSyDNIw0SSOdVl5oaXZcItI7TKeim9liCjNY'; // Your Google API key
            try {
                const response = await fetch(
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}&result_type=premise|street_address|point_of_interest`
                );
                const data = await response.json();

                if (data.status !== "OK" || !data.results[0]) {
                    // Fallback to Nominatim if Google fails
                    return await getNominatimLocation(latitude, longitude);
                }

                // Try to get the most specific result first
                const specificResults = data.results.filter(result => 
                    result.types.includes('premise') || 
                    result.types.includes('street_address') ||
                    result.types.includes('point_of_interest')
                );

                // Return the most specific formatted address
                return specificResults[0]?.formatted_address || data.results[0].formatted_address;
            } catch (error) {
                console.error("Google Geocoding error:", error);
                return await getNominatimLocation(latitude, longitude);
            }
        }

        // Fallback to Nominatim if Google fails
        async function getNominatimLocation(latitude, longitude) {
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18`
                );
                const data = await response.json();
                
                if (data.address) {
                    return formatNominatimAddress(data.address);
                }
                return `Near ${latitude.toFixed(6)}, ${longitude.toFixed(6)}`;
            } catch (error) {
                console.error("Nominatim error:", error);
                return "Location name not available";
            }
        }

        function formatNominatimAddress(address) {
            const parts = [];
            if (address.building) parts.push(address.building);
            if (address.road) parts.push(address.road);
            if (address.neighbourhood) parts.push(address.neighbourhood);
            if (address.city || address.town || address.village) {
                parts.push(address.city || address.town || address.village);
            }
            if (address.country) parts.push(address.country);
            return parts.filter(Boolean).join(', ');
        }

// Main geolocation function
async function getLocation() {
    const locationText = document.getElementById('locationText') || document.createElement('div');
    
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            async (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Save to form inputs
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                // Show loading while fetching location name
                locationText.innerHTML = `
                    <strong>Coordinates:</strong> ${latitude.toFixed(6)}, ${longitude.toFixed(6)}
                    <br><i class="fas fa-circle-notch fa-spin"></i> Getting location name...
                `;

                try {
                    // Get readable location name
                    const locationName = await getLocationName(latitude, longitude);

                    // Show name + coordinates
                    locationText.innerHTML = `
                        <strong>${locationName}</strong><br>
                        <small>Lat: ${latitude.toFixed(6)}, Lng: ${longitude.toFixed(6)}</small>
                        <i class="fas fa-check-circle" style="color:var(--secondary-color)"></i>
                    `;

                    // Optional: Save name to hidden input (if added)
                    const locationNameInput = document.getElementById('locationName');
                    if (locationNameInput) locationNameInput.value = locationName;
                } catch (error) {
                    console.error("Location processing error:", error);
                    locationText.innerHTML = `
                        <i class="fas fa-exclamation-triangle" style="color:var(--warning-color)"></i> 
                        Could not determine address (coordinates: ${latitude.toFixed(6)}, ${longitude.toFixed(6)})
                    `;
                }
            },
            error => {
                console.error("Geolocation error:", error);
                let errorMessage = "Location not available";
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = "Location access denied. Please enable permissions.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = "Location information unavailable.";
                        break;
                    case error.TIMEOUT:
                        errorMessage = "Location request timed out.";
                        break;
                }
                
                locationText.innerHTML = `
                    <i class="fas fa-exclamation-triangle" style="color:var(--warning-color)"></i> 
                    ${errorMessage}
                `;
                
                if (typeof addStatus === 'function') {
                    addStatus('Location access denied. Attendance may require manager approval.', 'warning');
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    } else {
        locationText.innerHTML = `
            <i class="fas fa-exclamation-triangle" style="color:var(--warning-color)"></i> 
            Geolocation not supported by your browser
        `;
    }
}

// Initialize when needed
document.addEventListener('DOMContentLoaded', function() {
    // If you have a button with ID 'getLocationBtn'
    const locationButton = document.getElementById('getLocationBtn');
    if (locationButton) {
        locationButton.addEventListener('click', getLocation);
    }
    
    // Or call directly if you want automatic location on page load
    // getLocation();
});


        // Update current time
        function updateCurrentTime() {
            const now = new Date();
            const options = {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZoneName: 'short'
            };
            currentTimeElement.textContent = now.toLocaleString(undefined, options);
        }

        // Get device info
        function getDeviceInfo() {
            const userAgent = navigator.userAgent;
            userAgentInput.value = userAgent;

            // Simple device detection
            let deviceType = 'Desktop';
            if (/Mobi|Android/i.test(userAgent)) {
                deviceType = 'Mobile';
            } else if (/iPad|iPhone|iPod/i.test(userAgent)) {
                deviceType = 'iOS';
            } else if (/Tablet/i.test(userAgent)) {
                deviceType = 'Tablet';
            }

            const platform = navigator.platform;
            deviceInfoElement.textContent = `${deviceType} (${platform})`;
        }

        // Get timezone
        function getTimezone() {
            try {
                timezoneInput.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
            } catch (e) {
                timezoneInput.value = new Date().getTimezoneOffset() / -60;
            }
        }

        // Capture image and submit
        async function capture() {
            // Check if camera is accessible
            if (video.style.display === 'none') {
                addStatus('Please enable camera access first.', 'error');
                return;
            }

            // Change button state
            buttonText.innerHTML = '<span class="loading"></span> Processing...';
            captureBtn.disabled = true;

            // Capture image
            const canvas = document.getElementById('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const dataURL = canvas.toDataURL('image/jpeg', 0.85);
            document.getElementById('image').value = dataURL;

            try {
                // Submit form
                const response = await fetch(document.getElementById('punchForm').action, {
                    method: 'POST',
                    body: new FormData(document.getElementById('punchForm')),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    addStatus(data.message || 'Attendance recorded successfully!', 'success');
                    // Disable button temporarily after successful punch
                    setTimeout(() => {
                        captureBtn.disabled = false;
                        buttonText.innerHTML = '<i class="fas fa-check-circle"></i> Success';
                    }, 2000);
                    setTimeout(() => {
                        buttonText.textContent = 'Capture & Punch Attendance';
                    }, 4000);
                } else {
                    addStatus(data.message || 'Error recording attendance. Please try again.', 'error');
                    captureBtn.disabled = false;
                    buttonText.innerHTML = '<i class="fas fa-camera"></i> Capture & Punch Attendance';
                }
            } catch (error) {
                addStatus('Network error. Please check your connection and try again.', 'error');
                captureBtn.disabled = false;
                buttonText.innerHTML = '<i class="fas fa-camera"></i> Capture & Punch Attendance';
            }
        }

        // Initialize on load
        window.addEventListener('DOMContentLoaded', () => {
            // Initialize components
            initCamera();
            getLocation();
            getDeviceInfo();
            getTimezone();

            // Update time every second
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);

            // Add event listener for visibility change
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    updateCurrentTime();
                }
            });
        });

        // Clean up camera stream when page unloads
        window.addEventListener('beforeunload', () => {
            if (video.srcObject) {
                video.srcObject.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>
</html>
