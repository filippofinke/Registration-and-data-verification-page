$(document).ready(function() {
  $("#preloader").css("display", "none");
  $("#mainPage").css("display", "block");
  $("#correctButton").click(submitHiddenForm);
});



function submitHiddenForm()
{
  document.getElementById('hiddenForm').submit();
}
