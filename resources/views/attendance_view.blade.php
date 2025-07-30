<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        #map { height: 500px; }
        .location-marker { cursor: pointer; }
        .info-window { max-width: 300px; }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Location Map</h5>
                        <button id="refreshMap" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Location Details</h5>
                    </div>
                    <div class="card-body" id="locationDetails">
                        <p class="text-muted">Select a location from the map or table</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>All Locations</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="locationsTable">
                           <thead>
     
                            <tbody>
                                <!-- Filled by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Initialize map
        const map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Store markers
        const markers = [];
        let selectedMarker = null;

        // Load locations from API
 async function getLocationName(latitude, longitude) {
    try {
        // Try Google Maps Geocoding API first
        const googleResponse = await axios.get(
            `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=YOUR_GOOGLE_API_KEY`
        );
        
        if (googleResponse.data.results[0]?.formatted_address) {
            return googleResponse.data.results[0].formatted_address;
        }

        // Fallback to Nominatim (OpenStreetMap)
        const nominatimResponse = await axios.get(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`
        );
        
        if (nominatimResponse.data.display_name) {
            return nominatimResponse.data.display_name;
        }

        return "Location name not available";
    } catch (error) {
        console.error("Geocoding error:", error);
        return "Could not determine location name";
    }
}

async function loadLocations() {
    try {
        const response = await axios.get('/locations');
        const locations = response.data;

        // Process locations with geocoding
        const processedLocations = await Promise.all(locations.map(async location => {
            const lat = parseFloat(location.latitude) || 0;
            const lng = parseFloat(location.longitude) || 0;
            
            return {
                ...location,
                latitude: lat,
                longitude: lng,
                locationName: await getLocationName(lat, lng)
            };
        }));

        // Clear existing markers
        markers.forEach(marker => map.removeLayer(marker));
        markers.length = 0;
        
        // Add new markers
        processedLocations.forEach(location => {
            const marker = L.marker([location.latitude, location.longitude], {
                locationId: location.id
            }).addTo(map);
            
            marker.bindPopup(`
                <div class="info-window">
                    <h6>${location.user?.name || 'Unknown User'}</h6>
                    <p>${location.user?.email || ''}</p>
                    <small>Recorded: ${new Date(location.created_at).toLocaleString()}</small>
                    <hr>
                    <small>Location: ${location.locationName}</small>
                    <small class="text-muted d-block mt-1">Coordinates: ${location.latitude.toFixed(6)}, ${location.longitude.toFixed(6)}</small>
                </div>
            `);
            
            marker.on('click', () => showLocationDetails(location));
            markers.push(marker);
        });
        
        updateTable(processedLocations);
        
        if (processedLocations.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds());
        }
        
    } catch (error) {
        console.error('Error loading locations:', error);
        alert('Failed to load locations. Please check console for details.');
    }
}

function updateTable(locations) {
    const tbody = document.querySelector('#locationsTable tbody');
    tbody.innerHTML = '';
    
    locations.forEach(location => {
        const row = document.createElement('tr');
        row.className = 'location-marker';
        row.dataset.locationId = location.id;
        row.innerHTML = `
            <td>${location.id}</td>
            <td>${location.user?.name || 'Unknown'}</td>
            <td>${location.user?.email || ''}</td>
            <td>${location.locationName || 'Loading...'}</td>
            <td>${new Date(location.created_at).toLocaleString()}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary view-btn" data-id="${location.id}">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        `;
        
        row.addEventListener('click', () => {
            const marker = markers.find(m => m.options.locationId === location.id);
            if (marker) {
                map.setView(marker.getLatLng(), 15);
                marker.openPopup();
                showLocationDetails(location);
            }
        });
        
        tbody.appendChild(row);
    });
}

        // Show location details in sidebar
        function showLocationDetails(location) {
    const detailsDiv = document.getElementById('locationDetails');
    detailsDiv.innerHTML = `
        <h6>${location.user?.name || 'Unknown User'}</h6>
        <p><strong>Email:</strong> ${location.user?.email || 'N/A'}</p>
        <p><strong>Recorded at:</strong> ${new Date(location.created_at).toLocaleString()}</p>
        <hr>
        <p><strong>Coordinates:</strong><br>
        Latitude: ${location.latitude.toFixed(6)}<br>
        Longitude: ${location.longitude.toFixed(6)}</p>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" onclick="navigateToLocation(${location.latitude}, ${location.longitude})">
                <i class="fas fa-map-marked-alt"></i> Open in Maps
            </button>
        </div>
    `;
}

        // Open in external maps
        function navigateToLocation(lat, lng) {
            window.open(`https://www.google.com/maps?q=${lat},${lng}`, '_blank');
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            loadLocations();
            
            // Refresh button
            document.getElementById('refreshMap').addEventListener('click', loadLocations);
        });
    </script>
</body>
</html>