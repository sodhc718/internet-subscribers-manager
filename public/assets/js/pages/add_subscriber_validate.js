$(function() {
  $("#passportIssueDate").AnyTime_picker({
    format: "%Z-%m-%d"
  });
  $("#registerDate").AnyTime_picker({
    format: "%Z-%m-%d"
  });
  // Plan select
  $('.bootstrap-select').selectpicker();

  var validator = $(".form-horizontal").validate({
    errorClass: 'validation-error-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    rules: {
      contractCode: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      fullName: {
        required: true,
        maxlength: 30
      },
      address: {
        required: true,
        maxlength: 80
      },
      email: {
        required: true,
        email: true
      },
      passport: {
        required: true,
        number: true,
        maxlength: 15
      },
      passportIssueAddress: {
        maxlength: 80
      },
      phoneNumber: {
        required: true,
        number: true
      },
      username: {
        required: true,
        minlength: 6,
        maxlength: 40
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 50
      },
      repeatPassword: {
        required: true,
        equalTo: "#password"
      }
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element.parent());
    },
    messages: {
      contractCode: {
        required: "Số hợp đồng không được trống.",
        minlength: "Độ dài tối thiểu là 6.",
        maxlength: "Độ dài tối đa là 15."
      },
      fullName: {
        required: "Họ tên không được trống.",
        maxlength: "Độ dài tối đa là 30."
      },
      address: {
        required: "Địa chỉ không được trống.",
        maxlength: "Độ dài tối đa là 80."
      },
      passport: {
        required: "Số CMND không được trống.",
        maxlength: "Độ dài tối đa là 15."
      },
      passportIssueAddress: {
        maxlength: "Độ dài tối đa là 80."
      },
      email: {
        required: "Email không được trống.",
        email: "Email không đúng định dạng."
      },
      phoneNumber: {
        required: "Số điện thoại không được trống.",
        digits: "Số điện thoạikhông đúng định dạng."
      },
      username: {
        required: "Username không được trống.",
        minlength: "Độ dài tối thiểu là 6.",
        maxlength: "Độ dài tối đa là 40."
      },
      password: {
        required: "Password không được trống.",
        minlength: "Độ dài tối thiểu là 6.",
        maxlength: "Độ dài tối đa là 50."
      },
      repeatPassword: {
        required: "Password nhập lại không được trống.",
        equalTo: "Password nhập lại không trùng."
      }
    }
  });

  // Reset form
  $('#reset').on('click', function() {
      validator.resetForm();
  });
});