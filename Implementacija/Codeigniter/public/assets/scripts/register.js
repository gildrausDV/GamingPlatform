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

    $("#submit").click(function() {
        let forename = $("#forename").val();
        let surname = $("#surname").val();
        let email = $("#email").val();
        let date = $("#date").val();
        let username = $("#username").val();
        let password = $("#password").val();
        let confirm = $("#confirmPassword").val();
        if (forename == "" || surname == "" || email == "" || date == "" || username == "" || password == "" || confirm == "") {
            $("#notification").css("color", "red").text("Please provide necessary information!");
            return;
        }
        
        if (password.length < 5) {
            $("#notification").css("color", "red").text("Password too short!");
            return;
        }

        if (password != confirm) {
            $("#notification").css("color", "red").text("Passwords do not match!");
            return;
        }

        $.ajax({
            method: "POST",
            url: window.location.origin + "/Home/register_",
            data: {f: forename, s: surname, e: email, d: date, u: username, p: password},
            success: function (obj, textstatus) {
                if (obj == 0) {
                    $("#notification").css("color", "red").text("Username already exists!");
                }
                else if (obj == 1) {
                    $("#notification").css("color", "green").text("Registration successful!");
                }
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText + " " + error + " " + status);
            }
          });
    });
});