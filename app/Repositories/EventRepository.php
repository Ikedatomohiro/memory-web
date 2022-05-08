<?php
 
namespace App\Repositories;
 
use App\Models\User;
use App\Models\Event;
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

        $events = $user->events()
            ->where('events.del_flg', 0)
            ->leftJoin('guests', function ($join) {
                $join->on('events.event_id', '=', 'guests.event_id')
                    ->where('guests.del_flg', '=', 0);
            })
            ->select(
                 'events.*'
                 ,DB::raw("count(guests.guest_id) as guest_count")
            )
            ->groupBy('events.event_id')
            ->orderBy('events.created_at', 'asc')
            ->get();
            // dd($events->toSql(), $events->getBindings()); ← get()する前で止めると、toSql()関数（発行したSQLを確認する）が使える。
        return $events;
    }
}
 