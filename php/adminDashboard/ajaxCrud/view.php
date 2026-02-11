<?php
include_once('../adminLteCrud/db.php');
include_once('../includes/header.php');
include_once('../includes/sidebar.php');
include_once('../adminLteCrud/auth.php');
$sql = "SELECT * FROM ajax_users";
$result = mysqli_query($conn, $sql);
?>
<!-- jQuery + jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<style>
  #dialogForm {
    display: none;
  }

  .error {
    color: red;
    font-size: 13px;
  }
</style>

<!-- <main class="app-main"> -->
<div class="app-content">
  <div class="container-fluid">
    <!-- ADD USER BUTTON -->
    <button class="btn btn-primary mb-3" id="openAddUser">Add User</button>
    <!-- USER TABLE -->
    <div class="card mb-4">
      <div class="card-body">
        <table id="userTable" class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>First</th>
              <th>Last</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Hobby</th>
              <th>Country</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              $userImage = (!empty($row['profile_image'])) ?
                "upload/" . $row['profile_image'] :
                "../assets/download.jpeg";
            ?>
              <tr class="align-middle" id="row_<?= $row['id'] ?>">
                <td><?= $row['id'] ?></td>
                <td><img src="<?= $userImage ?>" width="50"></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['hobby'] ?></td>
                <td><?= $row['country'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                  <button class="badge text-bg-primary" id="openEditUser" onclick="editUser(<?= $row['id'] ?>)">Edit</button>
                  <button class="badge text-bg-danger" id="deleteBtn" onclick="deleteData(<?= $row['id'] ?>)">Delete</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- POPUP FORM -->
<div id="dialogForm" title="Add/Edit User">
  <form id="myForm" enctype="multipart/form-data">
    <input type="hidden" id="id">
    <!--begin::Body-->
    <div class="card-body">
      <div class="mb-3">
        <label for="firstName" class="form-label">First
          Name</label>
        <input
          type="text"
          name="firstName"
          id="firstName"
          class="form-control" />
        <!-- <p id="fnameCheck" style="color: red;">First name is required.</p> -->
        <span class="error" id="firstNameError"></span>
      </div>

      <div class="mb-3">
        <label for="lastName" class="form-label">Last
          Name</label>
        <input
          type="text"
          name="lastName"
          id="lastName"
          class="form-control" />
        <!-- <p id="lnameCheck" style="color: red;">Last name is required.</p> -->
        <span class="error" id="lastNameError"></span>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email
          address</label>
        <input
          type="email"
          name="email"
          class="form-control"
          id="email"
          aria-describedby="emailHelp" />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
        <!-- <p id="emailCheck" style="color: red;"></p> -->
        <span class="error" id="emailError"></span>
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1"
          class="form-label">Password</label>
        <input type="password" class="form-control"
          name="password" id="password" autocomplete="off" />
        <!-- <p id="passwordCheck" style="color: red;">Password is required.</p> -->
        <span class="error" id="passwordError"></span>

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1"
          class="form-label">Confirm Password</label>
        <input type="password" class="form-control"
          name="confirmPassword" id="confirmPassword" autocomplete="off" />
        <!-- <p class="confirmPasswordCheck" style="color: red;">Confirm passwords is required!</p> -->
        <span class="error" id="confirmPasswordError"></span>
      </div>

      <div class="input-group mb-3">
        <input type="file" name="profileImage"
          class="form-control" id="profileImage" />
        <!-- <p class="profileImageCheck" style="color: red;">No file selected. The file field is required.</p> -->
        <span class="error" id="fileError"></span>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text">Address</span>
        <textarea class="form-control"
          aria-label="With textarea" name="address" id="address"></textarea>
        <!-- <p class="addressCheck" style="color: red;">address is required.</p> -->
        <span class="error" id="addressError"></span>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input
          type="number"
          name="phone"
          class="form-control"
          id="phone" />
        <!-- <p class="phoneCheck" style="color: red;">Phone is required</p> -->
        <span class="error" id="phoneNumberError"></span>

      </div>

      <fieldset class="row mb-3">
        <legend
          class="col-form-label col-sm-2 pt-0">Gender</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gridRadios1"
              value="Male"
              <label class="form-check-label" for="gridRadios1">
            Male </label>
          </div>
          <div class="form-check">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gridRadios2"
              value="Female" />
            <label class="form-check-label" for="gridRadios2">
              Female </label>
          </div>
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gridRadios3"
              value="Other" />
            <label class="form-check-label" for="gridRadios3">
              Other </label>
          </div>
        </div>
        <!-- <p class="genderCheck" style="color: red;">please select at least one gender.</p> -->
        <span class="error" id="genderError"></span>
      </fieldset>

      hobby
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input hobby"
          name="hobby[]" value="Reading">
        <label class="form-check-label"
          for="exampleCheck1">Reading</label>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input hobby"
          name="hobby[]" value="Coading" />
        <label class="form-check-label"
          for="exampleCheck2">Coading</label>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input hobby"
          name="hobby[]" value="Gaming" />
        <label class="form-check-label"
          for="exampleCheck3">Gaming</label>
      </div>
      <!-- <p class="hobbyCheck" style="color: red;">please select at least one hobby.</p> -->
      <span class="error" id="hobbyError"></span>

      <div class="col-md-6">
        <label for="validationCustom04"
          class="form-label">Country</label>
        <select class="form-select" id="country"
          name="country">
          <option disabled value="">Choose...</option>
          <option selected>India</option>
          <option>USA</option>
          <option>UK</option>
        </select>
        <span class="error" id="countryError"></span>
      </div>
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer">
      <input type="submit" name="submit" class="btn btn-primary" value="Add" />
    </div>
    <!--end::Footer-->
  </form>

  <div id="message"></div>
</div>
<script src="js/script.js"></script>

<?php include_once('../includes/footer.php'); ?>