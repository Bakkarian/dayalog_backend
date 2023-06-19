<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //From means the user who has what to transport
            $table->foreignIdFor(User::class, 'from')->constrained('users')->nullable();
            //From means the user who receives what has been bought
            $table->foreignIdFor(User::class, 'to')->constrained('users');
            $table->string('patasente_purchase_order_id');
            $table->string('reference');
            $table->string('notes');
            $table->enum('status',[
                'pending',
                'in_progress',
                'completed'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
