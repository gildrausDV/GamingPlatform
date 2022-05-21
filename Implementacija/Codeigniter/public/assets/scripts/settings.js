$(document).ready(function() {
    $.ajax({
        method: "GET",
        url: window.location.origin + "/Home/settingsLoadData",
        success: function (obj, textstatus) {
          alert(obj);

        },
        error: function(xhr, status, error) {
            alert(xhr.responseText + " " + error + " " + status);
        }
      });
});