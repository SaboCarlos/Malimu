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
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->integer('age');
            $table->enum('gender', ['masculino', 'femenino']);
            $table->text('experience_summary');
            $table->string('availability');
            $table->string('contacts');
            $table->json('academic_qualifications'); // lista de qualificações e certificações
            $table->json('skills'); // lista de habilidades específicas
            $table->json('idiomas'); // lista de linguagem
            $table->string('area_of_experience');
            $table->enum('status', ['pendente', 'aceito', 'Recusado'])->default('pendente');
            $table->string('profile');
            $table->string('lat');
            $table->string('lng');
            $table->string('province');
            $table->string('district');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
