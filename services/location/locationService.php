<?php

namespace Mcdcu\Projects\services;

use Mcdcu\Projects\models\location\location;

class LocationService
{
    public function getAll(): array
    {
        return location::find_location();
    }

    public function create(array $data): ?location
    {
        return location::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return location::updateById($id, $data);
    }

    public function delete(int $id): bool
    {
        return location::deleteById($id);
    }

    public function search(string $term, array $columns = ['county', 'office'], ?int $limit = null): array
    {
        return location::search($term, $columns, $limit);
    }
}
