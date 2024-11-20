<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('utm_term')->unique();
            $table->timestamps();

            // Composite index for id and utm_term (for 'publishers()' method)
            $table->index(['id', 'utm_term'], 'idx_terms_id_utm_term');
        });
    }

    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
