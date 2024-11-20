<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    public function up()
{
    Schema::create('stats', function (Blueprint $table) {
        $table->id();
        
        // Foreign keys
        $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
        $table->foreignId('term_id')->constrained('terms')->onDelete('cascade');
        
        // Data columns
        $table->decimal('revenue', 20, 5);   // Updated precision for revenue
        $table->date('event_date');           // Event date (YYYY-MM-DD)
        $table->tinyInteger('event_hour');    // Event hour (0-23)
        $table->timestamp('monetization_date')->nullable();    // Monetization date

        // Timestamps
        $table->timestamps();                // created_at, updated_at

        // Indexes
         // Composite index for campaign_id and revenue (for 'index()' method)
        $table->index(['campaign_id', 'revenue'], 'idx_campaign_id_revenue');

        // Composite index for event_date, event_hour, and revenue (for 'show()' method)
        $table->index(['event_date', 'event_hour', 'revenue'], 'idx_event_date_hour_revenue');

        // Composite index for campaign_id, term_id, and revenue (for 'publishers()' method)
        $table->index(['campaign_id', 'term_id', 'revenue'], 'idx_campaign_term_revenue');
    });
}


    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
