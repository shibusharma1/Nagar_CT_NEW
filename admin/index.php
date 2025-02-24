<?php
$title = "Nagar CT | Dashboard";
$current_page = "index";

include_once 'master_header.php';
require_once '../config/connection.php';

?>
<h2>Dashboard</h2>
<div class="row">
    <div class="col-md-3">
        <div class="dashboard-card bg-blue">150 Users</div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card bg-green">53% Drivers</div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card bg-yellow">44 Vehicles</div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card bg-red">65 Booking</div>
    </div>
</div>
<div class="mt-4 text-center">
    <label for="chartType">Select Chart Type:</label>
    <select id="chartType" class="form-select w-25 d-inline-block">
        <option value="bar">Bar Chart</option>
        <option value="line">Line Chart</option>
        <option value="pie">Pie Chart</option>
    </select>
</div>
<div class="chart-container mt-3">
    <canvas id="dashboardChart"></canvas>
</div>
<div class="mt-4">
    <h4>Location Map</h4>
    <div id="map"></div>
</div>
</div>
<script>
    let ctx = document.getElementById('dashboardChart').getContext('2d');
    let chartType = document.getElementById('chartType').value;
    let dashboardChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Users',
                data: [30, 50, 70, 40, 90, 60],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
    document.getElementById('chartType').addEventListener('change', function () {
        dashboardChart.destroy();
        dashboardChart = new Chart(ctx, { type: this.value, data: dashboardChart.data });
    });

    function initMap() {
    let defaultLocation = { lat: 26.4484334, lng: 87.2758998 }; // Fallback location

    let map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLocation,
        zoom: 100,
        mapTypeId: 'roadmap'
    });

    // Check if Geolocation is supported
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Set map center to user's current location
                map.setCenter(userLocation);

                // Add a marker at user's location
                new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "You are here!"
                });
            },
            function (error) {
                console.error("Geolocation error:", error);
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 } // High accuracy settings
        );
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

window.onload = initMap;


</script>

<?php
include_once 'master_footer.php';
?>