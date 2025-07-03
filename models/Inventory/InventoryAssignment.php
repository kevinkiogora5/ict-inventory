<?php

namespace Mcdcu\Projects\models\Inventory;

use sigawa\mvccore\db\DbModel;

class InventoryAssignment extends DbModel
{
   public const RULE_MAX_LENGTH = 'max_length';
    public int $id = 0;
    public int $inventory_item_id = 0;
    public int $employee_id = 0;
    public int $location_id = 0;
    public int $issued_by = 0;
    public string $issue_date = "";
    public string $notes = "";
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string { return strtolower('inventory_assignment'); }
    public function attributes(): array { return [
        'inventory_item_id',
        'employee_id',
        'location_id',
        'issued_by',
        'issue_date',
        'notes',
    ]; }
    public function labels(): array { return []; }
    public function rules() { return [
        'inventory_item_id' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'employee_id' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'location_id' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'issued_by' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'issue_date' => [self::RULE_REQUIRED, self::RULE_DATE],
        'notes' => [self::RULE_STRING, self::RULE_MAX_LENGTH => 255]
    ]; }
      public static function find_inventory_assignment(): array
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