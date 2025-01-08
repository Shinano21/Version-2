import { filter_by_sex } from "./map_func/filter_sex.js";
import { filter_by_purok } from "./map_func/filter_purok.js";
import { filter_by_age } from "./map_func/filter_age.js";
import { previousBoundaryLayer } from "./map_func/filter_purok.js";
import { removeLayer } from "./map_func/filter_purok.js";
// const map = L.map("map").setView([13.143991203443381, 123.71526002883913], 16); // Set the initial view and zoom level
const map = L.map('map').setView([13.142307, 123.71827], 12); // Set the initial view and zoom level
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map); // Add a basemap (OpenStreetMap)
// Add the fullscreen control
map.addControl(L.control.fullscreen());
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4) {
    if (this.status == 200) {
      if (this.responseText) {
        try {
          // Extracting the data from SQL database
          var data = JSON.parse(this.responseText); // Parse the JSON response // Access the data from the PHP file
          let markers = [];
          document
            .getElementById("groupSelect")
            .addEventListener("change", function () {
              var selectedValue = this.value; // Get the selected value
              var label = this.options[this.selectedIndex].parentNode.label;
              markers.forEach((marker) => {
                marker.remove(); // Remove each marker from the map
              });
              markers = []; // Clear the markers array
              // Pass the selected value to a function or perform actions based on the value
              processSelectedValue(selectedValue, label);
            });
          function processSelectedValue(value, label) {
            // Perform actions based on the selected value
            if (label != "Filter By Purok") {
              removeLayer(map, previousBoundaryLayer);
            }
            if (label == "Filter By Age") {
              filter_by_age(data, value, map, markers);
            } else if (label == "Filter By Sex") {
              filter_by_sex(data, value, map, markers);
            } else {
              filter_by_purok(data, value, map, markers);
            }
          }
        } catch (error) {
          console.error("Error parsing JSON: " + error);
        }
      } else {
        console.error("Empty response");
      }
    } else {
      console.error("Request failed with status: " + this.status);
    }
  }
};
xhttp.open("GET", "extract.php", true); // Request to extract.php
xhttp.send();


