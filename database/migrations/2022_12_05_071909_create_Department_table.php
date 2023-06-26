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
        Schema::create('Department', function (Blueprint $table) {
            $table->string('departmentCode', 5)->default('')->comment('部門コード');
            $table->string('departmentName', 50)->default('')->comment('部門名');
            $table->string('departmentNameKana', 50)->default('')->comment('部門名（カナ）');
            $table->string('sectionCode', 5)->default('')->comment('課コード');
            $table->string('sectionName', 50)->default('')->comment('課名');
            $table->string('sectionNameKana', 50)->default('')->comment('課名（カナ）');
            $table->string('unitCode', 5)->default('')->comment('係コード');
            $table->string('unitName', 50)->default('')->comment('係名');
            $table->string('unitNameKana', 50)->default('')->comment('係名（カナ）');
            $table->timestamps(); // created_at, updated_at カラムの追加
            $table->softDeletes(); // deleted_at カラムの追加
        });
        // 部＝department、課＝section  係＝Unit
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Department');
    }
};
