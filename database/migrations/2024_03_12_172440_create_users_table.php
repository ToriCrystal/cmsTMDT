<?php

use App\Enums\User\AutoNotification;
use App\Enums\User\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('code', 50);
            $table->string('slug')->unique();
            $table->char('phone', 20)->unique();
            $table->string('fullname');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->char('email', 100)->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('active')->default(1);
            $table->text('avatar')->nullable();
            $table->text('feature_image')->nullable();
            $table->text('address')->nullable();
            $table->string('password');
            $table->text('device_token')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->char('longitude')->nullable();
            $table->char('latitude')->nullable();
            $table->tinyInteger('roles')->default(UserRole::Customer->value);
            $table->integer('notification_preference')->default(AutoNotification::Auto->value);
            $table->string('token_get_password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas')
                ->onDelete('SET NULL');
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
