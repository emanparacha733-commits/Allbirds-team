<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'first_name')) {
                $table->string('first_name');
            }
            if (!Schema::hasColumn('orders', 'last_name')) {
                $table->string('last_name');
            }
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email');
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->string('address');
            }
            if (!Schema::hasColumn('orders', 'city')) {
                $table->string('city');
            }
            if (!Schema::hasColumn('orders', 'state')) {
                $table->string('state');
            }
            if (!Schema::hasColumn('orders', 'zip')) {
                $table->string('zip');
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'customer_email',
                'address',
                'city',
                'state',
                'zip',
                'phone',
                'total',
                'status',
            ]);
        });
    }
};