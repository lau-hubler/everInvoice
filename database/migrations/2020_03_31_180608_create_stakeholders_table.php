<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->string('name',80);
            $table->string('surname',80)->nullable();
            $table->string('company',80)->nullable();
            $table->boolean('is_company');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('document');
            $table->string('email',120)->nullable();
            $table->string('mobile', 30);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['document_type_id', 'document']);
            $table->foreign('document_type_id')->references('id')->on('document_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stakeholders');
    }
}
