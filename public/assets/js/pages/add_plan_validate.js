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

  $('a[data-target=#edit_plan]').click(function(ev) {
    $tr = $(this).closest('tr');
    var planID = $tr.children().first('td').text();
    $.getJSON('/get-plan-data-id', {"planID": planID}, function (data) {
      $("#edit_plan input[name=planName]").val(data[0]);
      $("#edit_plan input[name=planPrice]").val(data[1]);
      $("#edit_plan input[name=planDes]").val(data[2]);
    });
    var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "planID").val(planID);
    $('#edit_plan form').append($(input));
  });

  $('#edit_plan form').submit(function(ev) {
    ev.preventDefault();
    var planData = {
      "planID" : $("#edit_plan input[name=planID]").val(),
      "planName" : $("#edit_plan input[name=planName]").val(),
      "planPrice" : $("#edit_plan input[name=planPrice]").val(),
      "planDes": $("#edit_plan input[name=planDes]").val(),
    }
    $.post('update-plan', {"planData": planData}, function(response) {
      $("#edit_plan button[class=close]").trigger("click");
      $tr = $("table tbody tr td").filter(function() {return $(this).text() === planData["planID"]}).parent();
      $tr.children().eq(0).text(planData["planID"]);
      $tr.children().eq(1).text(planData["planName"]);
      $tr.children().eq(2).children().first().text(planData["planPrice"] + " VND");
      $tr.children().eq(3).text(planData["planDes"]);
    })

  });
});