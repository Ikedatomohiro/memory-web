<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'user_id',
        'event_hash',
    ];

    /**
     * イベントに登録されている参加者を取得
     */
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /**
     * ハッシュ値からイベントを取得
     * 
     * 
     * 
     */
    public function getEvent($hash)
    {
        $query = Event::query();
        $event = $query->where('event_hash', $hash)->first();
        return $event;
    }
}
