<?php
include_once('../includes/header.php');
include_once('../includes/sidebar.php');
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
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered" role="table">
                        <thead>
                            <tr>
                                <th style="width: 10px" scope="col">ID</th>
                                <th scope="col">product name</th>
                                <th style="width: 130px"scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr class="align-middle">
                                    <td>1</td>
                                    <td>hello</td>
                                    <td>
                                        <button class="badge text-bg-primary"><a style="color: white; padding: 2px; text-decoration: none;" href="edit.php?id=<?= $row['id'] ?>">Edit</a></button>
                                        <button class="badge text-bg-danger"><a style="color: white; padding: 2px; text-decoration: none;" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></button>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Container-->
              <button class="btn btn-primary mb-3" id="addProduct"><a style="color: white; padding: 2px; text-decoration: none;" href="addProduct.php">Add Product</a></button>
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->
<?php
include_once('../includes/footer.php');
