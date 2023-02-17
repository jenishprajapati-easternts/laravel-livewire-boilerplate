<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index()->comment('AUTO_INCREMENT');
            $table->enum('user_type', [0, 1, 2])->default('0')->comment('0-admin; 1-author; 2-user'); // admin, author, user
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('mobile_no', 255)->nullable();
            $table->enum('gender', ['0', '1'])->nullable()->index()->comment('0 - Female, 1 - Male');
            $table->date('dob')->nullable();
            $table->unsignedInteger('country_id')->index()->nullable()->comment('countries table id');
            $table->unsignedInteger('state_id')->index()->nullable()->comment('states table id');
            $table->unsignedInteger('city_id')->index()->nullable()->comment('cities table id');
            $table->string('address', 500)->nullable();
            $table->enum('status', ['0', '1'])->index()->comment('0 - Inactive, 1 - Active');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable()->comment('Users table ID');
            $table->unsignedInteger('updated_by')->nullable()->comment('Users table ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
