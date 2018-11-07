<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.html");
    exit;
}

$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$name = htmlspecialchars($_POST["name"]);
$lastname = htmlspecialchars($_POST["lastname"]);
$birthdate = htmlspecialchars($_POST["birthdate"]);
$gender = htmlspecialchars($_POST["gender"]);
$street = htmlspecialchars($_POST["street"]);
$civicnumber = htmlspecialchars($_POST["civicnumber"]);
$nap = htmlspecialchars($_POST["nap"]);
$city = htmlspecialchars($_POST["city"]);
$telephone = htmlspecialchars($_POST["telephone"]);
$email = htmlspecialchars($_POST["email"]);
$hobby = htmlspecialchars($_POST["hobby"]);
$occupation = htmlspecialchars($_POST["occupation"]);

checkEmpties($name, $lastname, $birthdate, $gender, $street, $civicnumber, $nap, $city, $telephone, $email);

function checkEmpties(...$data)
{
    foreach ($data as $d) {
        if (empty(trim($d))) {
            header("Location: registrazione.php");
            break;
        }
    }
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
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
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

        <form id="form" method="post" action="resoconto.php">
            <table class="table">
                <tbody>
                <tr>
                    <th>Nome</th>
                    <td>
                        <?php echo $name; ?>
                        <input type="hidden" name="name" value="<?php echo $name; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Cognome</th>
                    <td>
                        <?php echo $lastname; ?>
                        <input type="hidden" name="lastname" value="<?php echo $lastname; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Data di nascita</th>
                    <td>
                        <?php echo $birthdate; ?>
                        <input type="hidden" name="birthdate" value="<?php echo $birthdate; ?>"/>
                    </td>

                </tr>
                <tr>
                    <th>Genere</th>
                    <td>
                        <?php echo $gender; ?>
                        <input type="hidden" name="gender" value="<?php echo $gender; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Via</th>
                    <td>
                        <?php echo $street; ?>
                        <input type="hidden" name="street" value="<?php echo $street; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Numero civico</th>
                    <td>
                        <?php echo $civicnumber; ?>
                        <input type="hidden" name="civicnumber" value="<?php echo $civicnumber; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>NAP</th>
                    <td>
                        <?php echo $nap; ?>
                        <input type="hidden" name="nap" value="<?php echo $nap; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Città</th>
                    <td>
                        <?php echo $city; ?>
                        <input type="hidden" name="city" value="<?php echo $city; ?>"/>
                    </td>

                </tr>
                <tr>
                    <th>Telefono</th>
                    <td>
                        <?php echo $telephone; ?>
                        <input type="hidden" name="telephone" value="<?php echo $telephone; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?php echo $email; ?>
                        <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Hobby</th>
                    <td id="textArea">
                        <?php echo $hobby; ?>
                        <input type="hidden" name="hobby" value="<?php echo $hobby; ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>Professione</th>
                    <td id="textArea">
                        <?php echo $occupation; ?>
                        <input type="hidden" name="occupation" value="<?php echo $occupation; ?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <div class="row">
            <div class="input-field col s6">
                <button id="correctButton" class="btn btn-large btn-register waves-effect waves-light btn-color"
                        type="reset">Correggi
                    <i class="material-icons left">cancel</i>
                </button>
            </div>
            <div class="input-field col s6">
                <button id="submitButton" class="btn btn-large btn-register waves-effect waves-light btn-color">Registra
                    <i class="material-icons left">check</i>
                </button>
            </div>
        </div>
    </div>
	<div class="separator">
    </div>
    <div class="footer"><strong>Filippo Finke</strong> I3AC - 2018</div>
</div>
<form id="hiddenForm" action="registrazione.php" method="post">
    <?php
    foreach ($_POST as $field => $value) {
        echo '<input type="hidden" name="' . htmlspecialchars($field) . '" value="' . htmlspecialchars($value) . '">';
    }
    ?>
</form>
<script type="text/javascript" src="assets/js/preventBackHistory.js"></script>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/controllo.js"></script>
</body>
</html>
