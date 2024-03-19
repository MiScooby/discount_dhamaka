function srbSweetAlret(msg, swicon) {
  msg = msg;
  swicon = swicon;
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: swicon,
    title: msg
  })
}

function IsEmail(email) {
  var regex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!regex.test(email)) {
    return false;
  } else {
    return true;
  }
}

$("#emailAddress").blur(function () {
  var emailAddress = $("#emailAddress").val();
  if (IsEmail(emailAddress) == false) {
    swicon = "warning";
    msg = " Enter an valid email address";
    srbSweetAlret(msg, swicon);
  }
});

$("#email_Password").blur(function () {});
$("#email_Password").on("focus keyup", function () {
  var score = 0;
  var pass = $(this).val();
  var result = "";
  $("#pwd_strength_wrap").fadeIn(400);
  // password length
  if (pass.length >= 8) {
    $("#length").removeClass("invalid").addClass("valid");
    $("#length i").removeClass("fa-times").addClass("fa-check green");
    score++;
    result = 1;
  } else {
    $("#length").removeClass("valid").addClass("invalid");
    $("#length i").removeClass("fa-check green").addClass("fa-times");
  }

  // at least 1 digit in password
  if (pass.match(/\d/)) {
    $("#pnum").removeClass("invalid").addClass("valid");
    $("#pnum i").removeClass("fa-times").addClass("fa-check green");
    score++;
    result = 1;
  } else {
    $("#pnum").removeClass("valid").addClass("invalid");
    $("#pnum i").removeClass("fa-check green").addClass("fa-times");
  }

  // at least 1 capital & lower letter in password
  if (pass.match(/[A-Z]/) && pass.match(/[a-z]/)) {
    $("#capital").removeClass("invalid").addClass("valid");
    $("#capital i").removeClass("fa-times").addClass("fa-check green");
    score++;
    result = 1;
  } else {
    $("#capital").removeClass("valid").addClass("invalid");
    $("#capital i").removeClass("fa-check green").addClass("fa-times");
  }

  // at least 1 special character in password {
  if (pass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
    $("#spchar").removeClass("invalid").addClass("valid");
    $("#spchar i").removeClass("fa-times").addClass("fa-check green");
    score++;
    result = 1;
  } else {
    $("#spchar").removeClass("valid").addClass("invalid");
    $("#spchar i").removeClass("fa-check green").addClass("fa-times");
  }

});

$("#email_Password").blur(function () {
  $("#pwd_strength_wrap").fadeOut();
});


