<?php

namespace Mcdcu\Projects\models\department;

use sigawa\mvccore\db\DbModel;

class department extends DbModel
{
    public static function tableName(): string { return strtolower('department'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}