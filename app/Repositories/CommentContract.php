<?php

namespace App\Repositories;

use Core\Model\Model;

interface CommentContract
{
    public function create(array $data): Model;
    public function getAll(int $owner_id, int $limit, int $offset): Model;
    public function getByUuid(int $owner_id, string $uuid): Model;
    public function getByOwnId(int $owner_id, string $own_id): Model;
    public function deleteByParentID(string $uuid): int;
    public function countCommentByUserID(int $id): int;
    public function countPresenceByUserID(int $id): Model;
    public function downloadCommentByUserID(int $id): Model;
    public function getByUuidWithoutUser(string $uuid): Model;
}
