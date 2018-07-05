<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     * Write your database seeder using this method.
     */
    public function run()
    {
        $users = $this->table('users');
        $users->truncate();

        $data = [];
        $data[] = [
            'login' => 'admin',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'isAdmin' => 1
        ];

        $data[] = [
            'login' => 'mortal',
            'password' => password_hash('qwerty', PASSWORD_DEFAULT),
            'isAdmin' => 0
        ];
        $users->insert($data)->save();

    }
}
