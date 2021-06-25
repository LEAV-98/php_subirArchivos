<?php
// echo 'Hola';
$conn = mysqli_connect("localhost", "root", "", "RelocaDB");
if (!$conn) {
    // die("Error de conexion: " . mysqli_connect_error());
    echo "se murió";
}


$dni = $_REQUEST['Dni'];
$nombre = $_REQUEST['Nombre'];
$fechaNac = $_REQUEST['FechNac'];
$raza = $_REQUEST['Raza'];
$genero = $_REQUEST['Genero'];
// $foto = $_REQUEST['Foto'];


$nombreArchivo = $_FILES['Foto']['name'];
$guardado = $_FILES['Foto']['tmp_name'];

if (!file_exists('archivos')) {
    mkdir('archivos', 0777, true);
    if (file_exists('archivos')) {
        if (move_uploaded_file($guardado, 'archivos/' . $nombreArchivo)) {
            echo "Archivo guardado con exito";
        } else {
            echo "Archivo no se pudo guardar";
        }
    }
} else {
    if (move_uploaded_file($guardado, 'archivos/' . $nombreArchivo)) {
        echo "Archivo guardado con exito";
    } else {
        echo "Archivo no se pudo guardar";
    }
}
// || $foto === ''



if ($dni === '' || $nombre === '' || $fechaNac === '' || $raza === '' || $genero === '' || $nombreArchivo === '') {
    echo "<script> window.location='/dogApp/index.html'; alert ('Falta completar datos')</script>";
} else {
    $sql = "INSERT INTO perro values ('$dni','$nombre','$fechaNac','$raza','$genero','$nombreArchivo')";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        echo 'Ta bien el perrito se ingresó';
        echo "<script> window.location='/dogApp/index.html'; alert ('perro cargado')</script>";
    } else {
        echo 'El perrito c murió';
    }
}

mysqli_close($conn);
