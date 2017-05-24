<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m170523_170522_create_article_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id'=> $this->integer(),
        ]);
        //create index for column 'user_id'
        $this->createIndex(
                'tag_article_article_id',
                'article_tag',
                'article_id'
                );
        //add foreign key for table 'user'
        $this->addForeignKey(
                'tag_article_aticle_id',
                'article_tag',
                'article_id',
                'article',
                'id',
                'CASCADE'
                );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_tag');
    }
}
