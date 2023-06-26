<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\DB;

trait RefreshDatabaseLite
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('migrate');

            DB::statement('set foreign_key_checks = 0');

            $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

            foreach ($tables as $table) {
                if (in_array($table, [
                    'failed_jobs',
                    'jobs',
                    'migrations'
                ])) {
                    continue;
                }

                DB::table($table)->truncate();
            }

            DB::statement('set foreign_key_checks = 1');

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }
}