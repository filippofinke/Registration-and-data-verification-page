var validator = new Validator();

$(document).ready(function(){
  $('#birthdate').datepicker({
    yearRange: 30
  });
  addCharCounter($('#name'),50);
  addCharCounter($('#lastname'),50);
  addCharCounter($('#street'),50);
  addCharCounter($('#civicnumber'),4);
  addCharCounter($('#nap'),5);
  addCharCounter($('#city'),50);
  addCharCounter($('#hobby'),500);
  addCharCounter($('#occupation'),500);

  $('#submitButton').click(submitCheck);
  $('#name').keydown(validateGeneral).keyup(validateGeneral);
  $('#lastname').keydown(validateGeneral).keyup(validateGeneral);
  $('#street').keydown(validateGeneral).keyup(validateGeneral);
  $('#city').keydown(validateGeneral).keyup(validateGeneral);
  $('#civicnumber').keydown(validateCivicNumber).keyup(validateCivicNumber);
  $('#nap').keydown(validateNap).keyup(validateNap);
  $('#telephone').keydown(validatePhone).keyup(validatePhone);
  $('#email').keydown(validateEmail).keyup(validateEmail);
  $('#hobby').keydown(validateTextArea).keyup(validateTextArea);
  $('#occupation').keydown(validateTextArea).keyup(validateTextArea);
});

function submitCheck()
{
  alert("A");
}

function changeColor(value, event)
{
  if(value)
  {
    event.target.style.color = "black";
  }
  else
  {
    event.target.style.color = "red";
  }
}

function validateTextArea(event)
{
  changeColor(validator.textArea(event.target.value), event);
}

function validateEmail(event)
{
  changeColor(validator.email(event.target.value), event);
}

function validatePhone(event)
{
  changeColor(validator.telephone(event.target.value), event);
}

function validateNap(event)
{
  changeColor(validator.nap(event.target.value), event);
}

function validateCivicNumber(event)
{
  event.target.value = event.target.value.toUpperCase();
  changeColor(validator.street(event.target.value), event);
}

function validateGeneral(event)
{
  changeColor(validator.general(event.target.value), event);
}

function addCharCounter(element,limit)
{
  element.keydown(function() {
    charCounter(element,limit);
  });
  element.keyup(function() {
    charCounter(element,limit);
  });
}

function charCounter(element, limit)
{
  var textLength = element.val().length;
  var counter = element.parent().children('span');
  if(textLength > limit)
  {
    counter.css("color","red");
  }
  else {
    counter.css("color","black");
  }
  counter.html(textLength + "/" + limit);
}
