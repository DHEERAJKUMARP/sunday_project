<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('office_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->enum('day_type', ['work', 'leave', 'compOff']);
            $table->enum('leave_type', ['sick', 'vacation', 'personal'])->nullable();
            $table->enum('leave_duration', ['full', 'half'])->nullable();
            $table->date('comp_off_date')->nullable();
            $table->enum('comp_duration', ['full', 'half'])->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_entries');
    }
}
