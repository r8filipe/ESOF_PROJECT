<?php
session_start();
/**
 * @file   ws1.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha
 */
include('library.php');
/**
 * funcao para imprimir um json
 * @param $json
 */
function e($json)
{
    echo json_encode($json);
}

/**
 * Criar veiculo
 * @return string
 */
function setVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->setVeiculo(1, $_GET['capacidade'], $_GET['autonomia'], $_GET['matricula']);
    return json_encode($veiculo);
}

/**
 * Obter Veiculos Livres
 * @return string
 */
function getVeiculoFree()
{
    $veiculo = new Veiculo();
    $veiculo->getVeiculoFree();
    return json_encode($veiculo);
}

/**
 * Obter Veiculos
 * @return string
 */
function getAllVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->getAllVeiculo();
    return json_encode($veiculo);
}

/**
 * Atribuit condutor a um veiculo
 * @return string
 */
function updateVeiculo()
{
    $veiculo = new Veiculo();
    $veiculo->updateVeiculo($_GET['veiculo'], 1, $_GET['condutor']);
    return json_encode($veiculo);
}

/**
 * Atribuir uma localização a um veiculo
 * @return Localizacao
 */
function setLocalizacao()
{
    $coordenadas = $_GET['lat'] . ',' . $_GET['lng'];
    $localizacao = new Localizacao();
    $localizacao->setLocalizacao($coordenadas, $_GET['oficina_id']);
    return $localizacao;
}

/**
 * Obter a localizações de um veiculo
 * @return string
 */
function getLocalizacoes()
{
    $localizacao = new Localizacao();
    $localizacao->getLocalizacoes($_GET['veiculo']);
    return json_encode($localizacao);
}

/**
 * Registar um novo condutor
 * @return string
 */
function setDriver()
{
    $condutor = new Condutor();
    $condutor->setDriver($_GET['nome'], $_GET['contato']);
    return json_encode($condutor);
}

/**
 * Listar todos os condutores registados
 * @return string
 */
function getAllDrivers()
{
    $condutor = new Condutor();
    $condutor->getAllDrivers();
    return json_encode($condutor);
}

/**
 * Listar todos os condutores e respectivos veiculos
 * @return string
 */
function getDriverVehicle()
{
    $driverVehicle = new Veiculo();
    $driverVehicle->getDriverVehicle();
    return json_encode($driverVehicle);
}

/**
 * Criar um novo percurso
 * @return string
 */
function setPercurso()
{
    $googleDestino = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($_GET['destino']) . "&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));
    $googleOrigem = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($_GET['origem']) . "&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE"));

    if ($googleDestino->status == 'ZERO_RESULTS') {
        $response['response']['ERROR']['destino'] = 'Destino Invalido, tente Novamente';
    }
    if ($googleOrigem->status == 'ZERO_RESULTS') {
        $response['response']['ERROR']['Origem'] = 'Origem Invalido, tente Novamente';
    }

    if (isset($response)) {
        return json_encode($response);
    }
    $origem = $googleOrigem->results[0]->geometry->location->lat . ',' . $googleOrigem->results[0]->geometry->location->lng;
    $destino = $googleDestino->results[0]->geometry->location->lat . ',' . $googleDestino->results[0]->geometry->location->lng;
    $percurso = new Percurso();
    $percurso->setPercurso($_GET['veiculo'], $origem, $destino, $_GET['carga'], $_GET['data']);
    return json_encode($percurso);
}

/**
 * Obter todos os percurso Activos
 * @return string
 */
function getActiveRoutes()
{
    $percurso = new Percurso();
    $percurso->getActiveRoutes();
    return json_encode($percurso);
}

/**
 * procurar trajectos identicos
 * @return string
 */
function searchTo()
{
    $destino = $_GET['desLat'] . ',' . $_GET['desLng'];
    $origem = $_GET['oriLat'] . ',' . $_GET['oriLng'];
    $distancia = $_GET['distancia'];
    $percurso = new Percurso();
    $percurso->searchTo($destino, $distancia, $origem);
    return json_encode($percurso);
}

/**
 * Gerar coordenadas para localização
 * @return string
 */
function generateCoordenates()
{
    for ($i = 0; $i <= 50; $i++) {
        $x = rand(37000000, 42999999) / 1000000;
        $y = rand(6000000, 9999999) / 1000000;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $x . ',-' . $y . '&key=AIzaSyAcb4IphCwicIMVCal_rr12SMuUijYYveE';
        $geo = json_decode(file_get_contents($url));
        if ($geo->status == 'OK') {
            $coordenates[] = $x . ',-' . $y;
            $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
            pg_set_client_encoding($link, "utf8");
            $sql = "insert into localizacoes (coordenadas, veiculo_id) values('" . $x . ',-' . $y . "', " . rand(26, 28) . ")";
            pg_query($link, $sql);
        } else {
            $i--;
        }
    }

    return json_encode($coordenates);

}

/**
 * Fazer a gestao de cada metodo
 */
if ($_GET['token'] == "trabalhoEsof2016") {
    if (isset($_GET['method'])) {
        $method = $_GET['method'];
        switch ($method) {
            case 'setVeiculo';
                $response = setVeiculo();
                break;
            case 'getVeiculoFree';
                $response = getVeiculoFree();
                break;
            case 'getAllVeiculo';
                $response = getAllVeiculo();
                break;
            case 'updateVeiculo';
                $response = updateVeiculo();
                break;
            case 'setLocalizacao';
                $response = setLocalizacao();
                break;
            case 'getLocalizacoes';
                $response = getLocalizacoes();
                break;
            case 'setDriver';
                $response = setDriver();
                break;
            case 'getAllDrivers';
                $response = getAllDrivers();
                break;
            case 'setPercurso';
                $response = setPercurso();
                break;
            case 'searchTo';
                $response = searchTo();
                break;
            case 'generateCoordenates':
                $response = generateCoordenates();
                break;
            case 'getDriverVehicle':
                $response = getDriverVehicle();
                break;
            case 'getActiveRoutes':
                $response = getActiveRoutes();
                break;

        }

        echo $response;
        return;
    }
    $reponse['erro'] = 'TOKEN INVALIDO';
    echo json_encode($response);
}