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
        Schema::create('stock_in_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')->references('id')->on('divisions');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->decimal('quantity', 14, 2)->default(0.00);
            $table->decimal('previous_quantity', 14, 2)->default(0.00);

            $table->string('po_no')->nullable();
            $table->date('po_date')->nullable();
            $table->date('receiving_po_date')->nullable();


            $table->string('indent_no')->nullable();
            $table->date('indent_date')->nullable();

            $table->enum('type', ['In', 'Out']);
            $table->enum('return', ['Yes', 'No'])->default('No');
            $table->date('issued_date')->nullable();
            $table->date('return_date')->nullable();
            $table->text('description')->nullable();
            $table->string('attachment_path')->nullable();
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
        Schema::dropIfExists('stock_in_outs');
    }
};
