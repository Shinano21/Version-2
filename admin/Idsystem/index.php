<?php  
// Connect to the Database
include('config.php');

$update = false;
$delete = false;
$already_card = false;

if (isset($_GET['delete'])) {
    // Handle delete action
    $id = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `residents` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $id = $_POST["snoEdit"];
        $fname = $_POST["fnameEdit"];
        $id_card_no = $_POST["id_noEdit"];

        // SQL query to update the record
        $sql = "UPDATE `residents` SET `fname` = '$fname', `id_card_no` = '$id_card_no' WHERE `residents`.`id` = $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully: " . mysqli_error($conn);
        }
    }
}

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
<link rel="icon" type="image/png" href="images/favicon.png"/>
  <title>Add New Student | Coding Cush</title>

</head>

<style>
  /* From Uiverse.io by SachinKumar666 */ 

.container {
   padding: 20px;
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
 border: 2px dashed #00BFA6;
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

</style>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit This container</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="name">Student Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit">
            </div>

            <div class="form-group">
              <label for="desc">ID Card Number:</label>
              <input class="form-control" id="id_noEdit" name="id_noEdit" rows="3"></input>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<!-- Navigation bar end  -->


  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Card has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Card has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

     <?php
  if($already_card){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Error!</strong> This Card is Already Added.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
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
            <button class='edit btn btn-sm btn-primary' id='{$row['id']}'>Edit Card No.</button>
          
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
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        id_no = tr.getElementsByTagName("td")[1].innerText;
        console.log(name, id_no);
        nameEdit.value = name;
        id_noEdit.value = id_no;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
