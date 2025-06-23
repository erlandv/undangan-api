<?php

use Core\Database\Migration;
use Core\Database\Schema;
use Core\Database\Table;

return new class implements Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Table $table) {
            $table->addColumn(function (Table $table) {

                $table->integer('owner_id')->nullable();
            });

            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Kembalikan seperti semula.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Table $table) {
            $table->dropForeign('owner_id');
            $table->dropColumn('owner_id');
        });
    }
};
