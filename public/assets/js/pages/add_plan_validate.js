$(function() {
  var validator = $(".form-horizontal").validate({
    errorClass: 'validation-error-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    rules: {
      planName: {
        required: true,
        minlength: 2,
        maxlength: 30
      },
      planPrice: {
        required: true,
        digits: true
      },
      planDes: {
        maxlength: 1000
      }
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element.parent());
    },
    messages: {
      planName: {
        required: "Tên gói cước không được trống.",
        minlength: "Độ dài tối thiểu là 2.",
        maxlength: "Độ dài tối đa là 30."
      },
      planPrice: {
        required: "Cước phí không được trống",
        digits: "Cước phí phải là ký tự số."
      },
      planDes: {
        maxlength: "Độ dài tối đa là 1000."
      }
    }
  });

  // Reset form
  $('#reset').on('click', function() {
      validator.resetForm();
  });

  // Confirmation dialog
  $('.confirm').on('click', function() {
      $tr = $(this).closest('tr');
      bootbox.confirm("Bạn có chắc chắn muốn xoá gói cước này không?", function(result) {
        if (result == true) {
          $.get('/delete-plan', {"planID": $tr.children().first('td').text()})
          $tr.remove();
        }
      });
  });
});