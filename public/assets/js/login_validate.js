$(function() {
  $(".form-validate").validate({
    errorClass: 'validation-error-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    rules: {
      username: {
        required: true
      },
      password: {
        required: true
      }
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});