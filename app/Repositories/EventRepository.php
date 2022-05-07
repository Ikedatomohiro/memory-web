<?php
 
namespace App\Repositories;
 
use App\Models\User;
use Illuminate\Support\Facades\DB;
 
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
        // SQLを直接記述する方法は、オブジェクトを返してくれない。オブジェクトとして扱うところと配列として扱うところが混在するのはよくないので、できるだけオブジェクトで利用できる方法を探る。
        // $sql = <<<SQL
        //     SELECT 
        //          events.event_name
        //         ,events.event_id
        //         ,events.user_id
        //         ,events.event_hash
        //         ,events.event_name
        //         ,events.hold_date
        //         ,events.hold_place
        //         ,events.organizer_name
        //         ,events.description
        //         ,events.del_flg
        //         ,events.created_at
        //         ,events.updated_at
        //         ,count(guests.guest_id) as guest_count
        //     FROM
        //         events
        //     LEFT JOIN
        //         guests
        //     ON
        //         guests.event_id = events.event_id AND guests.del_flg = 0
        //     WHERE
        //         events.user_id = ?
        //     AND
        //         events.del_flg = 0
        //     GROUP BY
        //         events.event_id
        // SQL;
        // return DB::select($sql, [$user->id]);
        // $event = Event::select()
        //          ->join('guests', 'event_id', '=', 'event_id')
        //          ->get();
        // return $event;



        return $user->events()
            ->where('del_flg', 0)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
 