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
        Schema::create('CrudGeneratorSetting', function (Blueprint $table) {
            $table->string('feature', 100)->default('');
            $table->string('tableName', 100)->default('');
            $table->string('columnName', 100)->default('');
            $table->string('logicalName', 100)->default('');
            $table->string('code', 100)->default('');
            $table->string('type', 100)->default('');
            $table->string('validation', 100)->default('');
            $table->string('tag', 100)->default('');
            $table->string('appName', 100)->default('');

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
        Schema::dropIfExists('CrudGeneratorSetting');
    }
};
