<?php

namespace Mcdcu\Projects\models\User;

use PDO;
use sigawa\mvccore\Application;
use sigawa\mvccore\UserModel;

class User extends UserModel
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $role;
    public $status;
    public $password;
    public $phone;
    public $password_created_at;
    public $online_status;
    public $access_token;
    public $created_at;
    public $updated_at;

    public static function tableName(): string
    {
        return strtolower('User');
    }
    public function attributes(): array
    {
        return [
            'first_name',
            'last_name',
            'email',
            'role',
            'status',
            'phone',
            'password_created_at',
            'online_status',
            'access_token',
        ];
    }

    // get permisson method

    public function getPermissions(): array
    {
        return [];
    }
    public function getDisplayName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function rules()
    {
        return [];
    }
     // --- User Retrieval & Queries ---
public static function search(string $term, array $columns = ['first_name', 'last_name'], ?int $limit = null): array
{
    $table = static::tableName();
    $conditions = [];
    $params = [];

    foreach ($columns as $column) {
        $conditions[] = "$column LIKE :term";
    }

    $sql = "SELECT * FROM $table";
    if (!empty($conditions)) {
        $sql .= ' WHERE (' . implode(' OR ', $conditions) . ')';
        $params[':term'] = '%' . $term . '%';
    }
    if ($limit !== null) {
        $sql .= ' LIMIT ' . intval($limit);
    }

    return static::findAllByQuery($sql, $params);
}
    public static function findByEmail(string $email): ?self
    {
        return static::findOne(['email' => $email]);
    }

    public static function findByRole(string $role): array
    {
        return static::findAll(['role' => $role]);
    }

    public static function findActiveUsers(): array
    {
        return static::findAll(['status' => 'active']);
    }

    public static function findOnlineUsers(): array
    {
        return static::findAll(['online_status' => 1]);
    }
        // --- Auditing & Activity Tracking ---
       public static function getRecentIssuers(int $limit = 10): array
       {
        $db = Application::$app->db ; //PDO connection
        $sql = "SELECT u.*, MAX(i.issued_at) AS last_issue
                FROM user u
                JOIN issue i ON i.issuer_id = u.id
                GROUP BY u.id
                ORDER BY last_issue DESC
                LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getUserIssueCount(int $userId): int
    {
        $db = Application::$app->db;
        $sql = "SELECT COUNT(*) FROM issues WHERE issuer_id = :uid";
        $stmt = $db->prepare($sql);
        $stmt->execute(['uid' => $userId]);
        return (int)$stmt->fetchColumn();
    }
    // public static function deactivateUser(int $userId): bool
    // {
    //     $u = static::findById($userId,$status = 'inactive');
    //     if (!$u) return false;
    //     $u->status = 'inactive';
    //     return $u->save();
    // }

    // public static function activateUser(int $userId): bool
    // {
    //     $u = static::findById($userId);
    //     if (!$u) return false;
    //     $u->status = 'active';
    //     return $u->save();
    // }
    public function beforeSave(): void
{
    $now = date('Y-m-d H:i:s');
    if ($this->isNewRecord) {
        $this->created_at = $now;
    }
    $this->updated_at = $now;
}


}
