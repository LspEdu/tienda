<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Artículos</title>
    <link rel="stylesheet" href="/css/output.css">
</head>
<body>
<body>

    <?php
        require '../../src/admin_auxiliar.php';
        
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
    <div class="container mx-auto">
        <table border="1" class="mx-auto mt-4 text-blue-600">
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
    </div>
        

</body>
</html>