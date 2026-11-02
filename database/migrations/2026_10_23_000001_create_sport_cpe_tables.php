<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations for SPORT.CPE Database Term Project.
     */
    public function up(): void
    {
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password_hash', 255);
            $table->string('phone', 20);
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->timestamps();
        });

        // 2. Member Profiles (1:1 with users)
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->foreignId('user_id')->unique()->constrained('users', 'user_id')->cascadeOnDelete();
            $table->enum('tier', ['Standard', 'Silver Athlete', 'Gold Athlete'])->default('Standard');
            $table->integer('loyalty_points')->default(0);
            $table->text('shipping_address');
        });

        // 3. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->string('description', 255)->nullable();
        });

        // 4. Promotions Table (Features 3.1 & 3.2)
        Schema::create('promotions', function (Blueprint $table) {
            $table->id('promotion_id');
            $table->string('code', 30)->unique()->nullable();
            $table->string('title', 100);
            $table->enum('promo_type', ['discount_percentage', 'buy_x_get_y']);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->integer('buy_quantity')->default(0);
            $table->integer('free_quantity')->default(0);
            $table->decimal('min_order_amount', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->date('start_date');
            $table->date('end_date');
        });

        // 5. Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions', 'promotion_id')->nullOnDelete();
            $table->string('name', 150);
            $table->string('brand', 60);
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('order_code', 30)->unique();
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions', 'promotion_id')->nullOnDelete();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('b2g1_discount', 10, 2)->default(0);
            $table->decimal('coupon_discount', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->decimal('net_paid', 10, 2);
            $table->string('payment_method', 50);
            $table->enum('order_status', ['Pending', 'Paid', 'Shipped', 'Delivered', 'Cancelled'])->default('Paid');
            $table->text('shipping_address_snapshot');
            $table->timestamp('order_date')->useCurrent();
        });

        // 7. Order Items Table (M:N with Anti-Anomaly frozen price)
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('quantity');
            $table->decimal('unit_price_at_purchase', 10, 2);
            $table->boolean('is_free_item')->default(false);
            $table->decimal('subtotal', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('member_profiles');
        Schema::dropIfExists('users');
    }
};
