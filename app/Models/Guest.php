<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'guest_hash',
        'guest_name',
        'company_name',
        'address',
        'tel',
        'description',
        'retuals',
    ];

    /**
     * 参加者が登録されているイベントを取得
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }


}
