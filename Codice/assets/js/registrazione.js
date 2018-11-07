/**
* @author Filippo Finke
* @version 07.11.2018
*/
var validator = new Validator();
var datepicker;
$(document).ready(function() {
  $("#preloader").css("display", "none");
  $("#mainPage").css("display", "block");


  $('#birthdate').datepicker({
    yearRange: 30,
    format: "yyyy-mm-dd"
  });
  datepicker = M.Datepicker.getInstance($('#birthdate'));

  addCharCounter($('#name'), 50);
  addCharCounter($('#lastname'), 50);
  addCharCounter($('#street'), 50);
  addCharCounter($('#civicnumber'), 4);
  addCharCounter($('#nap'), 5);
  addCharCounter($('#city'), 50);
  addCharCounter($('#hobby'), 500);
  addCharCounter($('#occupation'), 500);
  $("#birthdate").focus(function() {
    datepicker.open();
  });

  document.onkeydown = function(event){
	  if(event.code == "Enter")
	  {
		  event.preventDefault();
		  $('#submitButton').click();
	  }
  };

  
  $('#submitButton').click(submitCheck);
  $('#resetButton').click(resetForm);

  $('#name').keydown(validateGeneral).keyup(validateGeneral).change(validateGeneral);
  loadCheck('#name',validateGeneral);
  $('#lastname').keydown(validateGeneral).keyup(validateGeneral).change(validateGeneral);
  loadCheck('#lastname',validateGeneral);
  $('#street').keydown(validateGeneral).keyup(validateGeneral).change(validateGeneral);
  loadCheck('#street',validateGeneral);
  $('#city').keydown(validateGeneral).keyup(validateGeneral).change(validateGeneral);
  loadCheck('#city',validateGeneral);
  $('#civicnumber').keydown(validateCivicNumber).keyup(validateCivicNumber).change(validateCivicNumber);
  loadCheck('#civicnumber',validateCivicNumber);
  $('#nap').keydown(validateNap).keyup(validateNap).change(validateNap);
  loadCheck('#nap',validateNap);
  $('#telephone').keydown(validatePhone).keyup(validatePhone).change(validatePhone);
  loadCheck('#telephone',validatePhone);
  $('#email').keydown(validateEmail).keyup(validateEmail).change(validateEmail);
  loadCheck('#email',validateEmail);
  $('#hobby').keydown(validateTextArea).keyup(validateTextArea).change(validateTextArea);
  loadCheck('#hobby',validateTextArea);
  $('#occupation').keydown(validateTextArea).keyup(validateTextArea).change(validateTextArea);
  loadCheck('#occupation',validateTextArea);
  $('#birthdate').keydown(validateBirthDate).keyup(validateBirthDate).change(validateBirthDate);
  loadCheck('#birthdate',validateBirthDate);
});

function resetForm(event) {
  event.preventDefault();
  if(!confirm("Sei sicuro di voler eliminare tutti i dati inseriti nel formulario?")) return;
  var formelements = document.getElementById("reg-form").elements;
  for (i = 0; i < formelements.length; i++) {
    type = formelements[i].type.toLowerCase();
    switch (type) {
      case "text":
      case "textarea":
      case "tel":
      case "email":
      case "number":
        formelements[i].value = "";
        var event = new Event('change');
        formelements[i].dispatchEvent(event);
        formelements[i].style.borderColor = "#9e9e9e";
        break;
      case "radio":
      case "checkbox":
        if (formelements[i].checked) {
          formelements[i].checked = false;
        }
        break;
      default:
        break;
    }
  }
}

function submitCheck(event) {
  event.preventDefault();
  var filled = true;
  var name = validator.general($('#name').val());
  var lastname = validator.general($('#lastname').val());
  var street = validator.general($('#street').val());
  var city = validator.general($('#city').val());
  var civicnumber = validator.civicnumber($('#civicnumber').val());
  var nap = validator.nap($('#nap').val());
  var telephone = validator.telephone($('#telephone').val());
  var email = validator.email($('#email').val());
  var hobby = validator.textArea($('#hobby').val());
  var occupation = validator.textArea($('#occupation').val());
  var gender = $("input[name='gender']:checked").val();
  var birthdate = validator.birthDate($('#birthdate').val());

  if (!name) {
    $('#name').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un nome valido!", "error");
  }

  if (!lastname) {
    $('#lastname').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un cognome valido!", "error");
  }

  if (!birthdate) {
    $('#birthdate').css("border-color", "red");
    filled = false;
    $.notify("Inserisci una data di nascita valida!", "error");
  }

  if (!gender) {
    filled = false;
    $.notify("Seleziona un genere!", "error");
  }

  if (!street) {
    $('#street').css("border-color", "red");
    filled = false;
    $.notify("Inserisci una via valida!", "error");
  }

  if (!civicnumber) {
    $('#civicnumber').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un numero civico valido!", "error");
  }

  if (!nap) {
    $('#nap').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un nap valido!", "error");
  }

  if (!city) {
    $('#city').css("border-color", "red");
    filled = false;
    $.notify("Inserisci una città valida!", "error");
  }

  if (!telephone) {
    $('#telephone').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un numero di telefono valido!", "error");
  }

  if (!email) {
    $('#email').css("border-color", "red");
    filled = false;
    $.notify("Inserisci un'email valida!", "error");
  }

  if (!hobby && $('#hobby').val().length > 0) {
    $('#hobby').css("border-color", "red");
    filled = false;
    $.notify("Inserisci una descrizione del tuo hobby valida!", "error");
  }

  if (!occupation && $('#occupation').val().length > 0) {
    $('#occupation').css("border-color", "red");
    filled = false;
    $.notify("Inserisci una descrizione del tuo lavoro valida!", "error");
  }

  if (filled) {
    document.getElementById("reg-form").submit();
  }
}

function changeColor(value, event) {
  event.target.value = event.target.value.replace(/ +(?= )/g, '');

  event.target.style.borderColor = "gray";

  if (value) {
    event.target.style.color = "black";
    event.target.style.borderColor = "#33cc33";
  } else {
    event.target.style.color = "red";
    event.target.style.borderColor = "red";
  }
}

function validateBirthDate(event) {
  changeColor(validator.birthDate(event.target.value), event);
}

function validateTextArea(event) {
  event.target.value = event.target.value.replace(/\n/g," ");
  changeColor(validator.textArea(event.target.value), event);
}

function validateEmail(event) {
  changeColor(validator.email(event.target.value), event);
}

function validatePhone(event) {
  changeColor(validator.telephone(event.target.value), event);
}

function validateNap(event) {
  event.target.value = event.target.value.trim();
  changeColor(validator.nap(event.target.value), event);
}

function validateCivicNumber(event) {
  event.target.value = event.target.value.toUpperCase().trim();
  changeColor(validator.civicnumber(event.target.value), event);
}

function validateGeneral(event) {
  changeColor(validator.general(event.target.value), event);
}

function loadCheck(id, validator)
{
  var element = document.getElementById(id.replace("#",""));
  if(element.value.length == 0)
    return;
  var event = {
    target: element
  };
  validator(event);
}

function addCharCounter(element, limit) {
  charCounter(element, limit);
  element.keydown(function() {
    charCounter(element, limit);
  }).keyup(function() {
    charCounter(element, limit);
  }).change(function() {
    charCounter(element, limit);
  });
}

function charCounter(element, limit) {
  var textLength = element.val().length;
  var counter = element.parent().children('span');
  if (textLength > limit) {
    counter.css("color", "red");
  } else {
    counter.css("color", "black");
  }
  counter.html(textLength + "/" + limit);
}
