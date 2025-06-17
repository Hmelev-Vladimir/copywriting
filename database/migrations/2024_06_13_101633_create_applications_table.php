<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'applications',
            function (Blueprint $table) {
                $table->id();
                $table->string('cover')
                ->default('placeholder.png');
                $table->string('title');
                $table->string('theme');
                $table->integer('price');
                $table->text('description');
                $table->string('status')->default('Новая');
                $table->text('text')->nullable();
                $table->dateTime('publicationDate');

                // заказчик
                $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                // исполнитель
                $table->foreignId('executor_id')
                    ->nullable()
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
