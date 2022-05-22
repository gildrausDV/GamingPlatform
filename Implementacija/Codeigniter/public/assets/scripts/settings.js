$(document).ready(function() {

  //HTMLImageElement.loaded($("#profilePicture"));
    //alert($("#profilePicture").attr("src"));
  /*if (("#profilePicture").attr("src") == "") {
    $("#profilePicture").attr("src", "/images/superMario.jpg");
  }*/

    $.ajax({
        method: "GET",
        url: window.location.origin + "/Home/settingsLoadData1",
        success: function (obj, textstatus) {
            obj_ = JSON.parse(obj);
            $("#pass").val(obj_['password']);
            $("#date").val(obj_['date']);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText + " " + error + " " + status);
        }
      });

      /*$.ajax({
        method: "GET",
        url: window.location.origin + "/Home/settingsLoadData2",
        success: function (obj, textstatus) {
          if (obj) {
            $("#profilePicture").attr("src", obj);
          }
          else {
            $("#profilePicture").attr("src", "/images/superMario.jpg");
          }
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText + " " + error + " " + status);
        }
      });*/
});