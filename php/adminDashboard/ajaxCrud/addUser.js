$(document).ready(function () {

  //validate first name
  $("#fnameCheck").hide();
  $("#firstName").keyup(function () {
    validateFirstName();
  })
  function validateFirstName() {
    let firstNameValue = $("#firstName").val();

    if (firstNameValue === "") {
      $("#fnameCheck").show();
    } else {
      $("#fnameCheck").hide();
    }
  }


  //validate last name
  $("#lnameCheck").hide();
  $("#lastName").keyup(function () {
    validateLastName();
  })
  function validateLastName() {
    let lastNameValue = $("#lastName").val();

    if (lastNameValue === "") {
      $("#lnameCheck").show();
    } else {
      $("#lnameCheck").hide();
    }
  }

  //validate email
  $("#lnameCheck").hide();
  $("#lastName").keyup(function () {
    validateLastName();
  })
  function validateLastName() {
    let lastNameValue = $("#lastName").val();

    if (lastNameValue === "") {
      $("#lnameCheck").show();
    } else {
      $("#lnameCheck").hide();
    }
  }

  //validate email
  const email = $("#email");
  email.on('input', function () {
    let s = email.val();
    let regex =
      /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    if (s.length === 0) {
      $("#emailCheck").text("Email is required").show();
    } else if (regex.test(s)) {
      $("#emailCheck").hide();
    } else {
      $("#emailCheck").text("Invalid email format.").show();
    }
  })

  const password = $("#password");
  password.on('input', function () {
    let s = password.val();
   
    if (s.length === 0) {
      $("#passwordCheck").text("Email is required").show();
    } else if (regex.test(s)) {
      $("#emailCheck").hide();
    } else {
      $("#emailCheck").text("Invalid email format.").show();
    }
  })


})