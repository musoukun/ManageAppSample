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
        Schema::create('LoginUser', function (Blueprint $table) {
            $table->string('loginUserId', 50)->default('')->comment('ログインユーザーID');
            $table->string('staffCode', 4)->default('')->comment('スタッフコード');
            $table->string('displayName', 100)->default('')->comment('表示名');
            $table->string('mail', 254)->default('')->comment('メールアドレス');
            $table->string('password', 50)->default('')->comment('パスワード');
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
        Schema::dropIfExists('LoginUser');
    }
};
