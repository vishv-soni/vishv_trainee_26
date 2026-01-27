<?php
include_once('db.php');
require 'auth.php';
include_once('../includes/header.php');
include_once('../includes/sidebar.php');

$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);

$id = $_GET['id'] ?? 0;
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));
?>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Edit User</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit
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

                                <!--end::Header-->
                                <!--begin::Form-->
                                <form method="post" id="myForm" action="editLogic.php?id=<?php echo intval($id); ?>" enctype="multipart/form-data">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First
                                                Name</label>
                                            <input
                                                type="text"
                                                name="first_name"
                                                value="<?php echo $old['first_name'] ?? $data['first_name']; ?>"
                                                class="form-control" />

                                        </div>

                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last
                                                Name</label>
                                            <input
                                                type="text"
                                                name="last_name"
                                                value="<?php echo $old['last_name'] ?? $data['last_name']; ?>"
                                                class="form-control"
                                                id="lastName" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email
                                                address</label>
                                            <input
                                                type="email"
                                                name="email"
                                                value="<?php echo $old['email'] ?? $data['email']; ?>"
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
                                                name="password" minlength="8" autocomplete="off" />
                                            <p style='color: red;'><?php echo $_SESSION['password_errors'] ?? ''; ?></p>
                                            <?php unset($_SESSION['password_errors']); ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                name="confirm_password" minlength="8" id="exampleInputPassword1" autocomplete="off" />
                                            <p style='color: red;'><?php echo $_SESSION['confirm_password_error'] ?? ''; ?></p>
                                            <?php unset($_SESSION['confirm_password_error']); ?>
                                        </div>

                                        <div class="input-group mb-3">

                                            <input type="file" name="profile_image"
                                                class="form-control" id="inputGroupFile02" />
                                            <label class="input-group-text"
                                                for="inputGroupFile02"> <img src="uploads/<?php echo $data['profile_image']; ?>" width="50" height="50" class="rounded-circle"></label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Address</span>
                                            <textarea class="form-control"
                                                aria-label="With textarea" name="address"><?php echo $old['address'] ?? $data['address']; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input
                                                type="number"
                                                name="phone"
                                                value="<?php echo $old['phone'] ?? $data['phone']; ?>"
                                                class="form-control"
                                                id="phone" />
                                            <p style='color: red;'><?php echo $_SESSION['general_errors'] ?? ''; ?></p>
                                            <?php unset($_SESSION['general_errors']); ?>
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
                                                name="country">
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
include_once('../includes/footer.php');
