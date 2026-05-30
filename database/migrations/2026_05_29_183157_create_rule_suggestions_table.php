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
        Schema::create('rule_suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('pattern');
            $table->integer('occurrences')->default(0);
            $table->foreignId('suggested_transaction_type_id')
                ->nullable()
                ->constrained('transaction_types')
                ->nullOnDelete();
            $table->boolean('is_reviewed')->default(false);
            $table->boolean('is_accepted')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'pattern']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_suggestions');
    }
};
