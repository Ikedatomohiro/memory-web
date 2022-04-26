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
}
