<?php

namespace Mcdcu\Projects\models\inventory_items;

use sigawa\mvccore\db\DbModel;

class inventory_items extends DbModel
{
    public static function tableName(): string { return strtolower('inventory_items'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}