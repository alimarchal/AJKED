<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_supplier_firm')->nullable();
            $table->string('ajked_registration_no')->unique();
            //$table->text('product_id')->nullable();
            //$table->string('category')->nullable();
            $table->enum('status',['Active','NonActive','Blacklisted'])->default('Active');

//
//            $table->string('type')->nullable();
//            $table->string('category')->nullable();
//            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
