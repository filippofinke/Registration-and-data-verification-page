<?php
session_start();
require_once 'assets/php/CsvManager.php';
require_once 'assets/php/Validator.php';


define("PATH",'Registrazioni');
$globalFile = 'Registrazioni_tutte.csv';
$dailyFile = 'Registrazione_' . date("Y") . '-' . date("m") . '-' . date("d") . '.csv';

$filled = false;
if(isset($_SESSION["filled"]))
{
    session_destroy();
    $filled = true;
}
else if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: registrazione.php");
    exit();
}

if(!$filled) {
    $v = new Validator();

    $errors = array();
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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

    $dataArray = array(
        'date' => date("Y-m-d H:i:s"),
        'name' => $name,
        'lastname' => $lastname,
        'birthdate' => $birthdate,
        'gender' => $gender,
        'street' => $street,
        'civicnumber' => $civicnumber,
        'nap' => $nap,
        'city' => $city,
        'telephone' => str_replace(array("+"," "), "", $telephone),
        'email' => $email,
        'hobby' => $hobby,
        'occupation' => $occupation
    );

    checkEmpties($name, $lastname, $birthdate, $gender, $street, $civicnumber, $nap, $city, $telephone, $email);


    if (!$v->general($name))
        $errors[] = array("name", "Inserisci un nome valido!");
    if (!$v->general($lastname))
        $errors[] = array("lastname", "Inserisci un cognome valido!");
    if (!$v->birthDate($birthdate))
        $errors[] = array("birthdate", "Inserisci una data di nascita valida!");
    if (!$v->gender($gender))
        $errors[] = array("gender", "Inserisci un genere valido!");
    if (!$v->general($street))
        $errors[] = array("street", "Inserisci una via valida!");
    if (!$v->civicnumber($civicnumber))
        $errors[] = array("civicnumber", "Inserisci un numero civico valido!");
    if (!$v->nap($nap))
        $errors[] = array("nap", "Inserisci un nap valido!");
    if (!$v->general($city))
        $errors[] = array("city", "Inserisci una città valida!");
    if (!$v->telephone($telephone))
        $errors[] = array("telephone", "Inserisci un numero di telefono valido!");
    if (!$v->email($email))
        $errors[] = array("email", "Inserisci un'email valida!");
    if (!$v->textArea($hobby) && strlen($hobby) > 0)
        $errors[] = array("hobby", "Inserisci una descrizione del tuo hobby valida!");
    if (!$v->textArea($occupation) && strlen($occupation) > 0)
        $errors[] = array("occupation", "Inserisci una descrizione del tuo lavoro valida!");
    $errorMessage = "Uno o più dati non sono validi!<br>Redirezionamento in 3 secondi.";

    $readData = "";
    if (count($errors) == 0) {
        if (!file_exists(PATH)) {
            mkdir(PATH, 0777, true);
        }
        $globalCsv = new CsvManager(PATH . "/" . $globalFile, ";");
        $dailyCsv = new CsvManager(PATH . "/" . $dailyFile, ";");
        if ($globalCsv->writeLine($dataArray) && $dailyCsv->writeLine($dataArray)) {
            $_SESSION["filled"] = true;
            header("Location: resoconto.php");
            exit();
        } else {
            $errorMessage = "C'è stato un errore nel salvataggio dei dati, riprova!<br>Redirezionamento in 3 secondi.";
        }
    }
}
else
{
    $dailyCsv = new CsvManager(PATH . "/" . $dailyFile, ";");
    $readData = $dailyCsv->readAll();
}
function checkEmpties (...$data){
    $ok = true;
    foreach ($data as $d) {
        if(empty(trim($d)))
        {
            header("Location: registrazione.php");
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
            <a href="#" class="brand-logo">Finke's Garage</a>
        </div>
    </nav>
    <div id="container" class="container center-align">
        <table id="reportTable">
            <thead>
            <tr>
                <th>Data di registrazione</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Data di nascita</th>
                <th>Genere</th>
                <th>Via</th>
                <th>Numero civico</th>
                <th>NAP</th>
                <th>Città</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Hobby</th>
                <th>Professione</th>
            </tr>
            </thead>

            <tbody>
            <?php
                if($readData != false)
                {
                    $counter = 0;
                    foreach($readData as $d) {
                        if($counter++ == 0) continue;

                        echo '<tr>';

                        for($x = 0; $x < count($d); $x++)
                        {
                            echo '<td>' . htmlspecialchars($d[$x]) . '</td>';
                        }
                        echo '</tr>';
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="12">C'è stato un errore nella lettura del file.</td>
                    </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="input-field col s12">
                <a href="index.html" id="homeButton" class="btn btn-large btn-register waves-effect waves-light btn-color">Torna alla pagina di benvenuto
                    <i class="material-icons left">home</i>
                </a>
            </div>
        </div>
    </div>
    <div class="footer"><strong>Filippo Finke</strong> I3AC - 2018</div>
</div>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/resoconto.js"></script>
<?php
if(count($errors) > 0 || !$filled) {
?>
<form id="hiddenForm" action="registrazione.php" method="post">
    <?php
    foreach ($_POST as $a => $b) {
        echo '<input type="hidden" name="' . htmlspecialchars($a) . '" value="' . htmlspecialchars($b) . '">';
    }
    foreach ($errors as $error) {
        echo '<input type="hidden" name="errors[]" value="' . htmlspecialchars($error[1]) . '">';
    }
    ?>
</form>
<script>
    $('#container').html("<h5 class='red-text'><?php echo $errorMessage; ?></h5>");
    setTimeout(function(){document.getElementById('hiddenForm').submit()},3000);
</script>
<?php
}
?>
</body>
</html>
