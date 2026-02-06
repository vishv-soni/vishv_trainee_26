<?php
session_start();
include_once('../adminLteCrud/db.php');
require '../adminLteCrud/auth.php';
include_once('../includes/header.php');
include_once('../includes/sidebar.php');
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
                            <h3 class="mb-0">Ajax New User</h3>
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
                                <form method="post" id="myForm" action="addUserLogic.php" enctype="multipart/form-data">
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
                                            <p id="fnameCheck" style="color: red;">First name is required.</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last
                                                Name</label>
                                            <input
                                                type="text"
                                                name="lastName"
                                                id="lastName"
                                                class="form-control" />
                                            <p id="lnameCheck" style="color: red;">Last name is required.</p>
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
                                            <p id="emailCheck" style="color: red;"></p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Password</label>
                                            <input type="password" class="form-control"
                                                name="password" id="password" autocomplete="off" />
                                            <p id="passwordCheck" style="color: red;">Password is required.</p>

                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                name="confirmPassword" id="confirmPassword" autocomplete="off" />
                                            <p class="confirmPasswordCheck" style="color: red;">Confirm passwords is required!</p>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="file" name="profileImage"
                                                class="form-control" id="profileImage" />
                                            <p class="profileImageCheck" style="color: red;">No file selected. The file field is required.</p>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Address</span>
                                            <textarea class="form-control"
                                                aria-label="With textarea" name="address" id="address"></textarea>
                                            <p class="addressCheck" style="color: red;">address is required.</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input
                                                type="number"
                                                name="phone"
                                                class="form-control"
                                                id="phone" />
                                            <p class="phoneCheck" style="color: red;">Phone is required</p>
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
                                            <p class="genderCheck" style="color: red;">please select at least one gender.</p>
                                        </fieldset>

                                        hobby
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Reading">
                                            <label class="form-check-label"
                                                for="exampleCheck1">Reading</label>
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
                                                for="exampleCheck3">Gaming</label>
                                        </div>
                                        <p class="hobbyCheck" style="color: red;">please select at least one hobby.</p>

                                        <div class="col-md-6">
                                            <label for="validationCustom04"
                                                class="form-label">State</label>
                                            <select class="form-select" id="country"
                                                name="country">
                                                <option disabled selected value>Choose...</option>
                                                <option>India</option>
                                                <option>USA</option>
                                                <option>UK</option>
                                            </select>
                                        </div>
                                        <p class="countryCheck" style="color: red;">please select at least one country.</p>

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
    </div>
    <script src="addUser.js"></script>
</body>
<?php
include_once('../includes/footer.php');
