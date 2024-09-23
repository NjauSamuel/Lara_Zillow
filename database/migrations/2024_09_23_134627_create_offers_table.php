<?php

use App\Models\Listing;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(   // foreignIdFor accepts two arguments. 
                Listing::class,
                'listing_id' // This second column argument is optional, Laravel provides a default.
            )->constrained('listings'); // Referential integrity. 
            
            $table->foreignIdFor(
                User::class,
                'bidder_id' // This second column argument is optional, Laravel provides a default.
            )->constrained('users');

            $table->unsignedInteger('amount'); // Unsigned means we only accept positive values. 

            $table->timestamp('accepted_at')->nullable();
            
            $table->timestamp('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
