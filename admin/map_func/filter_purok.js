import { coords } from "./purok_coords.js";

export function removeLayer(map, layer) {
  if (layer) {
    layer.removeFrom(map);
  }
}

export let previousBoundaryLayer = null;

function addPolygons(map) {
  // Check if the polygons layer is already added
  if (previousBoundaryLayer) {
    return;
  }

  // Iterate over all puroks and display polygons
  Object.keys(coords).forEach((purok) => {
    let bagumbayanBoundary = {
      type: "Feature",
      properties: {
        color: coords[purok].color,
        label: purok,
      },
      geometry: {
        type: "Polygon",
        coordinates: [coords[purok].coord],
      },
    };

    let newBoundaryLayer = L.geoJSON(bagumbayanBoundary, {
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

    // Update the previousBoundaryLayer to the last added layer
    previousBoundaryLayer = newBoundaryLayer;
  });
}

export function filter_by_purok(data, value, map, markers) {
  // Clear existing markers
  markers.forEach(marker => marker.removeFrom(map));
  markers.length = 0;

  // Clear existing polygons
  if (previousBoundaryLayer) {
    removeLayer(map, previousBoundaryLayer);
    previousBoundaryLayer = null;
  }

  // Display markers for all puroks when 'all' is selected
  if (value === "All") {
    data.forEach((p) => {
      let popupContent = `<p><b>Name:</b> ${p.fname} ${p.mname} ${p.lname}<br/><b>Address:</b> ${p.street}, ${p.zone}, ${p.brgy}, ${p.mun}, ${p.province}
                <br/><b>Sex:</b> ${p.sex}</br><b>Contact Number:</b> ${p.contact}</br><b>Status:</b> ${p.status}</p>`;
      let popup = L.popup().setContent(popupContent);
      let marker = L.marker([p.latitude, p.longitude]).addTo(map);
      marker.on("mouseover", function (e) {
        this.bindPopup(popup).openPopup();
      });

      marker.on("mouseout", function (e) {
        this.closePopup();
      });
      markers.push(marker);
    });
  } else if (value) {
    // Display markers only for the selected purok
    let puroks = data.filter((row) => row.zone == value);
    puroks.forEach((p) => {
      let popupContent = `<p><b>Name:</b> ${p.fname} ${p.mname} ${p.lname}<br/><b>Address:</b> ${p.street}, ${p.zone}, ${p.brgy}, ${p.mun}, ${p.province}
                <br/><b>Sex:</b> ${p.sex}</br><b>Contact Number:</b> ${p.contact}</br><b>Status:</b> ${p.status}</p>`;
      let popup = L.popup().setContent(popupContent);
      let marker = L.marker([p.latitude, p.longitude]).addTo(map);
      marker.on("mouseover", function (e) {
        this.bindPopup(popup).openPopup();
      });

      marker.on("mouseout", function (e) {
        this.closePopup();
      });
      markers.push(marker);
    });
  }

  // Clear existing polygons
  map.eachLayer((layer) => {
    if (layer instanceof L.GeoJSON) {
      map.removeLayer(layer);
    }
  });

  // Add polygons after clearing existing ones
  addPolygons(map);
}
