<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Crear registro</title>
</head>
<body>
  <form action="../controller/crear_controller.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre"><br>
    <label for="primer_apellido">Primer apellido:</label><br>
    <input type="text" name="primer_apellido"><br><br>
    <label for="segundo_apellido">Segundo apellido:</label><br>
    <input type="text" name="segundo_apellido"><br><br>
    <label for="email">Email:</label><br>
    <input type="email" name="email"><br><br>
    <label for="dni">DNI:</label><br>
    <input type="text" name="dni"><br><br>
    <input type="submit" value="Crear" class="btn btn-success"></input>
  </form>
</body>
</html>

