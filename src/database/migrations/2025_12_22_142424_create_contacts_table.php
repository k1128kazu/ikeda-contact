<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            // 仕様書が categry_id 表記のため合わせる :contentReference[oaicite:8]{index=8}
            $table->unsignedBigInteger('categry_id');

            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender'); // 1:男性 2:女性 3:その他 :contentReference[oaicite:9]{index=9}
            $table->string('email');
            $table->string('tel');
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('detail');
            $table->timestamps();

            $table->foreign('categry_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
