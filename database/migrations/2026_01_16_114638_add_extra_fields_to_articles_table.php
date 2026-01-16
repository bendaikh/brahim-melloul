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
        Schema::table('articles', function (Blueprint $table) {
            $table->decimal('remise', 5, 2)->default(0)->after('prix_brut');
            $table->decimal('prix_net', 15, 2)->default(0)->after('remise');
            $table->decimal('prix_achat', 15, 2)->default(0)->after('prix_net');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null')->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn(['remise', 'prix_net', 'prix_achat', 'brand_id']);
        });
    }
};
