<?php

namespace Mcdcu\Projects\models\Auth;

use sigawa\mvccore\db\DbModel;

class Auth extends DbModel
{
    public static function tableName(): string { return strtolower('Auth'); }
    public function attributes(): array { return []; }
    public function labels(): array { return []; }
    public function rules() { return []; }
}