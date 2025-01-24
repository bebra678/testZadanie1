<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('article')->unique();
            $table->string('name');
            $table->enum('status', ['available', 'unavailable']);
            $table->json('data');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('products')->insert([
            [
                'article' => 'P001',
                'name' => 'Product 1',
                'status' => 'available',
                'data' => json_encode(['color' => 'red', 'size' => 'M']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article' => 'P002',
                'name' => 'Product 2',
                'status' => 'available',
                'data' => json_encode(['color' => 'blue', 'size' => 'L']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article' => 'P003',
                'name' => 'Product 3',
                'status' => 'unavailable',
                'data' => json_encode(['color' => 'green', 'size' => 'S']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article' => 'P004',
                'name' => 'Product 4',
                'status' => 'available',
                'data' => json_encode(['color' => 'yellow', 'size' => 'XL']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
