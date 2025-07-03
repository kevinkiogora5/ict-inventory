<?php

namespace Mcdcu\Projects\models\returns;

use sigawa\mvccore\db\DbModel;

class returns extends DbModel
{
    public const RULE_MAX_LENGTH = 'max_length';

    public int $id = 0;
    public int $inventory_assignment_id = 0;
    public int $received_by = 0;
    public string $returned_condition = "";
    public string $return_date = "";
    public string $comments = "";
    public string $created_at = "";
    public string $updated_at = "";
    public static function tableName(): string { return strtolower('returns'); }
    public function attributes(): array { return [
        'inventory_assignment_id',
        'received_by',
        'returned_condition',
        'return_date',
        'comments',
    ]; }
    public function rules() { return [

        'inventory_assignment_id' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'received_by' => [self::RULE_REQUIRED, self::RULE_INTEGER],
        'returned_condition' => [self::RULE_REQUIRED, self::RULE_STRING],
        'return_date' => [self::RULE_REQUIRED, self::RULE_DATE],
        'comments' => [self::RULE_STRING, self::RULE_MAX_LENGTH => 255]
    ]; }
      public static function find_returns(): array
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