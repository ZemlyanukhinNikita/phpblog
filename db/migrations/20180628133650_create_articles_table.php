<?php


use Phinx\Migration\AbstractMigration;

class CreateArticlesTable extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $news = $this->table('news');
        $news
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('content', 'string')
            ->addColumn('preview_image_id', 'integer', ['null' => true])
            ->addForeignKey('preview_image_id', 'preview_images', ['id'],
                ['constraint' => 'preview_images_foreign_key'])
            ->save();
    }
}
