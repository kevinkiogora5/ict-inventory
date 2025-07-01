<?php

namespace Mcdcu\Projects\models\employees;

use sigawa\mvccore\db\DbModel;

class employees extends DbModel
{
    public $id = "";
    public $first_name = "";
    public $last_name = "";
    public $email = "";
    public $department_id = "";
    public $user_id = "";
    public $phone = "";
    public $created_at = "";
    public static function tableName(): string { return strtolower('employees'); }
    public function attributes(): array { return [
        'first_name',
        'last_name',
        'email',
        'department_id',
        'user_id',
        'phone',
    ]; }
    public function labels(): array { return []; }
    public function rules() { return []; }
      public static function find_employees(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}
public static function create(array $data):?self
 {
    $employees = new static();
    foreach ($data as $key => $value) {
        if (property_exists($employees, $key)) {
            $employees->$key = $value;
        }
    }
    if ($employees->save()) {
        return $employees;
    }
    return null;
}
public static function updateById(int $id, array $data): bool {
    $instance = static::findbyId($id); // fetch the department by ID
    if (!$instance) {
        return false; // not found
    }
    foreach ($data as $key => $value) {
        if (property_exists($instance, $key)) {
            $instance->$key = $value;
        }
    }
    return $instance->save();
}
public static function deleteById(int $id): bool {
    $instance = static::findbyId($id);
    if (!$instance) {
        return false;
    }
    return $instance->delete();
}
public static function search(string $term, array $columns, ?int $limit = null): array {
    $table = static::tableName();
    $conditions = [];
    $params = [];

    foreach ($columns as $column) {
        $conditions[] = "$column LIKE :term";
    }
    $sql = "SELECT * FROM $table";
    if (!empty($conditions)) {
        $sql .= ' WHERE (' . implode(' OR ', $conditions) . ')';
        $params[':term'] = '%' . $term . '%';
    }
    if ($limit !== null) {
        $sql .= ' LIMIT ' . intval($limit);
    }

    return static::findAllByQuery($sql, $params);
}


}