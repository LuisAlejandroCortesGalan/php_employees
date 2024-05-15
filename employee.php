<?php
// Desactivar toda notificación de error
error_reporting(0);

// datos que se envían desde el formulario
$email = $_POST['email'];
$key = $_POST['password'];
$name = "";
$surname = "";
$birthdate = "";
$age = 0;
$mensaje = "";


// obtener los datos del json
$json = file_get_contents('employees.json');
$empleados = json_decode($json, true);
// print_r($empleados)

$empleadoEncontrado = false;
for ($i = 0; $i < count($empleados); $i++) {
    if ($email == $empleados[$i]['email'] && $key == $empleados[$i]['key']) {
        // echo "Bienvenido " . $empleados[$i]['name'];
        $name = $empleados[$i]['name'];
        $surname = $empleados[$i]['surname'];
        $birthdate = $empleados[$i]['dateBirth'];
        // $age = calcularEdad($birthdate);
        $empleadoEncontrado = true;
        break;
    }
}

if ($empleadoEncontrado == false) {
    header('Location: index.php');
    $mensaje += "email o contraseña incorrectos";

}

function calcularEdad($fecha) {
    $hoy = explode( "-", date("Y-m-d"));
    $hoyYear = $hoy[0];
    $hoyMonth = $hoy[1];
    $hoyDay = $hoy[2];

    $birth = explode("-", $fecha);
    $birthYear = $birth[0];
    $birthMonth = $birth[1];
    $birthDay = $birth[2];
    
    $edad = $hoyYear - $birthYear;

    if ( ($hoyMonth < $birthMonth)  || (($hoyMonth == $birthMonth) && ($hoyDay < $birthDay))) { 
        $edad = $edad -1;
    }
    echo $edad;
}

// calcularEdad($birthdate);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
</head>
<body>
    <main>
        <h1>Datos del empleado:</h1>
        <p>Nombre: <?= $name?></p>
        <p>Apellido: <?= $surname ?></p>
        <p>Edad: <?= calcularEdad($birthdate) ?></p>
        <p>Email: <?= $email ?></p>
    </main>
</body>
</html>