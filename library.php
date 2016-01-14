<?php
/**
 * @file   library.php
 * @brief  Doxygen documentation example for files.
 * @date   janeiro, 2016
 * @author Filipe Vinha e Jorge Rocha
 */

/**
 * Class veiculos
 */
class Veiculo
{
    public $response = array();


    /**
     * Criar um novo veiculo
     * Validar se a matricula está em formato PT e se a capacidade é superior a 0
     * @param int $estado
     * @param int $capacidade
     * @param int $autonomia
     * @return string
     */
    public function setVeiculo($estado = 1, $capacidade = 0, $autonomia = 0, $matricula)
    {

        $isValidMatricula = preg_match("/^[A-Z]{2}-[0-9]{2}-[0-9]{2}|^[0-9]{2}-[0-9]{2}-[A-Z]{2}|^[0-9]{2}-[A-Z]{2}-[0-9]{2}$/", $matricula, $matches);
        if ($isValidMatricula == 0) {
            $this->response['error'][] = 'Matricula No Formato Invalido';
        }
        if ($capacidade <= 0) {
            $this->response['error'][] = 'Capacidade Invalida';
        }
        if (isset($this->response['error'])) {
            return json_encode($this->response);
        }


        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe")
        or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");

        $sql = "insert into veiculos(estado, capacidade, autonomia, matricula) values ($estado, $capacidade, $autonomia, '$matricula')";
        $this->response['result'] = pg_query($link, $sql) ? 'true' : 'false';
        $this->response['action'] = 'new vehicle';
        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Obter todos os veiculos livres
     * @return response
     */
    public function getVeiculoFree()
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select * from veiculos where estado = 1;";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['items'][] = $row;
        }
        $this->response['action'] = 'get free vehicles';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Obter todos os veiculos registados
     * @return string
     */
    public function getAllVeiculo()
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select * from veiculos;";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['items'][] = $row;
        }
        $this->response['action'] = 'get all vehicles';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Atribuir um condutor a um veiculo, cada condutor só poderá estar num veiculo,
     * se o condutor estiver noutro veiculo, ficará inactivo
     * @param $id
     * @param $estado
     * @param $condutor
     */
    public function updateVeiculo($id, $estado = 1, $condutor)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");

        $sql2 = "update condutor_veiculo set active = 0 where veiculo_id = $id";
        pg_query($link, $sql2);

        $sql = "update veiculos set estado = 0 where id_veiculo = $id";
        pg_query($link, $sql);

        $sql1 = "insert into condutor_veiculo (veiculo_id, condutor_id) values ($id, $condutor)";
        pg_query($link, $sql1);


        $sql_result = "select v.capacidade, v.autonomia, c.nome, c.contacto  from veiculos v
                      inner join condutor_veiculo cv on v.id_veiculo = cv.veiculo_id
                      inner join condutores c on c.id_condutor = cv.condutor_id
                      where cv.veiculo_id = $id and cv.condutor_id = $condutor and active =1;
                      ";
        $result = pg_query($link, $sql_result);

        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['result'][] = $row;
        }

        $this->response['action'] = 'update vehicles';


        // Closing connection
        pg_close($link);

        return json_encode($this->response);
    }

    /**
     * Listar os condutores dos veiculos
     * @return string
     */
    function getDriverVehicle()
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select  v.id_veiculo, c.nome, v.matricula from veiculos v inner join condutor_veiculo cv on cv.veiculo_id = v.id_veiculo inner join condutores c on c.id_condutor = cv.condutor_id where cv.active =1";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['items'][] = $row;
        }

        $this->response['action'] = 'drivers of vehicles';
        // Closing connection
        pg_close($link);

        return json_encode($this->response);
    }
}

/**
 * Class localizacoes
 */
class Localizacao
{
    public $response = array();

    /**
     * Obtem todos os pontos no mapa onde o veiculo passou
     * @param $coordenadas
     * @param $id
     * @return string
     */
    public function setLocalizacao($coordenadas, $id)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "insert into localizacoes (coordenadas, veiculo_id) value('$coordenadas', $id)";
        $this->response['result'] = pg_query($link, $sql) ? 'true' : 'false';
        $this->response['action'] = 'new location';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Obter as localizacoes do veiculo
     * @param $id
     * @return json com todas as localizacoes do veiculo
     */
    public function getLocalizacoes($id)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select coordenadas from localizacoes where veiculo_id = $id;";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['locations'][] = $row;
        }

        $this->response['action'] = 'get locations by veiculo';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }
}

