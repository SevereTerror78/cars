<?php
require_once 'CarsInterface.php';
require_once 'DB.php';
 
class DBModel extends DB implements CarsInterface
{
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
        $query = "SELECT * FROM manufacturers WHERE id = $id";
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
    public function delete(int $id): bool
    {
        $query = "DELETE FROM manufacturers WHERE id = $id";
        return $this->mysqli->query($query);
    }
}
