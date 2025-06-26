<?php

namespace Mcdcu\Projects\models\employees;

use sigawa\mvccore\db\DbModel;

class employees extends DbModel
{
    public static function tableName(): string { return strtolower('employees'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}