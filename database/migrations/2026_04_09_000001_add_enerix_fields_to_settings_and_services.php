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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_tagline')->nullable()->after('hero_subtitle');
            $table->string('hero_highlight')->nullable()->after('hero_tagline');
            $table->text('hero_description')->nullable()->after('hero_highlight');
            $table->string('hero_image_main')->nullable()->after('hero_description');
            $table->string('hero_image_top')->nullable()->after('hero_image_main');
            $table->string('hero_image_mid')->nullable()->after('hero_image_top');
            $table->string('hero_image_bot')->nullable()->after('hero_image_mid');
            $table->string('whatsapp_number')->nullable()->after('contact_phone');
            $table->string('why_title')->nullable()->after('cta_button_link');
            $table->text('why_subtitle')->nullable()->after('why_title');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('image');
            $table->json('features')->nullable()->after('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_tagline',
                'hero_highlight',
                'hero_description',
                'hero_image_main',
                'hero_image_top',
                'hero_image_mid',
                'hero_image_bot',
                'whatsapp_number',
                'why_title',
                'why_subtitle',
            ]);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['icon', 'features']);
        });
    }
};
