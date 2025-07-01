<?php

namespace Mcdcu\Projects\services\department;

use Mcdcu\Projects\models\department\department;

class departmentService
{
    public function getAllDepartments(): array
    {
        return department::find_department();
    }

    public function getDepartmentByName(string $name): array
    {
        return department::findByName($name);
    }

    public function createDepartment(array $data): ?department
    {
        return department::create($data);
    }

    public function updateDepartment(int $id, array $data): bool
    {
        return department::updateById($id, $data);
    }

    public function deleteDepartment(int $id): bool
    {
        return department::deleteById($id);
    }

    public function searchDepartments(string $term, array $columns, ?int $limit = null): array
    {
        return department::search($term, $columns, $limit);
    }
}