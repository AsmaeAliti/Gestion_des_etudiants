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
            $table->integer('organization_id')->nullable(); // المؤسسة الدّامجة 
            $table->string('disability_type')->nullable(); // نوع الاعاقة
            $table->enum('disability_degree', ['0', '1', '2', '3'])->default('0')->nullable(); // درجتها  0:خفيفة 1:متوسطة 2:عميقة 3:متطورة 
            $table->enum('companian_need', ['N', 'Y'])->default('N'); // الحاجة إلى مرافق

            $table->integer('room_service_hours')->nullable();
            $table->string('cognitive_services_type')->nullable();
            $table->string('medical_intervention')->nullable();
            $table->string('medical_intervention_details')->nullable();
            $table->boolean('benefits_from_adaptation')->default(false);
            $table->string('adaptation_type')->nullable();
            $table->enum('active', ['0', '1'])->default('1')->nullable(); // 0: غير نشيط 1: نشيط 
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
