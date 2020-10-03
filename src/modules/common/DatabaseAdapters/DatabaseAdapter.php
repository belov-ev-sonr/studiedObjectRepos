<?php
namespace TestTask\Common\DatabaseAdapters;

interface DatabaseAdapter
{
    public function select(string $request, array $option = []): array;

    public function insert(string $request): int;

    public function update(string $request): bool;

    public function delete(string $request): bool;
}
