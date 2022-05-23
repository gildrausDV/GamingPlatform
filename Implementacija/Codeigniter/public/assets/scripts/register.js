$(document).ready(function() {
    let hidden1 = true;
    let hidden2 = true;

    $("#togglePassword1").click(function() {
        if (hidden1 == true) {
            $(this).attr("src", "/images/eye.png");
            $("#password").attr("type", "text");
        }
        else {
            $(this).attr("src", "/images/eye_.png");
            $("#password").attr("type", "password");
        }
        hidden1 = !hidden1;
    });

    $("#togglePassword2").click(function() {
        if (hidden2 == true) {
            $(this).attr("src", "/images/eye.png");
            $("#confirmPassword").attr("type", "text");
        }
        else {
            $(this).attr("src", "/images/eye_.png");
            $("#confirmPassword").attr("type", "password");
        }
        hidden2 = !hidden2;
    });
});