<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->foreignId('article_id')->constrained()->onDelete('restrict');
            
            $table->integer('quantity')->default(0); // Current document quantity
            $table->integer('quantity_ordered')->default(0); // Original ordered quantity
            $table->integer('quantity_delivered')->default(0); // Cumulative delivered so far
            $table->integer('quantity_remaining')->default(0); // Reliquat
            
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('tva_percent', 5, 2)->default(20); // Default TVA
            
            $table->decimal('subtotal', 15, 2)->default(0);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_items');
    }
};
