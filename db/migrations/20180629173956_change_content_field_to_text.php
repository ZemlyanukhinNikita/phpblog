<?php


use Phinx\Migration\AbstractMigration;

class ChangeContentFieldToText extends AbstractMigration
{
    /**
     * Migrate up.
     */
    public function up()
    {
        $news = $this->table('news');
        $news->changeColumn('content', 'text')->save();
    }

    /**
     * Migrate down.
     */
    public function down()
    {
        $news = $this->table('news');
        $news->changeColumn('content', 'string')->save();
    }
}
