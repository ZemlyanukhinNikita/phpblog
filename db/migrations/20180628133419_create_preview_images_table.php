<?php


use Phinx\Migration\AbstractMigration;

class CreatePreviewImagesTable extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $images = $this->table('preview_images');
        $images
            ->addColumn('slug', 'string')
            ->addIndex(['slug'],['unique' => true])
            ->save();
    }
}
