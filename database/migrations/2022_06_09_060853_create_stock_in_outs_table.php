<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_in_outs', function (Blueprint $table) {
            $table->id();

            // stockitem
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            // poid
            $table->unsignedBigInteger('purchase_order_id')->nullable();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

            $table->unsignedBigInteger('scheme_id')->nullable();;
            $table->foreign('scheme_id')->references('id')->on('schemes');

            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->date('delivery_chalan_receiving_date')->nullable();
            $table->string('delivery_chalan_number')->nullable();
            $table->date('delivery_chalan_date')->nullable();
            $table->string('inspection_certification_number')->nullable();
            $table->date('inspection_certification_date')->nullable();
            $table->string('receiving_person_name')->nullable();
            $table->string('receiving_person_designation')->nullable();
            $table->string('from_supplier_person')->nullable();
            $table->string('from_supplier_designation')->nullable();
            $table->decimal('quantity', 14, 2)->default(0.00);
            $table->decimal('balance', 14, 2)->default(0.00);
            $table->string('indent_no')->nullable();
            $table->date('indent_date')->nullable();
            $table->string('scheme_name')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_designation')->nullable();
            $table->string('received_by_name')->nullable();
            $table->string('received_by_designation')->nullable();
            $table->enum('chalan_type', ['PurchaseOrder', 'Indent','Scheme','IndentStockOut']);
            $table->enum('type', ['Credit', 'Debit']);
            $table->enum('return', ['Yes', 'No'])->default('No');
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
