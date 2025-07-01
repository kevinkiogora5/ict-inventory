<?php

namespace Mcdcu\Projects\models\department;

use sigawa\mvccore\db\DbModel;

class department extends DbModel
{
    public $id;
    public $name;
    public $description;
    public $created_by;
    public $created_at;
    public $updated_at;
    public static function tableName(): string { return strtolower('department'); }
    public function attributes(): array { return [
        'name',
        'description',
        'created_by',
        'created_at',
        'updated_at'
    ]; }
    public function labels(): array { return []; }
    public function rules() { return []; }
    public static function find_department(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}
public static function findByName(string $name) {
    $table = static::tableName();
    $sql = "SELECT * FROM $table WHERE name = :name";
    return static::findAllByQuery($sql, ['name' => $name]);
}
public static function create(array $data):?self
 {
    $department = new static();
    foreach ($data as $key => $value) {
        if (property_exists($department, $key)) {
            $department->$key = $value;
        }
    }
    if ($department->save()) {
        return $department;
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