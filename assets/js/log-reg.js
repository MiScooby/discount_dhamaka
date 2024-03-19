$(document).ready(function() {
    $(document).on("click", ".loginwithme", function() {
        var lgnwithme = $(this).attr("data-id");
        $(".mylogfrm").removeClass("active");
        $(lgnwithme).addClass("active");
    });

    $(document).on("click", ".vendorlgn", function() {
        $(".customerdiv").hide();
        $(".cghref").attr("href", "business.php");
        $(".signinas").text("Register as Vendor");
    });

    $(document).on("click", ".vendor_loginForm", function(){  
        $("#vendor_loginForm").hide();
        $("#vendor_loginForm_user").show();
    });

    $(document).on("click", ".vendor_loginForm_user", function(){  
        $("#vendor_loginForm_user").hide();
        $("#vendor_loginForm").show();
    });

    $(document).on("click", ".toggle-password", function() {
        if ($(".pass1").find("input").attr("type") == "password") {
            $(".pass1").find("input").attr("type", "text");
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(".pass1").find("input").attr("type", "password");
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });

    $(document).on("click", ".toggle-password1", function() {
        if ($(".pass2").find("input").attr("type") == "password") {
            $(".pass2").find("input").attr("type", "text");
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(".pass2").find("input").attr("type", "password");
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });

    // vendor show password
    $(document).on("click", ".toggle-password2", function() {
        if ($(".pass3").find("input").attr("type") == "password") {
            $(".pass3").find("input").attr("type", "text");
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(".pass3").find("input").attr("type", "password");
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });
});