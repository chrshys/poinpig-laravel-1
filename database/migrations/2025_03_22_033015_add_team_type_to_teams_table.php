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
        Schema::table('teams', function (Blueprint $table) {
            $table->enum('team_type', ['family', 'classroom'])->default('family')->after('personal_team');
            $table->text('description')->nullable()->after('team_type');
            $table->json('settings')->nullable()->after('description');
            $table->string('educational_grade')->nullable()->after('settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['team_type', 'description', 'settings', 'educational_grade']);
        });
    }
};
