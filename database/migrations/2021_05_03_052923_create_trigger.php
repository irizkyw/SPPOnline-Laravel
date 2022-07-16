<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER total_spp AFTER INSERT ON `pembayaran` FOR EACH ROW
                BEGIN
                    UPDATE spp SET jumlah= (jumlah+ NEW.jumlah_bayar) WHERE id= (NEW.spp_id);
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('DROP TRIGGER `total_spp`');
    }
}
