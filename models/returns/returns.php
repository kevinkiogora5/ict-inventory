<?php

namespace Mcdcu\Projects\models\returns;

use sigawa\mvccore\db\DbModel;

class returns extends DbModel
{
    public $id = "";
    public $inventory_assignment_id = "";
    public $received_by = "";
    public $returned_condition = "";
    public $return_date = "";
    public $comments = "";
    public $created_at= "";
    public $updated_at= "";
    public static function tableName(): string { return strtolower('returns'); }
    public function attributes(): array { return [
        'inventory_assignment_id',
        'received_by',
        'returned_condition',
        'return_date',
        'comments',
    ]; }
    public function rules() { return []; }
      public static function find_returns(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}
public static function create(array $data):?self
 {
    $returns = new static();
    foreach ($data as $key => $value) {
        if (property_exists($returns, $key)) {
            $returns->$key = $value;
        }
    }
    if ($returns->save()) {
        return $returns;
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