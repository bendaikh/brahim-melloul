<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique(); // e.g., BC-2026-0001
            $table->enum('type', [
                'sale_order', 
                'delivery_note', 
                'sale_invoice', 
                'purchase_order', 
                'purchase_receipt', 
                'client_credit_note', 
                'supplier_credit_note'
            ]);
            $table->date('date');
            
            $table->foreignId('tier_id')->constrained('tiers')->onDelete('restrict');
            $table->foreignId('created_by')->constrained('users');
            
            $table->decimal('total_ht', 15, 2)->default(0);
            $table->decimal('total_tva', 15, 2)->default(0);
            $table->decimal('total_ttc', 15, 2)->default(0);
            
            $table->enum('status', ['draft', 'validated', 'cancelled', 'completed', 'partial'])->default('draft');
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
