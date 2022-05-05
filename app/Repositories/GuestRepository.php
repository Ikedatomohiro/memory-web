<?php
 
namespace App\Repositories;
 
use App\Models\Event;
 
class GuestRepository
{
    /**
     * イベントの参加者一覧取得
     *
     * @param Event $event
     * @return Collection
     */
    public function forEvent(Event $event)
    {
        echo 'sslssllsls';exit();
        return $event->guests()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
 