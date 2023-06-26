<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Code', function (Blueprint $table) {
            $table->string('code', 4)->default('')->comment('コード');
            $table->string('codeKey', 50)->default('')->comment('コードキー');
            $table->string('codeValue', 255)->default('')->comment('コード値');
            $table->timestamps(); // created_at, updated_at カラムの追加
            $table->softDeletes(); // deleted_at カラムの追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Code');
    }
};
