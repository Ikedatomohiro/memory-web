<?php
 
namespace App\Repositories;
 
use App\Models\User;
 
class EventRepository
{
    /**
     * ユーザーのタスク一覧取得
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->events()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
 