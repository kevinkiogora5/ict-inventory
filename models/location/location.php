<?php

namespace Mcdcu\Projects\models\location;

use sigawa\mvccore\db\DbModel;

class location extends DbModel
{
    public $id;
    public $county;
    public $office;
    public $created_by;
    public $created_at;
    public $modified;
    public static function tableName(): string { return strtolower('location'); }
    public function attributes(): array { return [
            'county',
            'office',
            'created_by',
            'created_at',
            'modified'
    ]; }
    public function rules() { return []; }
    public function beforeSave(): void
    {
        $now = date('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->created_at = $now;
        }
        $this->modified = $now;
    }
      public static function find_location(): array
     {
    $table = static::tableName();
    $sql = "SELECT * FROM $table";
    return self::findAllByQuery($sql);
}

//     public function getCreatorName(): string
// {
//     $creator = \Mcdcu\Projects\models\User\User::findById($this->created_by);
//     return $creator ? $creator->getDisplayName() : 'Unknown';
// }
public static function dropdownOptions(): array
{
    $locations = static::all();
    $options = [];
    foreach ($locations as $location) {
        $options[$location->id] = "{$location->county} - {$location->office}";
    }
    return $options;
}
public static function create(array $data): ?self
{
    $location = new self();
    foreach ($data as $key => $value) {
        if (property_exists($location, $key)) {
            $location->$key = $value;
        }
    }
    return $location->save() ? $location : null;
}
public static function updateById(int $id, array $data): bool {
    $instance = static::findbyId($id); // fetch the department by ID
    if (!$instance) {
        return false; // not found
    }
    foreach ($data as $key => $value) {
        if (property_exists($instance, $key)) {
            $instance->$key = $value;
        }
    }
    return $instance->save();
}
public static function deleteById(int $id): bool {
    $instance = static::findbyId($id);
    if (!$instance) {
        return false;
    }
    return $instance->delete();
}
public static function search(string $term, array $columns = ['county', 'office'], ?int $limit = null): array
{
    $db = \sigawa\mvccore\Application::$app->db;
    $likeClauses = [];
    foreach ($columns as $col) {
        $likeClauses[] = "$col LIKE :kw";
    }
    $sql = "SELECT * FROM location WHERE " . implode(' OR ', $likeClauses);
    if ($limit !== null) {
        $sql .= " LIMIT :limit";
    }
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':kw', "%$term%");
    if ($limit !== null) {
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
}

}