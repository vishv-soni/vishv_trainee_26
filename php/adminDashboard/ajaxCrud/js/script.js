
// $("#insertForm").submit(function (e) {
//   e.preventDefault();


//   function deleteData(id) {
//     if (confirm("Are you sure?")) {
//       $.ajax({
//         type: "POST",
//         url: "/PHP-Trainee/AdminLTE/ajaxCrud/delete.php",
//         data: { id: id },
//         success: function (response) {
//           console.log(id);
//           if (response == "success") {
//             alert("Data Deleted Successfully");
//             $('#row_' + id).remove();
//             // location.reload();
//           } else {
//             alert("Delete Failed");
//           }
//         }
//       });
//     }
//   }



$(document).ready(function () {

  function resetFormAndErrors() {
    $("#myForm")[0].reset();
    $(".error").text(""); // Clear all elements with the class 'error'
    // If you have specific visual error classes (e.g., 'input-error'), clear those as well
    // e.g., $(".input-error").removeClass("input-error"); 
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

  // Open popup
  $("#openAddUser").on("click", function () {
    resetFormAndErrors();
    $("#dialogForm").dialog("open");
  });

  // Submit form via AJAX
  $("#myForm").on("submit", function (e) {
    e.preventDefault();
    $(".error").text("");

    let isValid = true;
    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let email = $("#email").val();
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    let password = $("#password").val();
    let strongPasswordRegex =
      /^(?!.*\s)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-+={}[\]|\\:;"'<>,.?/_₹]).{8,16}$/;
    let confirmPassword = $("#confirmPassword").val();
    let address = $("#address").val();
    let phoneNumber = $("#phone").val();
    let photo = $("#profileImage")[0];
    let countryName = $("#country").val();
    let selectedGender = $("input[name='gender']:checked").val();
    console.log(countryName);

    console.log("form");
    if (firstName == "") {
      $("#firstNameError").text("First Name contain at least 3 character");
      isValid = false;
    }
    if (lastName == "") {
      $("#lastNameError").text("Last Name contain at least 3 character");
      isValid = false;
    }
    if (email == "") {
      $("#emailError").text("Email is required");
      isValid = false;
    } else if (!email.match(emailPattern)) {
      $("#emailError").text("Email is specefic format");
      isValid = false;
    }

    if (password == "") {
      $("#passwordError").text("Insert password");
      isValid = false;
    } else if (!password.match(strongPasswordRegex)) {
      $("#passwordError").text(
        "Your password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character",
      );
      isValid = false;
    }
    if (confirmPassword == "") {
      $("#confirmPasswordError").text("Insert confirm password");
      isValid = false;
    } else if (password != confirmPassword) {
      $("#confirmPasswordError").text("confirm passsword same as password");
      isValid = false;
    }
    if (photo.files.length == 0) {
      $("#fileError").text("Upload image");
      isValid = false;
    }
    if (address == "") {
      $("#addressError").text("Etner address");
      isValid = false;
    }
    if (
      phoneNumber == "" ||
      !$.isNumeric(phoneNumber) ||
      phoneNumber.length != 10
    ) {
      $("#phoneNumberError").text("Enter valid 10 digit number");
      isValid = false;
    }
    if (!$("input[name='gender']:checked").val()) {
      $("#genderError").text("Select gender");
      isValid = false;
    }
    if ($(".hobby:checked").length == 0) {
      $("#hobbyError").text("Select at least one hobby");
      isValid = false;
    }
    if (countryName == "") {
      console.log("country");
      $("#countryError").text("Select country");
      isValid = false;
    }

    if (isValid) {
      let formData = new FormData(this);
      $.ajax({
        url: "ajaxAddUser.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          $("#message").html(response);
          $("#myForm")[0].reset();

          setTimeout(function () {
            location.reload(); // reload   table only
          }, 1000);
        },
      });
      //   $("#userTable tbody").append("<tr>" +
      //     "<td>" + photo + "</td>" +
      //     "<td>" + firstName + "</td>" +
      //     "<td>" + lastName + "</td>" +
      //     "<td>" + email + "</td>" +
      //     "<td>" + phoneNumber + "</td>" +
      //     "<td>" + selectedGender + "</td>" +
      //     "<td>" + selectedHobby + "</td>" +
      //     "<td>" + countryName + "</td>" +


      //     "</tr>"); 
      //   dialog.dialog("close");
      // }
      // return isValid;
    }

    // let formData = new FormData(this);

    //     $.ajax({
    //       url: "ajaxAddUser.php",
    //       type: "POST",
    //       data: formData,
    //       contentType: false,
    //       processData: false,
    //       success: function (response) {
    //         $("#message").html(response);
    //         $("#myForm")[0].reset();

    //         setTimeout(function () {
    //           location.reload(); // reload table only
    //         }, 1000);
    //       }
    //     });
  });

});
