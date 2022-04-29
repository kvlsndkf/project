<?php
include_once('/xampp/htdocs' . '/project/database/connection.php');

class Place
{
    //atributes
    public int $id;
    public string $nome;
    public string $url;

    //getters and setters
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    //----------------------------
    public function getNome(): string
    {
        return $this->nome;
    }
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
    //----------------------------
    public function getUrl(): int
    {
        return $this->url;
    }
    public function setUrl(int $url): void
    {
        $this->url = $url;
    }
    //----------------------------
    //methods
    /**
     * @method registerTeacher() registers the teachers by 
     * @param Teacher $teacher 
     */
    public function getPlaces()
    {
        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/35/distritos";
        $json = file_get_contents($url);
        $api = json_decode($json, true);

        $districts = $this->getDistricts($api);
        $cities = $this->getCities($api);

        return new Places($districts, $cities);
    }

    //----------------------------
    //methods
    /**
     * @method registerTeacher() registers the teachers by 
     * @param Teacher $teacher 
     */
    public function getDistricts($api)
    {
        $districts = array_filter($api, function ($district) {
            return $district['municipio']['nome'] === "São Paulo";
        });

        return array_map(function ($list) {
            return new Location($list['nome'], $list['id']);
        }, $districts);
    }

    //----------------------------
    /**
     * @method registerTeacher() registers the teachers by 
     * @param Teacher $teacher 
     */
    public function getCities($api)
    {
        $cities = array_filter($api, function ($city) {
            return $city['municipio']['nome'] != "São Paulo";
        });

        return array_map(function ($list) {
            return new Location($list['nome'], $list['id']);
        }, $cities);
    }
}

class Location
{
    public string $name;
    public int $id;

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
}

class Places
{
    public array $districts;
    public array $cities;

    public function __construct(array $districts, array $cities)
    {
        $this->districts = $this->array_sort($districts, "name");
        $this->cities = $this->array_sort($cities, "name");
    }

    function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}
