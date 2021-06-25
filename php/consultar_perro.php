<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Consulta en proceso</title>
</head>

<body>
    <header class="container">
        <h1 class="text-center">Registro Local Canino</h1>
        <h2 class="text-center">Busqueda de Paciente perrunos</h2>
    </header>
    <main>
        <section>
            <div class="container">
                <?php


                $conn = mysqli_connect("localhost", "root", "", "RelocaDB");
                if (!$conn) {
                    // die("Error de conexion: " . mysqli_connect_error());
                    echo "se murió";
                }

                $nombre_consulta = $_REQUEST['Nombre'];
                if ($nombre_consulta === '') {
                    echo '<p class="alert alert-danger w-75 mx-auto">Ingrese un nombre valido</p> ';
                } else {
                    echo '<p class="text-capitalize">Consultando perro: ' . $nombre_consulta . '</p>';
                    $sql = "select * from perro where Nombre like '" . $nombre_consulta . "'";
                    $result = mysqli_query($conn, $sql);
                    $num_resultados = mysqli_num_rows($result);

                    echo "<p>Número de perros encontrados: " . $num_resultados . "</p>";
                    if ($num_resultados === 0) {
                        echo '<p>No hay perrito que se llama ' . $nombre_consulta . '</p>';
                    } else {

                        for ($i = 0; $i < $num_resultados; $i++) {
                            $row = mysqli_fetch_array($result);
                            $imagen = '/dogApp/php/archivos/' . $row['foto'];
                            echo '<div class=" ">
                                    <div class="card w-25">
                                        <img src=' . $imagen . ' class="card-img-top" alt="imagen">
                                        <div class="card-body">
                                            <p class="card-title text-capitalize">
                                                ' . $row["nombre"] . '
                                            </p>
                                            <p class="text-capitalize"> DNI: ' . $row["dni"] . '</p>
                                            <p class="text-capitalize"> Raza: ' . $row["raza"] . '</p>
                                            <p class="text-capitalize"> Genero: ' . $row["genero"] . '</p>
                                            <p class="text-capitalize"> Fecha Nacimiento: ' . $row["fechaNac"] . '</p>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                }
                ?>
                <a class="btn btn-primary mx-5 my-2" href="/dogApp/consultarPerro.html">Regresar</a>

            </div>

        </section>
    </main>
</body>

</html>