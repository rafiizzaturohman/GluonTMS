$("#password, #retype-password").on("keyup", function () {
  if ($("#password").val() == $("#retype-password").val()) {
    $("#message")
      .html("The password you entered is correct")
      .css("color", "green");
  } else $("#message").html("The password you entered does not match").css("color", "red");
});
