<?php
require 'auth.php';
include_once('viewLogic.php');
?>
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- <a href="logout.php">Logout</a> -->
            <div class="card mb-4">
                <div class="card-header">
                    <!-- <h3 class="card-title" >User List</h3> -->
                    <form method="get" action="viewLogic.php">
                        <div class="input-group">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Search by name, email, country..."
                                value="<?= htmlspecialchars($search) ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                            <?php if ($search != '') { ?>
                                <a href="view.php" class="btn btn-secondary">Reset</a>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered" role="table">
                        <thead>
                            <tr>
                                <th style="width: 10px" scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Hobby</th>
                                <th scope="col">Country</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $userImage = (!empty($row['profile_image'])) ?
                                    "uploads/" . $row['profile_image'] :
                                    "assets/download.jpeg";
                            ?>
                                <tr class="align-middle">
                                    <td><?= $row['id'] ?></td>
                                    <td><img src="<?= $userImage ?>" width="50"></td>
                                    <td><?= $row['first_name'] ?></td>
                                    <td><?= $row['last_name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['hobby'] ?></td>
                                    <td><?= $row['country'] ?></td>
                                    <td>
                                        <button class="badge text-bg-primary"><a style="color: white; padding: 2px; text-decoration: none;" href="edit.php?id=<?= $row['id'] ?>">Edit</a></button>
                                        <button class="badge text-bg-danger"><a style="color: white; padding: 2px; text-decoration: none;" href="delete.php?id=<?= $row['id'] ?>">Delete</a></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<?php
include_once('./includes/footer.php');
