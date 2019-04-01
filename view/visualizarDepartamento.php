<!DOCTYPE html>
<html>
    <head>
        <title>Visualizar departamento - Israel García Cabañeros</title>
    </head>
    <body>
        <?php
        require_once '../config/config.php';
        ?>
        <!-- Los parámetros que pasamos con el location, los recogemos con $_GET de la URL y los usamos para el fin que queramos. -->
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?CodDepartamento=' . $_GET['CodDepartamento'] . '&DescDepartamento=' . $_GET['DescDepartamento'] . '&VolumenNegocio=' . $_GET['VolumenNegocio'] ?>" method="POST">
            <label for="codDepartamento">Código departamento&nbsp;</label>
            <input type="text" name="codDepartamento" id="codDepartamento" value="<?php
            echo $_GET['CodDepartamento'];
            ?>" disabled/>
            <br>
            <label for="descDepartamento">Descripción departamento&nbsp;</label>
            <input type="text" name="descDepartamento" id="descDepartamento" value="<?php
                   echo $_GET['DescDepartamento'];
                   ?>" disabled/>
            <br>
            <label for="volumenNegocio">Volumen de negocio&nbsp;</label>
            <input type="text" name="volumenNegocio" id="volumenNegocio" value="<?php
                   echo $_GET['VolumenNegocio'];
                   ?>" disabled/>
            <br>
            <input type="button" name="salir" value="Salir" onclick="location = '../index.php'">
        </form>
    </body>
</html>
