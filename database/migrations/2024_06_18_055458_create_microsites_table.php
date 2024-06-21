<?php

use App\Constants\Currency;
use App\Constants\DocumentTypes;
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
        Schema::create('microsites', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->string('name', 100);
            $table->enum('document_type', array_column(DocumentTypes::cases(), 'name'));
            $table->string('document_number', 20);
            $table->string('logo');
            $table->foreignId('category_id')->constrained();
            $table->enum('currency', array_column(Currency::cases(), 'name'));
            $table->string('site_type',40);
            $table->timestamp('enabled_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('microsites');
    }
};
