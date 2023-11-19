<?php

namespace App\Contracts\Repositories;

interface CommentRepositoryInterface
{
    /**
     * Store a comment
     * 
     * @param array $data
     * @param string $slug
     * @param \App\Models\User $user
     * @return void
     */
    public function storeComment(array $data, string $slug, \App\Models\User $user): void;
}