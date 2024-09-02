import { coords } from "./purok_coords.js";

export function filter_by_sex(data, value, map, markers) {
  let male = data.filter((row) => row.sex == "Male");
  let female = data.filter((row) => row.sex == "Female");

  // Define icons for markers
  var pinkIcon = L.icon({
    iconUrl: "images/pink-pin.png", 
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
  });

  var blueIcon = L.icon({
    iconUrl: "images/blue.png", 
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
  });

  // Function to add polygons to the map
  function addPolygons(map) {
    Object.keys(coords).forEach((zone) => {
      let zoneBoundary = {
        type: "Feature",
        properties: {
          color: coords[zone].color,
          label: zone,
        },
        geometry: {
          type: "Polygon",
          coordinates: [coords[zone].coord],
        },
      };

      let boundaryLayer = L.geoJSON(zoneBoundary, {
        style: function (feature) {
          return {
            fillColor: feature.properties.color,
            color: feature.properties.color,
            weight: 0.5,
            fillOpacity: 0.2,
          };
        },
        onEachFeature: function (feature, layer) {
          layer.bindPopup(feature.properties.label);
        },
      }).addTo(map);
    });
  }

  // Function to filter and display male markers
  function filter_male(male, map, markers) {
    male.forEach((m) => {
      let popupContent = `<p><b>Name:</b> ${m.fname} ${m.mname} ${m.lname}<br/><b>Address:</b> ${m.street}, ${m.zone}, ${m.brgy}, ${m.mun}, ${m.province}
                <br/><b>Sex:</b> ${m.sex}</br><b>Contact Number:</b> ${m.contact}</br><b>Status:</b> ${m.status}</p>`;
      let popup = L.popup().setContent(popupContent);
      let marker = L.marker([m.latitude, m.longitude], {
        icon: blueIcon,
      }).addTo(map);
      marker.on("mouseover", function (e) {
        this.bindPopup(popup).openPopup();
      });

      marker.on("mouseout", function (e) {
        this.closePopup();
      });
      markers.push(marker);
    });
  }

  // Function to filter and display female markers
  function filter_female(female, map, markers) {
    female.forEach((f) => {
      let popupContent = `<p><b>Name:</b> ${f.fname} ${f.mname} ${f.lname}<br/><b>Address:</b> ${f.street}, ${f.zone}, ${f.brgy}, ${f.mun}, ${f.province}
                <br/><b>Sex:</b> ${f.sex}</br><b>Contact Number:</b> ${f.contact}</br><b>Status:</b> ${f.status}</p>`;
      let popup = L.popup().setContent(popupContent);
      let marker = L.marker([f.latitude, f.longitude], {
        icon: pinkIcon,
      }).addTo(map);
      marker.on("mouseover", function (e) {
        this.bindPopup(popup).openPopup();
      });

      marker.on("mouseout", function (e) {
        this.closePopup();
      });
      markers.push(marker);
    });
  }

  // Clear existing markers
  markers.forEach(marker => marker.removeFrom(map));
  markers.length = 0;

  // Clear existing polygons
  map.eachLayer((layer) => {
    if (layer instanceof L.GeoJSON) {
      map.removeLayer(layer);
    }
  });

  // Add polygons to the map
  addPolygons(map);

  // Display markers based on selected value
  if (value === "male") {
    filter_male(male, map, markers);
  } else if (value === "female") {
    filter_female(female, map, markers);
  } else {
    filter_male(male, map, markers);
    filter_female(female, map, markers);
  }
}
