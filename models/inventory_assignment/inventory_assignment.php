<?php

namespace Mcdcu\Projects\models\inventory_assignment;

use sigawa\mvccore\db\DbModel;

class inventory_assignment extends DbModel
{
    public static function tableName(): string { return strtolower('inventory_assignment'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}