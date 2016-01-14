<?php
session_start();
/**
 * @file   index.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha e Jorge Rocha
 */
if (isset($_POST['method'])) {
    $url = 'http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&';
    foreach ($_POST as $key => $value) {
        $url .= $key . '=' . urlencode($value) . '&';
    }
    $response = file_get_contents($url);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ESOF</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- MetisMenu CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">ESOF</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">


    <!-- Service Tabs -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">DIRECT</h2>
        </div>
        <div class="col-lg-12">

            <div id="myTabContent" class="tab-content" style="margin-top:25px;">
                <div class="tab-pane fade active in">
                    <ul class="metismenu" id="menu">
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Inserir Veiculo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <form action="" role="form" id="myform" method="post">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Matricula</label>
                                                    <input type="text" class="form-control" name="matricula"
                                                           id="matricula"
                                                           required=""
                                                           data-validation-required-message="matricula."
                                                           aria-invalid="false">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Capacidade</label>
                                                    <input type="number" class="form-control" name="capacidade"
                                                           id="capacidade"
                                                           required=""
                                                           data-validation-required-message="Capacidade."
                                                           aria-invalid="false">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Autonomia</label>
                                                    <input type="number" class="form-control" name="autonomia"
                                                           id="autonomia"
                                                           required=""
                                                           data-validation-required-message="Inserir a autonomia."
                                                           aria-invalid="false">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary" id="btnadd"
                                                    name="method" value="setVeiculo">Criar Veiculo
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Inserir Condutor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <form action="" role="form" id="myform" method="post">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="nome"
                                                           id="nome"
                                                           required=""
                                                           data-validation-required-message="nome."
                                                           aria-invalid="false">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Contato</label>
                                                    <input type="number" class="form-control" name="contato"
                                                           id="contato"
                                                           required=""
                                                           data-validation-required-message="contato."
                                                           aria-invalid="false">
                                                    <p class="help-block"></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="btnadd"
                                                    name="method" value="setDriver">Criar Condutor
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Veiculos Livres<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>MATRICULA</th>
                                                <th>Capacidade</th>
                                                <th>Autonomia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $free = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getVeiculoFree'));
                                            if (isset($free->response->items)) {
                                                foreach ($free->response->items as $vechile)
                                                    echo '
                                                      <tr>
                                                        <td>' . $vechile->matricula . '</td>
                                                        <td>' . $vechile->capacidade . '</td>
                                                        <td>' . $vechile->autonomia . '</td>
                                                      </tr>
                                                ';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Todos Veiculos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Capacidade</th>
                                                <th>Autonomia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $free = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getAllVeiculo'));
                                            if (isset($free->response->items)) {
                                                foreach ($free->response->items as $vechile)
                                                    echo '
                                                      <tr>
                                                        <td>' . $vechile->matricula . '</td>
                                                        <td>' . $vechile->capacidade . '</td>
                                                        <td>' . $vechile->autonomia . '</td>
                                                      </tr>
                                                ';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Todos Condutores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Contacto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $drivers = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getAllDrivers'));
                                            if (isset($drivers->response->drivers)) {
                                                foreach ($drivers->response->drivers as $driver)
                                                    echo '
                                                      <tr>
                                                        <td>' . $driver->id_condutor . '</td>
                                                        <td>' . $driver->nome . '</td>
                                                        <td>' . $driver->contacto . '</td>
                                                      </tr>
                                                ';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Todos Percursos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Veiculo</th>
                                                <th>Condutor</th>
                                                <th>Origem</th>
                                                <th>Destino</th>
                                                <th>Data</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $routes = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getActiveRoutes'));
                                            if (isset($routes->response->routes)) {
                                                foreach ($routes->response->routes as $route)
                                                    echo '
                                                      <tr>
                                                        <td>' . $route->nome . '</td>
                                                        <td>' . $route->matricula . '</td>
                                                        <td>' . $route->inicio . '</td>
                                                        <td>' . $route->fim . '</td>
                                                        <td>' . substr($route->data, 0, 10) . '</td>
                                                      </tr>
                                                ';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Atribuir Condutor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <form action="" role="form" id="myform" method="post">
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Veiculo</label>
                                            <select name="veiculo">
                                                <?php
                                                $free = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getAllVeiculo'));
                                                if (isset($free->response->items)) {
                                                    foreach ($free->response->items as $vechile)
                                                        echo '
                                                            <option value="' . $vechile->id_veiculo . '">' . $vechile->matricula . '</option>
                                                        ';
                                                }
                                                ?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Condutor</label>
                                            <select name="condutor">
                                                <?php
                                                $drivers = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getAllDrivers'));
                                                if (isset($drivers->response->drivers)) {
                                                    foreach ($drivers->response->drivers as $driver)
                                                        echo '
                                                            <option value="' . $driver->id_condutor . '">' . $driver->nome . '</option>
                                                        ';
                                                }
                                                ?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary" id="btnadd"
                                            name="method" value="updateVeiculo">Atribuir Condutor
                                    </button>
                                </form>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Veiculos Com Condutor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Condutor</th>
                                                <th>Veiculo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $driverVehicles = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getDriverVehicle'));
                                            if (isset($driverVehicles->response->items)) {
                                                foreach ($driverVehicles->response->items as $driverVehicle)
                                                    echo '
                                                      <tr>
                                                        <td>' . $driverVehicle->nome . '</td>
                                                        <td>' . $driverVehicle->matricula . '</td>
                                                      </tr>
                                                ';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                Atribuir Percurso<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <form action="" role="form" id="myform" method="post">
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Veiculo</label>
                                            <select name="veiculo">
                                                <?php
                                                $driverVehicles = json_decode(file_get_contents('http://localhost:8080/esof/ws1.php?token=trabalhoEsof2016&method=getDriverVehicle'));
                                                if (isset($driverVehicles->response->items)) {
                                                    foreach ($driverVehicles->response->items as $driverVehicle)
                                                        echo '
                                                            <option value="' . $driverVehicle->id_veiculo . '">' . $driverVehicle->matricula . '</option>
                                                        ';
                                                }
                                                ?>
                                            </select>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Origem (Morada, localidade ou codigo/postal)</label>
                                            <input type="text" class="form-control" name="origem"
                                                   id="text"
                                                   required=""
                                                   data-validation-required-message="origem."
                                                   aria-invalid="false">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Destino (Morada, localidade ou codigo/postal)</label>
                                            <input type="text" class="form-control" name="destino"
                                                   id="destino"
                                                   required=""
                                                   data-validation-required-message="destino."
                                                   aria-invalid="false">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Carga</label>
                                            <input type="number" class="form-control" name="carga"
                                                   id="carga"
                                                   required=""
                                                   data-validation-required-message="carga."
                                                   aria-invalid="false">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <label>Data</label>
                                            <input type="date" name="data" max="2016-12-31"
                                                   min="<?php echo date('Y-m-d'); ?>"
                                                   class="form-control"><br><br>
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="btnadd"
                                            name="method" value="setPercurso">Atribuir Percurso
                                    </button>
                                </form>
                            </ul>
                        </li>
                        <li class="sidebar-search ">
                            <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                JSON RESPONSE<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php
                                    if (isset($response)) {
                                        echo $response;
                                    }
                                    ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

    <hr>
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Filipe Vinha e JOrge Rocha</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.js"></script>
<script>
    $(document).ready(function () {
        $("#menu").metisMenu({
            toggle: false
        });

    });
</script>
</body>

</html>
<?php
session_destroy();
session_unset();
?>

