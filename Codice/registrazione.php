<?php
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $birthdate = $_POST["birthdate"];
  $gender = $_POST["gender"];
  $street = $_POST["street"];
  $civicnumber = $_POST["civicnumber"];
  $nap = $_POST["nap"];
  $city = $_POST["city"];
  $telephone = $_POST["telephone"];
  $email = $_POST["email"];
  $hobby = $_POST["hobby"];
  $occupation = $_POST["occupation"];

  $return = checkEmpties($name, $lastname, $birthdate, $gender, $street, $civicnumber, $nap, $city, $telephone, $email);
  if(!$return)
  {
    $message = "<span style='color:red;'>Errore, alcuni dati sono stati persi durante la richiesta.</span>";
  }
}
function checkEmpties (...$data){
  $ok = true;
  foreach ($data as $d) {
    if(empty(trim($d)))
    {
      $ok = false;
      break;
    }
  }
  return $ok;
}
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"/>
  <link type="text/css" rel="stylesheet" href="assets/css/main.css"/>
  <link rel="icon" href="assets/media/img/icon.png" type="image/png">
  <meta name="description" content="Filippo Finke's Garage">
  <meta name="author" content="Filippo Finke">
  <meta name="keywords" content="samt">
  <title>Filippo Finke</title>
</head>
<body>
  <div id="preloader">
    <div class="preloader-wrapper big active preloader-size">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>
  <div id="mainPage" style="display:none;">
    <nav>
      <div class="nav-wrapper">
        <a href="index.html" class="brand-logo">Finke's Garage</a>
      </div>
    </nav>
    <div id="container" class="container center-align">
      <div class="separator">
      </div>
      <form class="col s12" id="reg-form" action="controllo.php" method="POST">
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">people</i>
            <input id="name" name="name" type="text" <?php echo (isset($name))?"value='$name'":"" ?> required>
            <label for="name">Nome<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/50</span>
          </div>
          <div class="input-field col s6">
            <input id="lastname" name="lastname" type="text" <?php echo (isset($lastname))?"value='$lastname'":"" ?> required>
            <label for="lastname">Cognome<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/50</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">date_range</i>
            <input id="birthdate" name="birthdate" type="text" <?php echo (isset($birthdate))?"value='$birthdate'":"" ?> required>
            <label for="birthdate">Data di nascita<b class="required">*</b></label>
          </div>
          <div class="input-field col s3">
            <label style="margin-top: -25px;">Genere<b class="required">*</b></label>
            <label>
              <input name="gender" value="M" type="radio" <?php echo (isset($gender) && $gender == "M")?"checked":"" ?>/>
              <span>M</span>
            </label>
          </div>
          <div class="input-field col s3">
            <label>
              <input name="gender" value="F" type="radio" <?php echo (isset($gender) && $gender == "F")?"checked":"" ?>/>
              <span>F</span>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s8">
            <i class="material-icons prefix">location_on</i>
            <input id="street" name="street" type="text" <?php echo (isset($street))?"value='$street'":"" ?> required>
            <label for="street">Via<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/50</span>
          </div>
          <div class="input-field col s4">
            <input id="civicnumber" name="civicnumber" <?php echo (isset($civicnumber))?"value='$civicnumber'":"" ?> type="text" class="" required>
            <label for="civicnumber">Numero civico<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/4</span>

          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <i class="material-icons prefix">home</i>
            <input id="nap" name="nap" type="number" <?php echo (isset($nap))?"value='$nap'":"" ?> required>
            <label for="nap">NAP<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/5</span>
          </div>
          <div class="input-field col s6">
            <input id="city" name="city" type="text" <?php echo (isset($city))?"value='$city'":"" ?> required>
            <label for="city">Città<b class="required">*</b></label>
            <span class="character-counter wordcounter" >0/50</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">phone</i>
            <input id="telephone" name="telephone" type="tel" <?php echo (isset($telephone))?"value='$telephone'":"" ?>  required>
            <label for="telephone">Telefono<b class="required">*</b></label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="email" name="email" type="email" <?php echo (isset($email))?"value='$email'":"" ?>  required>
            <label for="email">Email<b class="required">*</b></label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">edit</i>
            <textarea id="hobby" name="hobby" class=" materialize-textarea"><?php echo (isset($hobby))?"$hobby":"" ?></textarea>
            <label for="hobby">Hobby</label>
            <span class="character-counter wordcounter" >0/500</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">assignment_ind</i>
            <textarea id="occupation" name="occupation" class="materialize-textarea"><?php echo (isset($occupation))?"$occupation":"" ?></textarea>
            <label for="occupation">Professione</label>
            <span class="character-counter wordcounter" >0/500</span>
          </div>
        </div>
        <?php echo $message; ?>
        <div class="row">
          <div class="input-field col s6">
            <button class="btn btn-large waves-effect waves-light btn-color" id="resetButton">Cancella
              <i class="material-icons left">cancel</i>
            </button>
          </div>
          <div class="input-field col s6">
            <button type="submit" id="submitButton" class="btn btn-large btn-register waves-effect waves-light btn-color">Avanti
              <i class="material-icons left">send</i>
            </button>
          </div>
        </div>
      </form>
      <p>I campi con <b class="required">*</b> sono obbligatori</p>
    </div>
    <div class="separator">
    </div>
    <div class="footer"><strong>Filippo Finke</strong> I3AC - 2018</div>
  </div>
  <script type="text/javascript" src="assets/js/preventBackHistory.js"></script>
  <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.min.js"></script>
  <script type="text/javascript" src="assets/js/notify.min.js"></script>
  <script type="text/javascript" src="assets/js/validator.js"></script>
  <script type="text/javascript" src="assets/js/registrazione.js"></script>
  <?php
  if(isset($_POST["errors"]))
  {
      $errors = $_POST["errors"];
      foreach ($errors as $error)
      {
          echo '<script>$.notify("'.htmlspecialchars($error).'", "error");</script>';
      }
  }
  ?>
</body>
</html>
