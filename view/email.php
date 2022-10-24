<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../proc/enviar_correo.php" method="post">
        <input type="text" name="asunto" placeholder="asunto">
        <input type="text" name="cuerpo" placeholder="cuerpo">
        <input type="text" name="correo" placeholder="correo">
        <select name="grupo">
            <option value="none">Seleccionar Clase</option>
            <?php
                require_once '../config/conexion.php';
                require_once '../proc/func.php';

                $modulos = getModulos($conexion);

                foreach ($modulos as $modulo) {
                    // echo "[{$modulo['numero_modulo']}] -> [{$modulo['nombre_modulo']}]<br>";
                    echo "<option value='".$modulo['id_modulo']."'>".$modulo['numero_modulo']."-".$modulo['nombre_modulo']."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>