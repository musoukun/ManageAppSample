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
        Schema::create('Company', function (Blueprint $table) {
            $table->string('companyCode', 10)->default('')->comment('会社コード');
            $table->string('companyName', 30)->default('')->comment('会社名');
            $table->string('companyDetail', 500)->default('')->comment('会社詳細');
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
        Schema::dropIfExists('Company');
    }
};
