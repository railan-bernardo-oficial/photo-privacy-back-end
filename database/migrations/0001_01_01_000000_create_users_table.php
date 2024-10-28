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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("nickname")->nullable(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("phone")->nullable(true);
            $table->string("cover_url")->nullable(true);
            $table->string("avatar_url")->nullable(true);
            $table->string("facebook")->nullable(true);
            $table->string("instagram")->nullable(true);
            $table->string("tiktok")->nullable(true);
            $table->string("x")->nullable(true);
            $table->date("birthday")->nullable(true);
            $table->enum('role', ['creator', 'subscriber']);
            $table->text('bio')->nullable(true);
            $table->string('content_category')->nullable(true);
            $table->integer('total_followers')->default(0);
            $table->integer('content_count')->default(0);
            $table->decimal('subscription_price', 8, 2)->nullable(true);
            $table->boolean('is_verified')->default(false)->nullable(true);
            $table->enum('subscription_status', ['active', 'cancelled', 'expired'])->nullable(true);
            $table->timestamp('subscription_ends_at')->nullable(true);
            $table->unsignedBigInteger('is_subscribed_to')->nullable(true);
            $table->json('social_links')->nullable(true);
            $table->timestamp('last_login_at')->nullable(true);
            $table->enum('status', ['active', 'suspended', 'banned'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
