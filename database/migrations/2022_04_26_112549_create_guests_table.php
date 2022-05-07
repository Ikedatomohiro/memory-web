<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('guest_id')->comment('参加者ID');
            $table->integer('event_id')->unsigned()->index()->comment('イベントID');
            $table->string('guest_hash', 50)->index()->comment('参加者ハッシュ');
            $table->string('guest_name', 100)->nullable()->comment('参加者名');
            $table->string('company_name', 100)->nullable()->comment('会社名');
            $table->string('zip_code', 10)->nullable()->comment('郵便番号');
            $table->string('address', 100)->nullable()->comment('住所');
            $table->string('tel', 100)->nullable()->comment('電話番号');
            $table->string('description', 500)->nullable()->comment('備考');
            $table->string('retuals', 100)->nullable()->comment('参加儀式');
            $table->string('relations', 100)->nullable()->comment('ご関係');
            $table->string('relations_other', 100)->nullable()->comment('ご関係（その他）');
            $table->string('groups', 100)->nullable()->comment('所属');
            $table->string('groups_other', 100)->nullable()->comment('所属（その他）');
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
        Schema::dropIfExists('guests');
    }
}
