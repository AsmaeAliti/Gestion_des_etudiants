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
        Schema::create('inclusive_organization', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name'); // الاسم
            $table->integer('female_count'); // مجموع الإناث
            $table->integer('male_count'); // مجموع الذكور
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inclusive_organization');
    }
};
