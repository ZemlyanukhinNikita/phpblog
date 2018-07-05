<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{

    /**
     * Migrate up.
     */
    public function up()
    {
        $users = $this->table('users');
        $users
            ->addColumn('login', 'string', ['limit' => 20])
            ->addColumn('password', 'string')
            ->addColumn('isAdmin', 'boolean', ['default' => false])
            ->addIndex(['login'], ['unique' => true])
            ->save();
    }

    /**
     * Migrate down.
     */
    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
