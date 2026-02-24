<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section');   // hero, s2_card_1, s4_card_1, s6_card_1, etc.
            $table->string('key');       // image, heading, subheading, button_link, text
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['section', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};