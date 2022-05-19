<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'user_id',
        'event_hash',
    ];
    protected $dates = ['hold_date'];

    /**
     * イベントに登録されている参加者を取得
     */
    public function guests()
    {
        return $this->hasMany(Guest::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
