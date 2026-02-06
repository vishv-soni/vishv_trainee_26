<?php
include_once('db.php');
require 'auth.php';
include_once('../includes/header.php');
include_once('../includes/sidebar.php');

$flash = $_SESSION['flash'] ?? [];
$old = $flash['editOld'] ?? [];
$generalErrors = $flash['editGeneralError'] ?? [];
$errors = $flash['editErrors'] ?? [];
$oldHobby = (isset($old['hobby']) && is_array($old['hobby'])) ? $old['hobby'] : [];
echo  $_SESSION["hobbies"];
$oldGender = $old['gender'] ?? [];
$oldCountry = $old['country'] ?? [];
unset($_SESSION['flash']);

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
                                                  <?php if (!empty($generalErrors['firstName'])) { ?>
                                                <p style="color:red"><?= $generalErrors['firstName']; ?></p>
                                            <?php }; ?>
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
                                                <?php if (!empty($generalErrors['lastName'])) { ?>
                                                <p style="color:red"><?= $generalErrors['lastName']; ?></p>
                                            <?php }; ?>
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
                                            <?php if (!empty($generalErrors['email'])) { ?>
                                                <p style="color:red"><?= $generalErrors['email']; ?></p>
                                            <?php }; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1"
                                                class="form-label">Password</label>
                                            <input type="password" class="form-control"
                                                name="password" autocomplete="off" value="<?php echo $old['password']?>" />
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
                                                    echo "<p style='color:red'>{$errors['confirmPassword']}</p>";
                                            }
                                            ?>
                                        </div>

                                        <div class="input-group mb-3">

                                            <input type="file" name="profile_image"
                                                class="form-control" id="inputGroupFile02" />
                                            <label class="input-group-text"
                                                for="inputGroupFile02"> <img src="uploads/<?php echo $old['address'] ?? $data['profile_image']; ?>" width="50" height="50" class="rounded-circle"></label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Address</span>
                                            <textarea class="form-control"
                                                aria-label="With textarea" name="address"><?php echo $old['address'] ?? $data['address']; ?></textarea>
                                                <?php if (!empty($generalErrors['address'])){ ?>
                                                <p style="color:red"><?= $generalErrors['address']; ?></p>
                                            <?php }; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input
                                                type="number"
                                                name="phone"
                                                value="<?php echo $old['phone'] ?? $data['phone']; ?>"
                                                class="form-control"
                                                id="phone" />
                                            <?php if (!empty($generalErrors['phone'])){ ?>
                                                <p style="color:red"><?= $generalErrors['phone']; ?></p>
                                            <?php }; ?>
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
                                                        <?php if ($data['gender'] == "Male" || $oldGender == "Male") echo "checked"; ?> />
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
                                                        <?php if ($data['gender'] == "Female" || $oldGender == "Female") echo "checked"; ?> />
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
                                                        <?php if ($data['gender'] == "Other" || $oldGender == "Other") echo "checked"; ?> />
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Other </label>
                                                </div>
                                            </div>
                                            <?php if (!empty($generalErrors['gender'])) { ?>
                                                <p style="color:red"><?= $generalErrors['gender']; ?></p>
                                            <?php }; ?>
                                        </fieldset>

                                        hobby
                                        <?php
                                        if(isset( $_SESSION["hobbies"])){
                                            $h=[];
                                            unset($_SESSION["hobbies"]);
                                        }
                                        else if(isset($old["hobby"]) && $old["hobby"]){
                                            $h=$old["hobby"];
                                        }else{

                                            $h = explode(",", $data['hobby']);
                                        }
                                          ?>
                                        <!-- $h = explode(",", $data['hobby']); 
                                        if(!empty($oldHobby) && count($oldHobby) > 0){
                                            $finalHobby = $oldHobby;
                                        }
                                        elseif(!empty($h) && count($h) > 0){
                                            echo "elsif";
                                            echo "ghljkgl";
                                            $finalHobby = $h;
                                        }else{
                                            $finalHobby = [];
                                        } -->
                                        
                                        <div class="mb-3 form-check">
                                            <input <?php if ($data['country'] == "India") ?> type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Reading" <?php echo (in_array("Reading", $h )) ? "checked" : '' ; ?> />
                                            <label class="form-check-label"
                                                for="exampleCheck2">Reading</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Coading" <?php echo (in_array("Coading", $h )) ? "checked" : '' ; ?> />
                                            <label class="form-check-label"
                                                for="exampleCheck2">Coading</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input"
                                                name="hobby[]" value="Gaming" <?php echo (in_array("Gaming", $h )) ? "checked" : '' ; ?> />
                                            <label class="form-check-label"
                                                for="exampleCheck2">Gaming</label>
                                        </div>
                                        <?php if (!empty($generalErrors['hobby'])) { ?>
                                            <p style="color:red"><?= $generalErrors['hobby']; ?></p>
                                        <?php }; ?>

                                        <div class="col-md-6">
                                            <label for="validationCustom04"
                                                class="form-label">State</label>
                                            <select class="form-select" id="validationCustom04"
                                                name="country">
                                                <option value="">Choose...</option>
                                                <option value="India" <?php if (($data['country'] == "India") || ($oldCountry == "India")) echo "selected"; ?>>India</option>
                                                <option value="USA" <?php if (($data['country'] == "USA") || ($oldCountry == "USA")) echo "selected"; ?>>USA</option>
                                                <option value="UK" <?php if (($data['country'] == "UK") || ($oldCountry == "UK")) echo "selected"; ?>>UK</option>
                                            </select>
                                            <?php if (!empty($generalErrors['country'])) { ?>
                                            <p style="color:red"><?= $generalErrors['country']; ?></p>
                                        <?php }; ?>
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
