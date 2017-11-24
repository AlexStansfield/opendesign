<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('github_id');
            $table->string('name', 100);
            $table->text('description');
            $table->string('repo', 255);
            $table->string('link', 255);
            $table->string('type', 20);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('github_id');
            $table->string('username', 100);
            $table->text('github_token');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('brief', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title', 100);
            $table->text('description');
            $table->string('type', 20);
            $table->string('status', 20);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('project_id')->references('id')->on('project');
        });

        Schema::create('brief_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brief_id')->unsigned();
            $table->string('file_name');
            $table->dateTime('created_at');
            $table->foreign('brief_id')->references('id')->on('brief');
        });

        Schema::create('design', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('description');
            $table->string('file_name');
            $table->integer('brief_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('status', 100);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('brief_id')->references('id')->on('brief');
        });

        Schema::create('design_asset', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('design_id')->unsigned();
            $table->string('file_name');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('design_id')->references('id')->on('design');
        });

        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('design_id')->unsigned();
            $table->integer('comment')->unsigned();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('design_id')->references('id')->on('design');
        });

        Schema::create('like', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('design_id')->unsigned();
            $table->dateTime('created_at');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('design_id')->references('id')->on('design');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'project', 'user', 'brief', 'brief_media', 'design', 'design_asset', 'comment', 'like'
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
}
