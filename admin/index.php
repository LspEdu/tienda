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

        $nf = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);
    ?>

        <table style="margin:auto" border="1">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th colspan="2">Acciones</th>
            </thead>
            <tbody>
            <?php
                foreach ($sent as $fila){
                    ?><tr>
                        <td><?= $fila['codigo'] ?></td>
                        <td><?= $fila['descripcion'] ?></td>
                        <td align="right"><?= $nf->format($fila['precio']) ?></td>
                        <td><a href="./borrar.php?id=<?= $fila['id']?>">Borrar</a></td>
                        <td><a href="./modificar?id=<?= $fila['id']?>">Modificar</a></td>
                      </tr>
                <?php } ?>
                
            </tbody>
        </table>

</body>
</html>