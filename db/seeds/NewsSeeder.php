<?php


use Phinx\Seed\AbstractSeed;

class NewsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     * Write your database seeder using this method.
     */
    public function run()
    {
        $news = $this->table('news');
        $news->truncate();

        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'title' => $faker->text(40) . ' Топ - ' . $i,
                'content' => $faker->realText(400),
                'preview_image_slug' => $faker->imageUrl('180', '120'),
                'views' => 10 - $i,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $data[] = [
                'title' => $faker->text(20) . ' Топ - ' . (5 + $i),
                'content' => $faker->realText(400),
                'views' => 10 - (5 + $i),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        $news->insert($data)->save();
    }
}
