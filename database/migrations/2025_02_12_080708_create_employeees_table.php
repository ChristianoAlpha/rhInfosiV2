<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeesTable extends Migration
{
    public function up()
    {
        Schema::create('employeees', function (Blueprint $table) {
            $table->id();
            $table->string('employmentStatus')->default('active');
            $table->string('fullName');
            $table->string('address');
            $table->string('mobile');
            $table->date('birth_date');
            $table->string('nationality');
            $table->enum('gender', ['Masculino', 'Feminino']);
            $table->date('entry_date');
            $table->string('phone_code')->nullable();
            $table->string('bi')->unique();
            $table->string('biPhoto')->nullable();
            $table->string('processNumber')->nullable();
            $table->string('email')->unique();
            $table->string('iban', 25)->nullable();
            $table->string('photo')->nullable();
            $table->string('academicLevel')->nullable();
            $table->string('driverLicense')->nullable();
            $table->unsignedBigInteger('departmentId')->nullable();
            $table->foreign('departmentId')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('positionId')->nullable();
            $table->foreign('positionId')->references('id')->on('positions');
            $table->unsignedBigInteger('specialtyId')->nullable();
            $table->foreign('specialtyId')->references('id')->on('specialties');
            $table->unsignedBigInteger('roleId')->nullable();
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('employeeTypeId')->nullable();
            $table->foreign('employeeTypeId')->references('id')->on('employee_types');
            $table->unsignedBigInteger('employeeCategoryId')->nullable();
            $table->foreign('employeeCategoryId')->references('id')->on('employee_categories')->onDelete('set null');
            $table->unsignedBigInteger('courseId')->nullable(); 
            $table->foreign('courseId')->references('id')->on('courses')->onDelete('set null');
            $table->unsignedBigInteger('vehicleId')->nullable();
            $table->foreign('vehicleId')->references('id')->on('vehicles')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employeees');
    }
}


