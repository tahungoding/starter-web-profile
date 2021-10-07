<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->id();
            $table->string('logo', '200');
            $table->string('primary_color', '50')->nullable();
            $table->string('name', '200');
            $table->text('description');
            $table->string('tagline', '200')->nullable();
            $table->string('address', '200');
            $table->string('phone', '20');
            $table->string('email', '100');
            $table->string('facebook', '100')->nullable();
            $table->string('instagram', '100')->nullable();
            $table->string('youtube', '100')->nullable();
            $table->string('twitter', '100')->nullable();
            $table->string('whatsapp', '100')->nullable();
            $table->unsignedBigInteger('updator');
            $table->foreign('updator')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('webs');
    }
}
