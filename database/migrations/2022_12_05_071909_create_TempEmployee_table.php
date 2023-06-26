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
        Schema::create('TempEmployee', function (Blueprint $table) {
            $table->string('staffCode', 4)->default('')->comment('スタッフコード');
            $table->string('staffFirstName', 40)->default('')->comment('スタッフの名');
            $table->string('staffLastName', 40)->default('')->comment('スタッフの姓');
            $table->string('staffFirstNameKana', 40)->default('')->comment('スタッフの名（カナ）');
            $table->string('staffLastNameKana', 40)->default('')->comment('スタッフの姓（カナ）');
            $table->string('sex', 1)->default('')->comment('性別');
            $table->string('departmentCode', 5)->default('')->comment('部門コード');
            $table->string('sectionCode', 1)->default('')->comment('課コード');
            $table->string('unitCode', 1)->default('')->comment('係コード');
            $table->string('companyCode', 10)->default('')->comment('会社コード');
            $table->string('companyName', 137)->default('')->comment('会社名');
            $table->string('contractFrom', 8)->default('')->comment('契約開始日');
            $table->string('contractTo', 8)->default('')->comment('契約終了日');
            $table->decimal('contractUnitPrice', 19, 4)->default(0)->comment('契約単価');
            $table->string('travelCostType', 1)->default('')->comment('交通費タイプ');
            $table->decimal('travelCost', 19, 4)->default(0)->comment('交通費');
            $table->string('remark', 1000)->default('')->comment('備考');
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
        Schema::dropIfExists('TempEmployee');
    }
};
