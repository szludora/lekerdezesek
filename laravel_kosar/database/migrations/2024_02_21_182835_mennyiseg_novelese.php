<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER mennyisegNovelese AFTER DELETE ON baskets
        FOR EACH ROW
        BEGIN
            UPDATE products SET quantity = quantity + 1 WHERE item_id = OLD.item_id;
        END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS mennyisegNovelese");
    }
};
