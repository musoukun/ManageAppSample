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
        Schema::create('Employee', function (Blueprint $table) {
            $table->string('staffCode', 4)->default('')->comment('スタッフコード');
            $table->string('staffFirstName', 30)->default('')->comment('スタッフの名');
            $table->string('staffLastName', 30)->default('')->comment('スタッフの姓');
            $table->string('staffFirstNameKana', 30)->nullable()->default('')->comment('スタッフの名（カナ）');
            $table->string('staffLastNameKana', 30)->nullable()->default('')->comment('スタッフの姓（カナ）');
            $table->string('sex', 1)->nullable()->default('')->comment('性別');
            $table->string('departmentCode', 5)->nullable()->default('')->comment('部門コード');
            $table->string('unitCode', 4)->nullable()->default('')->comment('ユニットコード');
            $table->decimal('travelCost', 19, 4)->nullable()->default(0)->comment('旅行費');
            $table->string('birthdate', 8)->nullable()->default('')->comment('生年月日');
            $table->string('postcode', 7)->nullable()->default('')->comment('郵便番号');
            $table->string('address', 200)->default('')->comment('住所');
            $table->string('tel', 21)->default('')->comment('電話番号');
            $table->string('mail', 254)->default('')->comment('メールアドレス');
            $table->string('remark', 1000)->nullable()->default('')->comment('備考');
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
        Schema::dropIfExists('Employee');
    }
};
