<!DOCTYPE html>
<html>
    <head>
        <title>Mantenimiento de departamentos - Israel García Cabañeros</title>
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-w+8Gqjk9Cuo6XH9HKHG5t5I1VR4YBNdPt/29vwgfZR485eoEJZ8rJRbm3TR32P6k" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./webroot/css/stylesIndex.css">
    </head>
    <body>
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once './core/validacionFormularios.php';
        require_once './config/config.php';

        $entradaOK = true;

        $a_errores = [
            'descDepartamento' => null
        ];

        $a_respuesta = [
            'descDepartamento' => null
        ];
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="../../index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Opciones <span class="caret"></span></a>
                            <div class="dropdown-menu" aria-labelledby="themes">
                                <a class="dropdown-item" href="#">Importar</a>
                                <a class="dropdown-item" href="#">Exportar</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input class="form-control mr-sm-2" type="text" name="descDepartamento" value="<?php
                        if (isset($_POST['descDepartamento']) && is_null($a_errores['descDepartamento'])) {
                            echo $_REQUEST['descDepartamento'];
                        }
                        ?>" placeholder="Buscar">
                        <input type="submit" class="btn btn-secondary my-2 my-sm-0" name="buscar" value="Buscar">
                    </form>
                </div>
            </div>
        </nav>
        <div class="float-left aside-busquedas card mb-3 col-lg-2">
            <h3 class="card-heder">Filtros</h3>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">

                    </li>
                </ul>
            </div>
        </div>
        <?php
        try {
            $miDB = new PDO(HOST_DB, USER_DB, PASS_DB);
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            switch (true) {
                case (isset($_POST['buscar'])):
                    $a_errores['descDepartamento'] = validacionFormularios::comprobarAlfaNumerico($_POST['descDepartamento'], 100, 1, 0);

                    foreach ($a_errores as $campo => $error) {
                        if ($error != null) {
                            $entradaOK = false;
                            $_POST[$campo] = null;
                        }
                    }

                    break;

                default:
                    $entradaOK = false;

                    break;
            }

            switch (true) {
                case $entradaOK:
                    $a_respuesta['descDepartamento'] = $_POST['descDepartamento'];
                    $statement = $miDB->prepare('SELECT * FROM Departamento WHERE DescDepartamento LIKE "%' . $a_respuesta['descDepartamento'] . '%"');
                    $statement->bindParam(':descDepartamento', $a_respuesta['descDepartamento']);
                    $statement->execute();

                    if ($statement->rowCount() > 0) {
                        ?>
                        <div class=" col-lg-10 mensaje-encontrados container bg-success">Tu búsqueda tiene <?php echo $statement->rowCount(); ?> resultados.</div>
                        <table class="table table-hover container col-lg-10">
                            <thead>
                            <th scope="col">Código</th>
                            <th scope="col">Descripción</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($resultado = $statement->fetchObject()) {
                                ?>
                                <tr class="table-dark">
                                    <td><?php echo $resultado->CodDepartamento; ?></td>
                                    <td><?php echo $resultado->DescDepartamento; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else if ($statement->rowCount() == 0) {
                    ?>
                    <div class=" col-lg-10 mensaje-encontrados container bg-danger">Tu búsqueda tiene <?php echo $statement->rowCount(); ?> resultados.</div>
                    <?php
                }

                break;
        }
    } catch (PDOException $pdoe) {
        ?>
        <p><?php echo $pdoe->getMessage(); ?></p>
        <?php
    } finally {
        unset($miDB);
    }
    ?>
    <div class="container-fluid">
        <footer id="footer" class="footer">

            <div class="col-lg-10 float-right">
                <p class="float-right">Código en <a href="https://github.com/israxx97/MtoDepartamentosTema04.git" target="blank">GitHub</a></p>
                <p class="float-right">Israel García Cabañeros &COPY; isra.garcab@educa.jcyl.es</p>
            </div>

        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
