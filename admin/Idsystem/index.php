<?php  
// Connect to the Database
include('config.php');

// Fetch all residents' data for display
$sql = "SELECT id, fname, mname, lname, suffix, sex, bday, street, zone, brgy, mun, contact, id_card_no FROM residents";
$result = mysqli_query($conn, $sql);
?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="../images/techcareLogo2.png" type="image/x-icon">

  <title>Generate ID | TechCare</title>

</head>

<style>
  /* From Uiverse.io by SachinKumar666 */ 
  body{
    background-color: #CDE8E5;
  }

.container {
   padding: 20px;
   margin-top: 85px !important; /* Adjust the value as needed */
  /* display: flex;
  justify-content: center;
  align-items: center;
  width: 190px;
  height: 254px;  */
  
  background: rgb(255, 255, 255);
  border-radius: 1rem;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
    rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  transition: all ease-in-out 0.3s;
}

.container:hover {
  background-color: #fdfdfd;
  box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px,
    rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px,
    rgba(0, 0, 0, 0.09) 0px 32px 16px;
}
/* From Uiverse.io by Shakil-Babu */ 
.btn-generate {
 background-color: #4D869C;
 padding:  10px;
 color: #fff;
 text-transform: uppercase;
 letter-spacing: 2px;
 cursor: pointer;
 border-radius: 10px;
 /* border: 2px dashed #00BFA6; */
 box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
 transition: .4s;
}

.btn-generate span:last-child {
 display: none;
}

.btn-generate:hover {
 transition: .4s;
 border: 2px dashed #00BFA6;
 background-color: #fff;
 color: #00BFA6;
 text-decoration: none;
}

.btn-generate:active {
 background-color: #87dbd0;
}

#backToHome {
    position: absolute;
    top: 20px;
    left: 10%;
    transform: translateX(-50%);
    color: #646665;
    
}

.edit-btn {
    background-color: #4D869C; /* Original background color */
    color: white; /* Text color */
    border: none; /* Remove border */
    padding: 8px 16px; /* Add padding */
    cursor: pointer; /* Add pointer cursor on hover */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition for background and text color */
}

.edit-btn:hover {
    background-color: #3399FF; /* Slightly blue background color on hover */
    color: white; /* Font color on hover */
}
</style>

<body>
 <!-- Edit Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Resident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
  <p><strong>Name:</strong> <span id="nameView"></span></p>
  <p><strong>ID Card No:</strong> <span id="id_noView"></span></p>
  <p><strong>Sex:</strong> <span id="sexView"></span></p>
  <p><strong>Zone:</strong> <span id="zoneView"></span></p>
  <p><strong>Street:</strong> <span id="streetView"></span></p>
  <p><strong>Barangay:</strong> <span id="brgyView"></span></p>
  <p><strong>Municipality:</strong> <span id="munView"></span></p>
  <p><strong>Contact:</strong> <span id="contactView"></span></p>
</div>

            <div class="modal-footer d-block ml-auto">
                <button type="button" class="btn btn-secondary" style="background-color: #4D869C;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

  <a href="../home.php" id="backToHome">
    <h7><i class="fa fa-long-arrow-left">&nbsp;&nbsp;</i> Back to Home</h7>
 </a>

  <div class="container my-4 mt-5">

  <a href="id-card.php" class="btn-generate">
  <i class="fa fa-address-card"></i> Generate ID Card
</a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">


  </div>
</div>
  <div class="container-main my-4 mt-5">

  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">ID Card No.</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      // Fetching data from the 'residents' table
      $sql = "SELECT id, fname, mname, lname, id_card_no FROM `residents` ORDER BY id DESC";
      $result = mysqli_query($conn, $sql);
      $sno = 0;

      // Display each row of data
      while($row = mysqli_fetch_assoc($result)){
        $sno++;
        $full_name = $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'];
        echo "<tr>
          <th scope='row'>{$sno}</th>
          <td>{$full_name}</td>
          <td>{$row['id_card_no']}</td>
          <td>
            <button class='edit btn btn-sm edit-btn' data-id='{$row['id']}'>View Resident</button>

          </td>
        </tr>";
      }
    ?>
  </tbody>
</table>


  </div>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  const edits = document.getElementsByClassName('edit');
  
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", function (e) {
      const residentId = e.target.getAttribute('data-id'); // Get the ID of the resident

      // Perform an AJAX request to fetch the full details of the resident
      fetch('get_resident_details.php?id=' + residentId)
        .then(response => response.json())
        .then(data => {
          // Populate the modal with the resident's details
          document.getElementById('nameView').innerText = data.full_name;
          document.getElementById('id_noView').innerText = data.id_card_no;
          document.getElementById('sexView').innerText = data.sex;
          document.getElementById('zoneView').innerText = data.zone;
          document.getElementById('streetView').innerText = data.street;
          document.getElementById('brgyView').innerText = data.brgy;
          document.getElementById('munView').innerText = data.mun;
          document.getElementById('contactView').innerText = data.contact;

          // Show the modal
          $('#viewModal').modal('toggle');
        })
        .catch(error => {
          console.error('Error fetching resident details:', error);
        });
    });
  });
});

</script>
</body>

</html>
