<?php
require_once 'CarsInterface.php';
require_once 'DB.php';

class DBMaker extends DB implements CarsInterface
{

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): ?int
    {
        $sql = 'INSERT INTO manufacturers (%s) VALUES (%s)';
        $fields = '';
        $values = '';
        foreach ($data as $field => $value) {
            if ($fields > '') {
                $fields .= ',' . $field;
            } else
                $fields .= $field;

            if ($values > '') {
                $values .= ',' . "'$value'";
            } else
                $values .= "'$value'";
        }
        $sql = sprintf($sql, $fields, $values);
        $this->mysqli->query($sql);

        $lastInserted = $this->mysqli->query("SELECT LAST_INSERT_ID() id;")->fetch_assoc();

        return $lastInserted['id'];
    }

    public function get(int $id): array
    {
        $query = "SELECT * FROM manufacturers WHERE id = $id"; //manufacturers = makers csak nem működött az mysqly-ben és újjat kellett létrehozni

        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function getByName(string $name): array
    {
        $query = "SELECT * FROM manufacturers WHERE name = '$name'";

        return $this->mysqli->query($query)->fetch_assoc();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM manufacturers ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function update(int $id, array $data)
    {
        $query = "UPDATE manufacturers SET name='{$data['name']}' WHERE id = $id;";
        $this->mysqli->query($query);

        return $this->get($id);
    }

    public function delete(int $id):bool
    {
        $query = "DELETE FROM manufacturers WHERE id = $id";

        return $this->mysqli->query($query);
    }

    public function getAbc(): array
    {
        $makers = $this->getAll();
        $abc = [];
        foreach ($makers as $maker) {
            $ch = strtoupper($maker['name'][0]);
            if (!in_array($ch, $abc)) {
                $abc[] = $ch;
            }
        }

        return $abc;
    }

    public function getByFirstCh($ch)
    {
        $query = "SELECT * FROM manufacturers WHERE name LIKE '$ch%' ORDER BY name"; 

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function findByName($needle)
    {
        $query = "SELECT * FROM manufacturers WHERE name LIKE '%$needle%' ORDER BY name";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function truncate()
    {
        $query = "TRUNCATE TABLE manufacturers;";

        return $this->mysqli->query($query);
    }

    public function getCount(): int
    {
        $query = "SELECT COUNT(1) AS cnt FROM manufacturers;";

        $result = $this->mysqli->query($query)->fetch_assoc();

        return $result['cnt'];
    }
}
