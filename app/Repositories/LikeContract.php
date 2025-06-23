<?php

namespace App\Repositories;

use Core\Model\Model;

interface LikeContract
{
    public function create(int $owner_id, string $comment_id): Model;
    public function getByUuid(int $owner_id, string $uuid): Model;
    public function deleteByCommentID(string $uuid): int;
    public function countLikeByUserID(int $id): int;
}
