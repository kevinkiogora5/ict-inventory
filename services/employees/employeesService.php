<?php

namespace Mcdcu\Projects\services\employees;

use Mcdcu\Projects\models\employees\employees;

class employeesService
{
    public function getAllEmployees(): array
    {
        return employees::find_employees();
    }

    public function createEmployee(array $data): ?employees
    {
        return employees::create($data);
    }

    public function updateEmployee(int $id, array $data): bool
    {
        return employees::updateById($id, $data);
    }

    public function deleteEmployee(int $id): bool
    {
        return employees::deleteById($id);
    }

    public function searchEmployees(string $term, array $columns, ?int $limit = null): array
    {
        return employees::search($term, $columns, $limit);
    }
}