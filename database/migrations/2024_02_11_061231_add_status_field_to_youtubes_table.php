<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('youtubes', function (Blueprint $table) {
            $table->string('status')->after('url')->default('inactive');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('youtubes', function (Blueprint $table) {
            $table->dropColumn('status');

        });
    }
};
