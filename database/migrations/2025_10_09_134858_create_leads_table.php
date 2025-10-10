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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
           // Basic Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('designation')->nullable();

            // Lead Details
            $table->string('source')->nullable(); // e.g. Website, Referral
            $table->enum('status', ['New', 'Contacted', 'Qualified', 'Converted', 'Lost'])->default('New');
            $table->text('notes')->nullable();

            // Assignment & Ownership
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            // Follow-up & Reminder
            $table->date('follow_up_date')->nullable();
            $table->time('reminder_time')->nullable();

            // Conversion
            $table->boolean('is_converted')->default(false);
            $table->dateTime('converted_at')->nullable();
            // $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');

            // Timestamps & Soft Delete
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
