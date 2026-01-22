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
        Schema::table('devices', function (Blueprint $table) {
            $table->string('port')->nullable()->after('url_stream');
            $table->string('websocket_port')->nullable()->after('port');
            $table->string('tls_mqtt_url')->nullable()->after('websocket_port');
            $table->string('tls_websocket_url')->nullable()->after('tls_mqtt_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            //
        });
    }
};
