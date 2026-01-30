<?php
include_once '../adminLteCrud/auth.php';
include_once '../includes/header.php';
include_once '../includes/sidebar.php';
include './classes/Register.php';
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$register = new Register();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register = $register->addRegister($_POST, $_FILES);
}
?>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">New User</h3>
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
                            <div class="card-title">Add
                                User</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form method="post" id="myForm" enctype="multipart/form-data">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First
                                        Name</label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        class="form-control" required />
                                </div>

                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last
                                        Name</label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        class="form-control"
                                        id="lastName" required />
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email
                                        address</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp" required />
                                    <div id="emailHelp" class="form-text">
                                        We'll never share your email with anyone else.
                                    </div>
                                    <?php
                                    if (!empty($errors['general']) && in_array("Email already exists.", $errors['general'])) {
                                        foreach ($errors['general'] as $err) {
                                            if ($err === "Email already exists.") {
                                                echo "<p style='color:red'>$err</p>";
                                            }
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1"
                                        class="form-label">Password</label>
                                    <input type="password" class="form-control"
                                        name="password" minlength="8" autocomplete="off" required />
                                    <?php
                                    if (!empty($errors['password'])) {
                                        foreach ($errors['password'] as $err) {
                                            echo "<p style='color:red'>$err</p>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1"
                                        class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control"
                                        name="confirm_password" minlength="8" id="exampleInputPassword1" autocomplete="off" />
                                    <?php
                                    if (!empty($errors['confirmPassword'])) {
                                        foreach ($errors['confirmPassword'] as $err) {
                                            echo "<p style='color:red'>$err</p>";
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="input-group mb-3">

                                    <input type="file" name="profile_image"
                                        class="form-control" id="inputGroupFile02" required />
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text">Address</span>
                                    <textarea class="form-control"
                                        aria-label="With textarea" name="address" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input
                                        type="number"
                                        name="phone"
                                        class="form-control"
                                        minlength="10"
                                        id="phone" required />
                                    <?php
                                    if (!empty($errors['general']) && in_array("Invalid Phone Number format.", $errors['general'])) {
                                        foreach ($errors['general'] as $err) {
                                            if ($err === "Invalid Phone Number format.") {
                                                echo "<p style='color:red'>$err</p>";
                                            }
                                        }
                                    }

                                    ?>
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
                                                value="Male" required />
                                            <label class="form-check-label" for="gridRadios1">
                                                Male </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="gender"
                                                id="gridRadios2"
                                                value="Female" required />
                                            <label class="form-check-label" for="gridRadios2">
                                                Female </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="gender"
                                                id="gridRadios3"
                                                value="Other" required />
                                            <label class="form-check-label" for="gridRadios3">
                                                Other </label>
                                        </div>
                                    </div>
                                </fieldset>

                                hobby
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input"
                                        name="hobby[]" value="Reading">
                                    <label class="form-check-label"
                                        for="exampleCheck2">Reading</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input"
                                        name="hobby[]" value="Coading" />
                                    <label class="form-check-label"
                                        for="exampleCheck2">Coading</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input"
                                        name="hobby[]" value="Gaming" />
                                    <label class="form-check-label"
                                        for="exampleCheck2">Gaming</label>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom04"
                                        class="form-label">State</label>
                                    <select class="form-select" id="validationCustom04"
                                        name="country" required>
                                        <option selected disabled value>Choose...</option>
                                        <option>India</option>
                                        <option>USA</option>
                                        <option>UK</option>
                                    </select>
                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <input type="submit" name="submit" class="btn btn-primary" value="Add User" />
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
<?php
include_once '../includes/footer.php';







?>