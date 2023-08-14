<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use carbon\carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('type',20)->unique();
            $table->string('identity',30)->unique();
            $table->timestamps();
        });
        DB::table('roles')->insert([
            [
                'type' => 'Admin',
                'identity' =>'admin',
                'created_at' => carbon::now()
            ],
            [
                'type' => 'Owner',
                'identity' =>'owner',
                'created_at' => carbon::now()
            ],
            [
                'type' => 'Sales Manager',
                'identity' =>'salesmanager',
                'created_at' => carbon::now()
            ],
            [
                'type' => 'Sales Man',
                'identity' =>'salesman',
                'created_at' => carbon::now()
            ]

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
