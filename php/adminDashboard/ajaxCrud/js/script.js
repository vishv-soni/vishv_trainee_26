$(document).ready(function () {
  function resetFormAndErrors() {
    $("#myForm")[0].reset();
    $(".error").text("");
  }

  // Initialize dialog
  $("#dialogForm").dialog({
    autoOpen: false,
    modal: true,
    width: 400,
    height: 500, overflow: 'auto',
    zIndex: 1000,

    close: function () {
      resetFormAndErrors();
    }
  });

  // Open popup for Add User
  $("#openAddUser").on("click", function () {
    resetFormAndErrors();
    $("#dialogForm").dialog("open");
    $("#myForm input[type='submit']").val("Update"); // Change submit button text to "Add"
  });

  // Open popup for Edit User
  window.editUser = function (id) {
    resetFormAndErrors();
    $.ajax({
      type: "POST",
      url: "ajaxGetUser.php", // You'll create this file to fetch user data
      data: { id: id },
      success: function (response) {
        var user = JSON.parse(response);
        $('input[name="hobby[]"]').prop('checked', false);
        // Pre-fill the form with the user's data
        $("#firstName").val(user.first_name);
        $("#id").val(user.id);

        $("#lastName").val(user.last_name);
        $("#email").val(user.email);
        $("#phone").val(user.phone);
        $("#address").val(user.address);
        $("#country").val(user.country);
        user.hobby.split(",").forEach(function (hobby) {
          $("input[name='hobby[]'][value='" + hobby + "']").prop('checked', true);
        });
        $("input[name='gender'][value='" + user.gender + "']").prop('checked', true);
        // Open the form dialog
        $("#dialogForm").dialog("open");
        $("#myForm input[type='submit']").val("Update"); // Change submit button text to "Update"
        $("#myForm").attr("data-id", id); // Store user id in the form
      }
    });
  };

  //delete user
  window.deleteData = function (id) {
    if (confirm("Are you sure?")) {
      $.ajax({
        type: "POST",
        url: "ajaxDelete.php",
        data: {
          id: id
        },
        success: function (response) {
          if (response == "success") {
            alert("Data Deleted Successfully");
            $('#row_' + id).fadeOut(300, function () {
              $(this).remove();
            });
            // location.reload();
          } else {
            alert("Delete Failed: " + response);
          }
        }
      });
    }
  }

  // Form submit event
  $("#myForm").on("submit", function (e) {
    e.preventDefault();

    $(".error").text(""); // Clear previous errors
    let isValid = true;
    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let email = $("#email").val();
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    let password = $("#password").val();
    let confirmPassword = $("#confirmPassword").val();
    let address = $("#address").val();
    let phoneNumber = $("#phone").val();
    let countryName = $("#country").val();
    let selectedGender = $("input[name='gender']:checked").val();
    let imageFile = $("#profileImage")[0].files;

    // Validation
    if (firstName == "") {
      $("#firstNameError").text("First Name is required");
      isValid = false;
    }
    if (lastName == "") {
      $("#lastNameError").text("Last Name is required");
      isValid = false;
    }
    if (email == "") {
      $("#emailError").text("Email is required");
      isValid = false;
    } else if (!email.match(emailPattern)) {
      $("#emailError").text("Invalid email format");
      isValid = false;
    }

    if (password) {
      if (password.length < 8) {
        $("#passwordError").text("Password must be at least 8 characters");
        isValid = false;
      }
      if (confirmPassword == "") {
        $("#confirmPasswordError").text("Confirm Password is required");
        isValid = false;
      } else if (password != confirmPassword) {
        $("#confirmPasswordError").text("Passwords do not match");
        isValid = false;
      }
    } else {
      $("#passwordError").text("required!");
        isValid = false;
    }

    if (phoneNumber == "" || !$.isNumeric(phoneNumber) || phoneNumber.length != 10) {
      $("#phoneNumberError").text("Enter a valid 10-digit phone number");
      isValid = false;
    }

    if (address == "") {
      $("#addressError").text("Address is required");
      isValid = false;
    }

    if (!selectedGender) {
      $("#genderError").text("Please select a gender");
      isValid = false;
    }

    if ($(".hobby:checked").length == 0) {
      $("#hobbyError").text("Select at least one hobby");
      isValid = false;
    }

    if (countryName == "") {
      $("#countryError").text("Please select a country");
      isValid = false;
    }

    let formId = $("#myForm").attr("data-id");

    if (!formId && imageFile.length === 0) {
      $("#fileError").text("File selection is required.");
      isValid = false;
    }

    // If form is valid, submit it
    if (isValid) {
      let formData = new FormData(this);
      let formId = $("#myForm").attr("data-id");
      if (formId) {
        formData.append("id", formId); // Append user id for updating
      }

      $.ajax({
        url: "ajaxAddUser.php", // Same file used for both add and update
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          let result = JSON.parse(response);
          if (result.success) {
            // Dynamically add new user row to the table
            let rowHtml = `
            <tr id="row_${result.user.id}">
                <td>${result.user.id}</td>
                <td><img src="upload/${result.user.profileImage}" width="50" alt="Profile Image"></td>
                <td>${result.user.firstName}</td>
                <td>${result.user.lastName}</td>
                <td>${result.user.email}</td>
                <td>${result.user.phone}</td>
                <td>${result.user.gender}</td>
                <td>${result.user.hobby}</td>
                <td>${result.user.country}</td>
                <td>${result.user.address}</td>
                <td>
                  <button class="badge text-bg-primary" id="openEditUser" onclick="editUser(${result.user.id})">Edit</button>
                  <button class="badge text-bg-danger" id="deleteBtn" onclick="deleteData(${result.user.id})">Delete</button>
                </td>
            </tr>
            `;

            let formId = $("#myForm").attr("data-id");

            if (formId) {
              //update
              $("#row_" + formId).html(`
                <td>${result.user.id}</td>
                <td><img src="upload/${result.user.profileImage}" width="50" alt="Profile Image"></td>
                <td>${result.user.firstName}</td>
                <td>${result.user.lastName}</td>
                <td>${result.user.email}</td>
                <td>${result.user.phone}</td>
                <td>${result.user.gender}</td>
                <td>${result.user.hobby}</td>
                <td>${result.user.country}</td>
                <td>${result.user.address}</td>
                <td>
                  <button class="badge text-bg-primary" id="openEditUser" onclick="editUser(${result.user.id})">Edit</button>
                  <button class="badge text-bg-danger" id="deleteBtn" onclick="deleteData(${result.user.id})">Delete</button>
                </td>
                `);
              alert("User updated successfully!");
            } else {
              //add
              $("#userTable tbody").append(`
              <tr id="row_${result.user.id}">
                <td>${result.user.id}</td>
                <td><img src="upload/${result.user.profileImage}" width="50" alt="Profile Image"></td>
                <td>${result.user.firstName}</td>
                <td>${result.user.lastName}</td>
                <td>${result.user.email}</td>
                <td>${result.user.phone}</td>
                <td>${result.user.gender}</td>
                <td>${result.user.hobby}</td>
                <td>${result.user.country}</td>
                <td>${result.user.address}</td>
                <td>
                  <button class="badge text-bg-primary" id="openEditUser" onclick="editUser(${result.user.id})">Edit</button>
                  <button class="badge text-bg-danger" id="deleteBtn" onclick="deleteData(${result.user.id})">Delete</button>
                </td>
              </tr>
              `);
              alert("User added successfully!");
            }

            resetFormAndErrors();
            $("#myForm").removeAttr("data-id");
            $("#dialogForm").dialog("close");
          } else {
            alert("Error: " + result.message);
          }
        }
      });
    }
  });
});

