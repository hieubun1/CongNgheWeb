<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('computer_name'); // Tên máy tính
            $table->string('model'); // Model của máy tính
            $table->string('operating_system'); // Hệ điều hành
            $table->string('processor'); // Bộ xử lý
            $table->integer('memory'); // Bộ nhớ (GB)
            $table->boolean('available'); // Tình trạng sẵn có
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computers');
    }
}

