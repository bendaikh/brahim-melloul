<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Drop the foreign key constraint first if it exists
            if (Schema::hasColumn('articles', 'brand_id')) {
                $table->dropForeign(['brand_id']);
                $table->dropColumn('brand_id');
            }
            
            // Add new fields
            $table->string('code')->nullable()->after('reference');
            $table->string('image')->nullable()->after('slug');
            $table->string('classment')->nullable()->after('description');
            $table->decimal('prix_brut', 15, 2)->default(0)->after('classment');
            $table->string('block')->nullable()->after('prix_brut');
            $table->string('diametre')->nullable()->after('block');
            $table->decimal('representant_prix', 15, 2)->default(0)->after('diametre');
            $table->string('reference_equivalent')->nullable()->after('representant_prix');
            $table->text('designation')->nullable()->after('reference_equivalent');
            
            // Add foreign keys for car_logo and representant
            $table->foreignId('car_logo_id')->nullable()->constrained('car_logos')->onDelete('set null');
            $table->foreignId('representant_id')->nullable()->constrained('representants')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['car_logo_id']);
            $table->dropForeign(['representant_id']);
            $table->dropColumn([
                'code', 'image', 'classment', 'prix_brut', 'block', 
                'diametre', 'representant_prix', 'reference_equivalent', 
                'designation', 'car_logo_id', 'representant_id'
            ]);
            
            // Re-add brand_id
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
