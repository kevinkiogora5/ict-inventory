<?php

namespace Mcdcu\Projects\models\returns;

use sigawa\mvccore\db\DbModel;

class returns extends DbModel
{
    public static function tableName(): string { return strtolower('returns'); }
    public function attributes(): array { return []; }
    public function rules() { return []; }
}