<!DOCTYPE html>
<html>
    <head>
        <title>Borrar departamento - Israel García Cabañeros</title>
    </head>
    <body>
        <?php
        require_once '../config/config.php';
        try {
            // Nueva conexión PDO pasándole las constantes de config.php como parámetros.
            $miDB = new PDO(HOST_DB, USER_DB, PASS_DB);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Switch con parámetro true para que entre en la estructura del switch.
            switch (true) {

                // Si buscar existe y no es null...
                case (isset($_POST['borrar'])):

                    // Variable que guarda CodDepartamento de la URL con $_GET.
                    $codDepartamento = $_GET['CodDepartamento'];

                    // Query de borrado de departamento.
                    $statement = $miDB->prepare("DELETE FROM Departamento WHERE CodDepartamento = :codigo");
                    $statement->bindParam(':codigo', $codDepartamento);
                    $statement->execute();

                    // Si se produce la consulta correctamente, redirigiremos la página a index.php.
                    if ($statement) {
                        header('Location: ../index.php');
                    }

                    break;

                // Si hay algún error con borrar la entrada será false.
                default:
                    $entradaOK = false;

                    break;
            }
            ?>
            <!-- Los parámetros que pasamos con el location, los recogemos con $_GET de la URL y los usamos para el fin que queramos. -->
            <form name="borrarFormulario" action="<?php echo $_SERVER['PHP_SELF'] . '?CodDepartamento=' . $_GET['CodDepartamento'] . '&DescDepartamento=' . $_GET['DescDepartamento'] . '&VolumenNegocio=' . $_GET['VolumenNegocio'] ?>" method="POST">
                <label for="codDepartamento">Código departamento&nbsp;</label>
                <input type="text" name="codDepartamento" id="codDepartamento" value="<?php
                echo $_GET['CodDepartamento'];
                ?>" disabled>
                <br>
                <label for="descDepartamento">Descripción departamento&nbsp;</label>
                <input type="text" name="descDepartamento" id="descDepartamento" value="<?php
                echo $_GET['DescDepartamento'];
                ?>" disabled>
                <br>
                <label for="volumenNegocio">Volumen de negocio&nbsp;</label>
                <input type="text" name="volumenNegocio" id="volumenNegocio" value="<?php
                echo $_GET['VolumenNegocio'];
                ?>" disabled>
                <br>
                <input type="button" id="borrar" name="borrar" value="Borrar" onclick="seguro()">
                <input type="button" name="cancelar" value="Salir" onclick="location = '../index.php'">
            </form>
            <?php
        } catch (PDOException $pdoe) {
            ?>
            <p><?php echo $pdoe->getMessage(); ?></p>
            <?php
        } finally {
            unset($miDB);
        }
        ?>
        <script type="text/javascript">
            /* 
             * Esta función la usaremos para el botón de borrar departamento, 
             * su fin es que el usuario sepa que va a borrar un departamento 
             * y no cometa un error dándole a borrar sin querer.
             */
            function seguro() {
                if (confirm('¿Estas seguro de querer borrar el departamento?')) {
                    document.getElementById('borrar').type = 'submit';
                    alert('El departamento ha sido borrado permanentemente.');
                } else {
                    alert('El departamento NO ha sido borrado.');
                }
            }
        </script>
    </body>
</html>
