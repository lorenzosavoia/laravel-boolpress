<?php

use Faker\Generator as Faker;
use illuminate\Support\Str;
use App\Model\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 30; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->sentence(6, true);
            $newPost->content = $faker->paragraph(6, true);
            $newPost->slug = Str::slug($newPost->title , '-' . $i, '-');
            $newPost->save();
        }
    }
}
