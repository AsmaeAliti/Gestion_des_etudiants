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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // ر.ت (ID)
                  
            $table->string('first_name'); // الاسم
            $table->string('last_name');  // النسب
            $table->enum('gender', ['ذكر', 'أنثى']); // الجنس
              
            $table->date('birth_date')->nullable(); // تاريخ الازدياد
            $table->string('birth_place')->nullable();  // مكان الازدياد

            $table->integer('age')->nullable(); // السن
            $table->string('massar_code')->unique(); // رمز مسار
            $table->string('education_level'); // المستوى الدراسي
            $table->string('inclusive_teacher')->nullable(); // الاستاذ الدامج
            $table->integer('Inclusive_organization')->nullable(); // المؤسسة الدّامجة 
            $table->string('disability_type')->nullable(); // نوع الاعاقة
            $table->string('disability_degree')->nullable(); // درجتها
            $table->boolean('needs_assistant')->default(false); // الحاجة إلى مرافق

            $table->integer('room_service_hours')->nullable();
            $table->string('cognitive_services_type')->nullable();
            $table->string('medical_intervention')->nullable();
            $table->string('medical_intervention_details')->nullable();
            $table->boolean('benefits_from_adaptation')->default(false);
            $table->string('adaptation_type')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
