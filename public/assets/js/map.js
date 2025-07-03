// Global variables
let map;
let directionsService;
let directionsRenderer;
let destinationMarker;
// Exact coordinates for Selinite Building, Gitimbine, Meru, Kenya
// Note: You should verify these coordinates are correct for your exact location
const destination = { lat: 0.0499, lng: 37.6507 }; 

// Initialize the map
function initMap() {
    try {
        // Create map centered on destination
        map = new google.maps.Map(document.getElementById("map"), {
            center: destination,
            zoom: 15,
            mapTypeControl: true,
            streetViewControl: true,
            fullscreenControl: true,
        });
        
        // Create directions service and renderer
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            panel: document.getElementById("directionsPanel"),
            suppressMarkers: true
        });
        
        // Add destination marker
        destinationMarker = new google.maps.Marker({
            position: destination,
            map: map,
            title: "Selinite Building, 2nd Floor, Gitimbine, Meru, Kenya",
            animation: google.maps.Animation.DROP,
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
            }
        });
        
        // Add info window for the destination marker
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div style="padding: 8px; max-width: 200px;">
                    <h3 style="font-weight: bold; font-size: 16px; margin-bottom: 4px;">Dairy Union Office</h3>
                    <p style="font-size: 14px; margin: 0 0 4px 0;">Selinite Building, 2nd Floor</p>
                    <p style="font-size: 14px; margin: 0;">Gitimbine, Meru, Kenya</p>
                </div>
            `
        });
        
        // Open info window when marker is clicked
        destinationMarker.addListener("click", () => {
            infoWindow.open(map, destinationMarker);
        });
        
        // Open info window by default
        infoWindow.open(map, destinationMarker);
        
        // Add event listener to the Get Directions button
        const directionsBtn = document.getElementById("getDirectionsBtn");
        if (directionsBtn) {
            directionsBtn.addEventListener("click", getDirectionsFromCurrentLocation);
        }
    } catch (error) {
        console.error("Error initializing map:", error);
        document.getElementById('map').style.height = '100px';
        document.getElementById('mapError').classList.remove('hidden');
    }
}

// Get directions from user's current location
function getDirectionsFromCurrentLocation() {
    // Check if geolocation is supported by the browser
    if (navigator.geolocation) {
        // Show loading state
        const button = document.getElementById("getDirectionsBtn");
        const originalText = button.innerHTML;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Getting your location...
        `;
        
        // Get current position
        navigator.geolocation.getCurrentPosition(
            (position) => {
                // Get user's location
                const origin = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                
                // Calculate and display directions
                calculateAndDisplayRoute(origin);
                
                // Reset button text
                button.innerHTML = originalText;
                
                // Show directions panel
                document.getElementById("directionsPanel").classList.remove("hidden");
            },
            (error) => {
                // Handle geolocation error
                let errorMessage = "Could not get your location. ";
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage += "You denied the request for geolocation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage += "Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        errorMessage += "The request to get your location timed out.";
                        break;
                    case error.UNKNOWN_ERROR:
                        errorMessage += "An unknown error occurred.";
                        break;
                }
                
                alert(errorMessage);
                
                // Reset button text
                button.innerHTML = originalText;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    } else {
        // Browser doesn't support geolocation
        alert("Your browser does not support geolocation. Please try using the 'Open in Google Maps' link instead.");
    }
}

// Calculate and display the route
function calculateAndDisplayRoute(origin) {
    directionsService.route(
        {
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING,
            provideRouteAlternatives: true
        },
        (response, status) => {
            if (status === "OK") {
                directionsRenderer.setDirections(response);
                
                // Fit the map to show the entire route
                const bounds = new google.maps.LatLngBounds();
                bounds.extend(origin);
                bounds.extend(destination);
                map.fitBounds(bounds);
                
                // Keep the destination marker
                destinationMarker.setMap(map);
            } else {
                // Handle route calculation error
                alert("Directions request failed due to " + status);
            }
        }
    );
}

// Handle map loading errors
function handleMapError() {
    document.getElementById('map').style.height = '100px';
    document.getElementById('mapError').classList.remove('hidden');
    console.error('Failed to load Google Maps. Please check your connection and try again.');
}

// Initialize map when the page loads
window.initMap = initMap;
window.handleMapError = handleMapError;