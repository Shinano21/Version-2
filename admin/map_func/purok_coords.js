export let coords = []; // Export `coords`

fetch('map_func/fetch_purok_data.php')
    .then(response => response.json())
    .then(data => {
        coords = data; // Update `coords` with fetched data
        console.log("Purok Coordinates Loaded:", coords);
    })
    .catch(error => console.error('Error fetching purok data:', error));
