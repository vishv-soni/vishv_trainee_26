<?php
require 'auth.php';
include 'db.php';

$id = $_GET['id'] ?? 0;

if (isset($_POST['update'])) {
    $fname   = $_POST['first_name'];
    $lname   = $_POST['last_name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'];
    $hobby   = isset($_POST['hobby']) ? implode(",", $_POST['hobby']) : "";
    $country = $_POST['country'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        die("Invalid Phone Number format.");
    }

    $query = "UPDATE users SET 
        first_name='$fname',
        last_name='$lname',
        email='$email',
        address='$address',
        phone='$phone',
        gender='$gender',
        hobby='$hobby',
        country='$country'";

    if (!empty($pass)) {
        if ($pass !== $cpass) {
            die("Password does not match!");
        }
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $query .= ", password='$password'";
    }

    if (!empty($_FILES['profile_image']['name'])) {
        $img_name = $_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];

        // Move the new file
        if (move_uploaded_file($tmp_name, "uploads/" . $img_name)) {
            $query .= ", profile_image='$img_name'";
        } else {
            echo "Error uploading file.";
        }
    }

    $query .= " WHERE id=$id";


    $result = mysqli_query($conn, $query); 

    if ($result) {
        session_start();

        $_SESSION['userProfileImage'] = $img_name;
        header('Location: view.php');
        exit;
    }
}
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

include_once('./includes/header.php');
include_once('./includes/sidebar.php');


?>



<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Sidebar-->

        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">User Form</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User
                                    Form</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content" style="display:flex; justify-content:center; ">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row justify-content-center">

                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Quick Example-->
                            <div class="card card-primary card-outline mb-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">Quick
                                        Example</div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Form-->
                                <form method="post" id="myForm" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                                    <!--begin::Body-->
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First
                                                Name</label>
                                            <input
                                                type="text"
                                                name="first_name"
                                                value="<?php echo $data['first_name']; ?>"
                                                class="form-control" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last
                                                Name</label>
                                            <input
                                                type="text"
                                                name="last_name"
                                                value="<?php echo $data['last_name']; ?>"
                                                class="form-control"
                                                id="lastName" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email
                                                address</label>
                                            <input
                                                type="email"
                                                name="email"
                                                value="<?php echo $data['email']; ?>"
                                                class="form-control"
                                                id="exampleInputEmail1"
                                                aria-describedby="emailHelp" />
                                            <div id="emailHelp" class="form-text">
                                                We'll never share your email with anyone else.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Password</label>
                                            <input type="password" class="form-control"
                                                name="password" minlength="8" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                name="confirm_password" minlength="8" id="exampleInputPassword1" />
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="file" name="profile_image"
                                                class="form-control" id="inputGroupFile02" />
                                            <label class="input-group-text"
                                                for="inputGroupFile02">Profile Image</label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Address</span>
                                            <textarea class="form-control"
                                                aria-label="With textarea" name="address"><?php echo $data['address']; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input
                                                type="number"
                                                name="phone"
                                                value="<?php echo $data['phone']; ?>"
                                                class="form-control"
                                                required
                                                id="phone" />
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
                                                        required
                                                        <?php if ($data['gender'] == "Male") echo "checked"; ?> />
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Male </label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="gender"
                                                        id="gridRadios2"
                                                        value="Female"
                                                        required
                                                        <?php if ($data['gender'] == "Female") echo "checked"; ?> />
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Female </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input
                                                        class="form-check-input"
                                                        type="radio"
                                                        name="gender"
                                                        id="gridRadios3"
                                                        value="Other"
                                                        required
                                                        <?php if ($data['gender'] == "Other") echo "checked"; ?> />
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Other </label>
                                                </div>
                                            </div>
                                        </fieldset>

                                        hobby
                                        <?php $h = explode(",", $data['hobby']); ?>

                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Reading" <?php if (in_array("Reading", $h)) echo "checked"; ?>>
                                            <label class="form-check-label"
                                                for="exampleCheck2">Reading</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Coading" <?php if (in_array("Coading", $h)) echo "checked"; ?> />
                                            <label class="form-check-label"
                                                for="exampleCheck2">Coading</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Gaming" <?php if (in_array("Gaming", $h)) echo "checked"; ?> />
                                            <label class="form-check-label"
                                                for="exampleCheck2">Gaming</label>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom04"
                                                class="form-label">State</label>
                                            <select class="form-select" id="validationCustom04"
                                                name="country" required>
                                                <option selected disabled value>Choose...</option>
                                                <option <?php if ($data['country'] == "India") echo "selected"; ?>>India</option>
                                                <option <?php if ($data['country'] == "USA") echo "selected"; ?>>USA</option>
                                                <option <?php if ($data['country'] == "UK") echo "selected"; ?>>UK</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <!-- <button type="submit" name="submit"
                        class="btn btn-primary">Submit</button> -->
                                        <input type="submit" name="update" class="btn btn-primary" value="Update">


                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Quick Example-->



                        </div>
                        <!--end::Form Validation-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
    </div>
    <!--end::App Content-->
    </main>
    <!--end::App Main-->
    </div>
    
</body>
<?php
include_once('./includes/footer.php');
