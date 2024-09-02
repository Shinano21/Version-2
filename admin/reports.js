var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
  if (this.readyState == 4) {
    if (this.status == 200) {
      if (this.responseText) {
        try {
          // Extracting the data from SQL database
          var data = JSON.parse(this.responseText); // Parse the JSON response // Access the data from the PHP file
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
