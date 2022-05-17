function login() {
    let user = document.getElementById("fname").value;
    let pass = document.getElementById("lname").value;
    if(user == "" || pass == "") {
        document.getElementById("notification").innerText = "Username or password is incorrect!";
    }
    else location.href = "play.php";
}