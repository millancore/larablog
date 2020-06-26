<?php

namespace App\Contract;

interface PostRepositoryInterface
{
    public function create(array $data, string $userId);

    public function allByUser(string $userId);

    public function getBySlug(string $slug);

    public function getAll(string $publicationOrder = 'desc');
}