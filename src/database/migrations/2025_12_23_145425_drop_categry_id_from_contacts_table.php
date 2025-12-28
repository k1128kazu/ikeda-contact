<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCategryIdFromContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {

            // ① 外部キーを先に落とす（存在する場合）
            if (Schema::hasColumn('contacts', 'categry_id')) {
                try {
                    $table->dropForeign(['categry_id']);
                } catch (\Throwable $e) {
                    // 既に落ちている場合などは無視
                }

                // ② カラムを落とす
                $table->dropColumn('categry_id');
            }
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // down は復元用（必要最低限）
            $table->unsignedBigInteger('categry_id')->nullable();
        });
    }
}
