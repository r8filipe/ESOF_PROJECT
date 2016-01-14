<?php
session_start();
/**
 * @file   view.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha e Jorge Rocha
 */
if (isset($_POST['method'])) {
    $url = 'http://localhost:8080/esof/ws2.php?token=trabalhoEsof2016&';
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

        <title>Modern Business - Start Bootstrap Template</title>

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
        <style>

            #map {
                height: 450px;
            }
        </style>


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
                <h2 class="page-header">Utilizador</h2>
            </div>
            <div class="col-lg-12">

                <div id="myTabContent" class="tab-content" style="margin-top:25px;">
                    <div class="tab-pane fade active in">
                        <ul class="metismenu" id="menu">
                            <li class="sidebar-search ">
                                <a href="#" style="font-size:1.2em"><i class="fa fa-money"></i></i>
                                    Procurar Percursos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <div class="panel-body">
                                            <form action="" role="form" id="myform" method="post">
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Origem (RUA Localidade ou Codigo Postal)</label>
                                                        <input type="text" class="form-control" name="origem"
                                                               id="origem"
                                                               required=""
                                                               data-validation-required-message="origem."
                                                               aria-invalid="false">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Destino (RUA Localidade ou Codigo Postal)</label>
                                                        <input type="text" class="form-control" name="destino"
                                                               id="destino"
                                                               required=""
                                                               data-validation-required-message="Destino."
                                                               aria-invalid="false">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>
                                                <div class="control-group form-group">
                                                    <div class="controls">
                                                        <label>Distancia Aceitavel KM</label>
                                                        <input type="number" class="form-control" name="distancia"
                                                               id="distancia"
                                                               required=""
                                                               data-validation-required-message="Distancia em Km."
                                                               aria-invalid="false">
                                                        <p class="help-block"></p>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary" id="btnadd"
                                                        name="method" value="searchTo">Procurar
                                                </button>
                                            </form>
                                        </div>
                                        <?php
                                        if (isset($response)) {

                                            $routes = json_decode($response);
                                            ?>
                                            <div class="panel-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Veiculo</th>
                                                        <th>Condutor</th>
                                                        <th>Contacto</th>
                                                        <th>Origem</th>
                                                        <th>Destino</th>
                                                        <th>Distancia a percorrer (KM)</th>
                                                        <th>Data</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if (isset($routes->response->routes)) {
                                                        foreach ($routes->response->routes as $route)
                                                            echo '
                                                              <tr>
                                                                <td>' . $route->matricula . '</td>
                                                                <td>' . $route->nome . '</td>
                                                                <td>' . $route->contacto . '</td>
                                                                <td>' . $route->inicio . '</td>
                                                                <td>' . $route->fim . '</td>
                                                                <td>' . substr($route->distance, 0, 4) * 1.60 . '</td>
                                                                <td>' . substr($route->data, 0, 10) . '</td>
                                                              </tr>
                                                            ';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            if (isset($routes->response)) {
                                                if (isset($routes->response->time)) {
                                                    echo '<input type="text" value="' . $routes->response->time->city->coord->lat . '" id="lat" style="visibility:hidden"/>';
                                                    echo '<input type="text" value="' . $routes->response->time->city->coord->lon . '" id="lon" style="visibility:hidden"/>';
                                                    ?>
                                                    <div class="panel-body">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <?php
                                                                foreach ($routes->response->time->list as $list)
                                                                    echo '<th>' . date('l dS \o\f F Y ', $list->dt) . '</th>';

                                                                ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <?php

                                                                foreach ($routes->response->time->list as $list)
                                                                    echo '

                                                                <td>
                                                                <div class="left"></div> <img src="http://openweathermap.org/img/w/' . $list->weather[0]->icon . '.png"/><br/>' . $list->weather[0]->description . '</div>
                                                                <div class="right">Min:' . $list->temp->min . '<br/>Max:' . $list->temp->max . '</div>
                                                                </td>

                                                            ';
                                                                ?>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php
                                                }
                                            }
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
    </div>
    <div id="map" class="container"></div>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE&signed_in=true&libraries=places&callback=initMap"
        async defer></script>
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>


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
    <script>
        var map;
        var infowindow;

        function initMap() {

            var latitu = Number(document.getElementById("lat").value);
            var longi = Number(document.getElementById("lon").value);
            console.log(latitu);
            console.log(longi);
            var pyrmont = {lat: latitu, lng: longi};

            map = new google.maps.Map(document.getElementById('map'), {
                center: pyrmont,
                zoom: 15
            });

            infowindow = new google.maps.InfoWindow();

            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: pyrmont,
                radius: 500,
                types: ['car_rental', 'restaurant', '']
            }, callback);
        }

        function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

    </script>
    </body>

    </html>
<?php
session_destroy();
session_unset();
?>