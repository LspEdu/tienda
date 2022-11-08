<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Artículos</title>
</head>
<body>
    <?php
        require "../comunes/auxiliar.php";
        
        $pdo = conectar();

        $pdo->beginTransaction();
        $pdo->exec('LOCK TABLE articulos IN SHARE MODE');
        $execute = [];
        
        $sent = $pdo->prepare("SELECT *
                               FROM articulos");

        $sent->execute($execute);



        $pdo->commit();


    ?>

        <table style="margin:auto; border: 3px solid black">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
            </thead>
            <?php
                foreach ($sent as $fila){
                    ?><tr>
                        <td><?= $fila['codigo'] ?></td>
                        <td><?= mb_substr($fila['descripcion'], 0, 30) ?></td>
                        <td align="right"><?= $fila['precio'] ?></td>
                      </tr>

                <?php } ?>
        </table>

</body>
</html>