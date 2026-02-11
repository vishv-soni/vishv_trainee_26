<?php
include_once('../includes/header.php');
include_once('../includes/sidebar.php');
include_once('viewLogic.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div>
  <form id="myForm">
    <div id="pFields">
    <input type="text" id="pName" placeholder="Product Name">
    <span class="error" id="pNameError"></span>
    <!-- <button type="button">Edit</button>
        <button type="button">Delete</button> -->
    </div>
    <button type="button" id="addVarients">Add varients</button>
    <div id="productVarientsContainer"></div>
     <span class="error" id="variantsError"></span>

    <button type="submit" id="saveProduct" style="margin-top: 10px;">Save Product</button>
  </form>
</div>


<script src="script.js"></script>
</body>
</html>


<?php
include_once('../includes/footer.php');