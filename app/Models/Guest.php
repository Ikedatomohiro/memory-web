<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'event_id',
        'guest_hash',
        'guest_name',
        'company_name',
        'zip_code',
        'address',
        'tel',
        'description',
        'retuals',
        'relations',
        'relations_other',
        'groups',
        'groups_other',
        'del_flg',
    ];

    /**
     * 参加者が登録されているイベントを取得
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }


}
