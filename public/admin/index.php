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
        <div class="overflor-x-auto_relative">
            <table border="1" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="py-3 px-6">Código</th>
                    <th scope="col" class="py-3 px-6">Descripción</th>
                    <th scope="col" class="py-3 px-6">Precio</th>
                    <th scope="col" class="py-3 px-6" colspan="2">Acciones</th>
                </thead>
                <tbody>
                <?php
                    foreach ($sent as $fila){
                        ?><tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td  class="py-4 px-6"><?= $fila['codigo'] ?></td>
                            <td  class="py-4 px-6"><?= $fila['descripcion'] ?></td>
                            <td align="right"  class="py-4 px-6"><?= $nf->format($fila['precio']) ?></td>
                            <td><a class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" href="./borrar.php?id=<?= $fila['id']?>">Borrar</a></td>
                            <td><a class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" href="./modificar?id=<?= $fila['id']?>">Modificar</a></td>
                          </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
        
    <script src="/js/flowbite.js"></script>
</body>
</html>