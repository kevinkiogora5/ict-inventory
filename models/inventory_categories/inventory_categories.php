<?php

namespace Mcdcu\Projects\models\inventory_categories;

use sigawa\mvccore\db\DbModel;

class inventory_categories extends DbModel
{
    public static function tableName(): string { return strtolower('inventory_categories'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}