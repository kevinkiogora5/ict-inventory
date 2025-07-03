<?php

namespace Mcdcu\Projects\models\Inventory;

use sigawa\mvccore\db\DbModel;

class InventoryCategories extends DbModel
{ 
    public int $id = 0;
    public string $type = "";
    public string $description = "";
    public int $created_by = 0;
    public string $created_at = "";
    public string $updated_at = "";
    public static function tableName(): string { return strtolower('inventory_categories'); }
    public function attributes(): array { return [
        'type',
        'description',
        'created_by',
    ]; }
    public function labels(): array { return []; }
    public function rules() { return [
        'type' => [self::RULE_REQUIRED],
        'description' => [self::RULE_REQUIRED],
        'created_by' => [self::RULE_REQUIRED, self::RULE_INTEGER],
    ]; }
      public static function find_inventory_categories(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}

    public function beforeSave(): void
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
    }
}