/**
 * Class Condutor
 */
class Condutor
{
    public $response = array();

    /**
     * Condutor constructor.
     * @param $nome
     * @param $contato
     */

    /**
     * Criar um novo condutor
     * @param $nome
     * @param $contato
     * @return string
     */
    public function setDriver($nome, $contato)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "insert into condutores (nome, contacto) values('$nome', '$contato')";
        $this->response['result'] = pg_query($link, $sql) ? 'true' : 'false';
        $this->response['action'] = 'new driver';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Obter todos os condutores registados
     * @return string
     */
    public function getAllDrivers()
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select * from condutores;";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['drivers'][] = $row;
        }

        $this->response['action'] = 'get drivers';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }
}

/**
 * Class Percurso
 */
class Percurso
{
    public $response = array();

    /**
     * Atribuir uma nova rota a um veiculo/condutor
     * @param $id
     * @param $inicio
     * @param $fim
     * @param $carga
     * @return string
     */
    public function setPercurso($id, $inicio, $fim, $carga, $data)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");

        $sqlTest = "select veiculo_id, data from percursos p where data = '$data' and veiculo_id = $id";
        $resultTest = pg_query($link, $sqlTest);
        $rows = pg_num_rows($resultTest);

        if ($rows >= 1) {
            $this->response['error'][] = 'Esse veiculo ja tem atribuida um percurso para essa data';
        }

        $sqlTestCarga = "select capacidade from veiculos where id_veiculo = $id and capacidade <= $carga";
        $resultTestCarga = pg_query($link, $sqlTestCarga);
        $rowsCarga = pg_num_rows($resultTestCarga);

        if ($rowsCarga >= 1) {
            $this->response['error'][] = 'Ultrapassada a carga maxima';
        }

        if (isset($this->response['error'])) {
            return json_encode($this->response);
        }
        $sql = "insert into percursos (veiculo_id, inicio, fim, carga, data) values($id, '$inicio', '$fim', $carga, '$data')";
        $this->response['result'] = pg_query($link, $sql) ? 'true' : 'false';
        $this->response['action'] = 'new route';

        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Obter todas rotas da frota
     * @return string
     */
    public function getActiveRoutes()
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select c.nome, v.matricula, p.inicio, p.fim, p.data from percursos p
                    inner join veiculos v on v.id_veiculo = p.veiculo_id
                    inner join condutor_veiculo cv on cv.veiculo_id = p.veiculo_id
                    inner join condutores c on c.id_condutor = cv.condutor_id
                    where p.active = true";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['routes'][] = $row;
        }

        $this->response['action'] = 'get active route';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }

    /**
     * Procurar se existe algum veiculo com o mesmo trajecto, ou proximidade de destino e origem
     * @param $destino
     * @param int $distancia
     * @param $origem
     * @return string
     */
    public function searchTo($destino, $distancia = 10, $origem)
    {
        $link = pg_connect("host=localhost dbname=esof user=postgres password=filipe") or die('Could not connect: ' . pg_last_error());
        pg_set_client_encoding($link, "utf8");
        $sql = "select v.matricula, c.nome, c.contacto, p.inicio, p.fim, p.data, point($destino) <@> point(fim)::point AS distance FROM percursos p ";
        $sql .= "inner join condutor_veiculo cv on cv . veiculo_id = p . veiculo_id ";
        $sql .= "inner join veiculos v on v.id_veiculo = p.veiculo_id ";
        $sql .= "inner join condutores c on c . id_condutor = cv . condutor_id ";
        $sql .= "WHERE (point($destino) <@> point(fim)) <= $distancia * 1.60/2";
        $sql .= "and (point($origem) <@> point(inicio)) <= $distancia * 1.60/2";
        $sql .= "ORDER by distance ";
        $result = pg_query($link, $sql);
        while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $this->response['routes'][] = $row;
        }


        $this->response['action'] = 'searchTo';


        // Closing connection
        pg_close($link);
        return json_encode($this->response);
    }
}

