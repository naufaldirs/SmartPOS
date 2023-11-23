function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
  }
function konfirmasi() {
    confirm("Apakah anda yakin??");
}

var rowCount = 1; // Variable to track the row count

// Function to add new row to the table
function addRow() {
  event.preventDefault();
  // Get selected sparepart data from the dropdown
  var selectedSparepart = $("#spareparts option:selected");
  var kdSparepart = selectedSparepart.val();
  var namaSparepart = selectedSparepart.text().split(" - ")[0];
  var hargaSparepart = selectedSparepart.data("harga");

  // Create a new row with the extracted data and set kd_sparepart as a data attribute
  var newRow = '<tr data-kd-sparepart="' + kdSparepart + '">' +
      '<input type="hidden" name="kd_sparepart[]" value="' + kdSparepart + '">' +
      '<th scope="row">' + rowCount++ + '</th>' + // Increment the row count
      '<td id="namaSparepart">' + namaSparepart + '</td>' +
      '<td id="hargaSparepart">' + hargaSparepart + '</td>' +
      '<td><input type="text" name="qty[]" class="qty-input"></td>' +
      '<td><input type="number" name="subtotal[]" readonly class="subtotal-input"> </td>' +
      '<td><a href="#" class="btn btn-danger btn-lg active delete-row" role="button" aria-pressed="true"><i class="fa fa-minus-square" style="color:red"></i></a></td>' +
      '</tr>';

  // Append the new row to the table
  $('#barangTable tbody').append(newRow);
}
// Function to calculate subtotal and update the row
function calculateSubtotal() {
    var qty = parseInt($(this).val());
    var harga = parseInt($('#hargaSparepart').text());
    var subtotal = isNaN(qty) ? 0 : qty * harga;
    $(this).closest('tr').find('.subtotal-input').val(subtotal);
    calculateTotal();
}

  // Function to calculate total


// Function to calculate change (kembali)
function calculateChange() {
    var total = parseInt($('[name="total"]').val()) || 0;
    var bayar = parseInt($('[name="bayar"]').val()) || 0;
    var kembali = bayar - total;

    // Set the calculated change (kembali) in the kembali input field
    $('[name="kembali"]').val(kembali);
}

function calculateTotal() {
  var total = 0;

  // Loop through each row and sum up the subtotal values
  $('.subtotal-input').each(function () {
      total += parseInt($(this).val()) || 0;
  });

  // Set the calculated total in the total input field
  $('[name="total"]').val(total);

  // Trigger the change calculation whenever total changes
  calculateChange();
}

// Attach event handlers
$(document).on('input', '.qty-input', calculateSubtotal);
$(document).on('input', '[name="bayar"]', calculateChange);
// Function to delete row
$(document).on('click', '.delete-row', function () {
    $(this).closest('tr').remove();
    rowCount--; // Decrement the row count
});