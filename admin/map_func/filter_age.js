import { coords } from "./purok_coords.js";

export function filter_by_age(data, value, map, markers) {
  var today = new Date();
  var filteredData = [];

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

  switch (value) {
    case "inf": {
      filteredData = data.filter((person) => calculateAge(person.bday) < 1);
      break;
    }
    case "tod": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) >= 1 && calculateAge(person.bday) <= 5
      );
      break;
    }
    case "kids": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 5 && calculateAge(person.bday) <= 12
      );
      break;
    }
    case "teen": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 12 && calculateAge(person.bday) <= 19
      );
      break;
    }
    case "twenty": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 19 && calculateAge(person.bday) <= 29
      );
      break;
    }
    case "thirty": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 29 && calculateAge(person.bday) <= 39
      );
      break;
    }
    case "forty": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 39 && calculateAge(person.bday) <= 49
      );
      break;
    }
    case "fifty": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 49 && calculateAge(person.bday) <= 59
      );
      break;
    }
    case "sixty": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 59 && calculateAge(person.bday) <= 69
      );
      break;
    }
    case "seventy": {
      filteredData = data.filter(
        (person) =>
          calculateAge(person.bday) > 69 && calculateAge(person.bday) <= 79
      );
      break;
    }
    case "oldies": {
      filteredData = data.filter((person) => calculateAge(person.bday) > 79);
      break;
    }
  }
  filter_age(filteredData, map, markers);

  function filter_age(person, map, markers) {
    person.forEach((p) => {
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

  function calculateAge(birthday) {
    var birthDate = new Date(birthday);
    var ageDate = new Date(today - birthDate);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
  }

  // Clear existing polygons
  map.eachLayer((layer) => {
    if (layer instanceof L.GeoJSON) {
      map.removeLayer(layer);
    }
  });

  // Add polygons to the map
  addPolygons(map);
}