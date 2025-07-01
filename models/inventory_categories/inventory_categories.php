<?php

namespace Mcdcu\Projects\models\inventory_categories;

use sigawa\mvccore\db\DbModel;

class inventory_categories extends DbModel
{
    public $id = "";
    public $type = "";
    public $description = "";
    public $created_by = "";
    public $created_at = "";
    public $updated_at = "";
    public static function tableName(): string { return strtolower('inventory_categories'); }
    public function attributes(): array { return [
        'type',
        'description',
        'created_by',
    ]; }
    public function labels(): array { return []; }
    public function rules() { return []; }
      public static function find_inventory_categories(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}
public static function create(array $data):?self
 {
    $inventory_categories = new static();
    foreach ($data as $key => $value) {
        if (property_exists($inventory_categories, $key)) {
            $inventory_categories->$key = $value;
        }
    }
    if ($inventory_categories->save()) {
        return $inventory_categories;
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