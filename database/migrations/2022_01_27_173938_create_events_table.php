<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id')->comment('イベントID');
            $table->integer('user_id')->unsigned()->comment('ユーザーID');
            $table->string('event_hash', 50)->index()->comment('イベントハッシュ');
            $table->string('event_name', 100)->nullable()->comment('イベント名');
            $table->date('hold_date')->nullable()->comment('開催日');
            $table->string('hold_place', 100)->nullable()->comment('開催場所');
            $table->string('organizer_name', 32)->nullable()->comment('主催者');
            $table->text('description')->nullable()->comment('備考');
            $table->boolean('del_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
