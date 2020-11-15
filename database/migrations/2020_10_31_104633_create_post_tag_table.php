<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     * Migracja, tabela sortująca konwencja Laravel, bierzemy dwie tabele, które ze sobą chcemy skojarzyć
     * stare tabele są nazwane liczba mnogą a nowa juz nazwana jest liczbą pojedynczą i alfabetycznie ustawiamy.
     * post_tag
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            //tu można by było zakończyć
            //ustawienie kluczy obcych i usuwanie kaskadowe
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
            //uniemożliwienie dodania tego samego rekordu
            //uwaga na nawiasy klamrowe!!!
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
