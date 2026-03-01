<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('colocation_memberships', function (Blueprint $table) {
        $table->timestamp('left_at')->nullable(); 
    });
}

public function down()
{
    Schema::table('colocation_memberships', function (Blueprint $table) {
        $table->dropColumn('left_at');
    });
}
};
