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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('products', 'type')) {
                $table->string('type')->nullable()->after('category');
            }
            if (!Schema::hasColumn('products', 'gender')) {
                $table->string('gender')->nullable()->after('type');
            }
            if (!Schema::hasColumn('products', 'color_name')) {
                $table->string('color_name')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('products', 'color_hex')) {
                $table->string('color_hex')->nullable()->after('color_name');
            }
            if (!Schema::hasColumn('products', 'sale_price')) {
                $table->decimal('sale_price', 8, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'is_new')) {
                $table->boolean('is_new')->default(false)->after('sale_price');
            }
            if (!Schema::hasColumn('products', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('is_new');
            }
            if (!Schema::hasColumn('products', 'on_sale')) {
                $table->boolean('on_sale')->default(false)->after('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'type',
                'gender',
                'color_name',
                'color_hex',
                'sale_price',
                'is_new',
                'is_featured',
                'on_sale'
            ]);
        });
    }
};