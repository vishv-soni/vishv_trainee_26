$(document).ready(function () {


  $("#addVarients").click(function () {
    let variantSet = `
            <div class="variantSet" style="margin-top: 10px;">
            <input type="text" id="size" placeholder="Size">
            <input type="text" id="color" placeholder="Color">
            <input type="text" id="qty" placeholder="Qty">
            <input type="text" id="price" placeholder="Price">
            <button type="button" class="removeVariant">X</button>
            </div>
        `;
    $("#productVarientsContainer").append(variantSet);
  });

  $(document).on('click', '.removeVariant', function () {
    $(this).parent().remove();
  });

  $("#myForm").submit(function (e) {
    let isValid = true;

    if ($('#pName').val().trim() === '') {
      $("#pNameError").text('Product Name is required');
      isValid = false;
    }

    $('.variantSet').each(function () {
      $(this).find('input').each(function () {
        if ($(this).val().trim() === '') {
          $("#variantsError").text('All variant fields are required');
          isValid = false;
          return false; // Break inner loop
        }
      });
      if (!isValid) return false; // Break outer loop
    });

    if (!isValid) {
      e.preventDefault(); // Stop submission
    } else {
      alert('Form validated successfully!');
      e.preventDefault(); // Uncomment to prevent actual submission for testing
    }

  })
})