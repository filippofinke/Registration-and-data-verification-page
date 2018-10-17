$(document).ready(function() {
  $("#preloader").css("display", "none");
  $("#mainPage").css("display", "block");
  $("#correctButton").click(submitHiddenForm);
  $("#submitButton").click(submitForm);
});


function submitForm()
{
  document.getElementById('form').submit();
}

function submitHiddenForm()
{
  document.getElementById('hiddenForm').submit();
}
