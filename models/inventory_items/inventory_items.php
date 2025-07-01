<?php

namespace Mcdcu\Projects\models\inventory_items;

use sigawa\mvccore\db\DbModel;

class inventory_items extends DbModel
{
    public $id = "";
    public $name = "";
    public $category_id = "";
    public $description = "";
    public $model = "";
    public $brand = "";
    public $status = "";
    public $item_condition = "";
    public $created_by = "";
    public $created_at = "";
    public $updated_at = "";
    public $serial_number = "";
    public static function tableName(): string { return strtolower('inventory_items'); }
    public function attributes(): array { return [
        'name',
        'category_id',
        'description',
        'model',
        'brand',
        'status',
        'item_condition',
        'created_by',
        'serial_number',
    ]; }
    public function labels(): array { return []; }
    public function rules() { return []; }
      public static function find_inventory_items(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}
public static function create(array $data):?self
 {
    $inventory_items = new static();
    foreach ($data as $key => $value) {
        if (property_exists($inventory_items, $key)) {
            $inventory_items->$key = $value;
        }
    }
    if ($inventory_items->save()) {
        return $inventory_items;
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