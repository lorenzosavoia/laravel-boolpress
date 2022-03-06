<?php

use Illuminate\Database\Seeder;
use App\Model\Post;
use App\Model\Tag;
class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags= Tag::all(); //richiamo tutti i tag e li salvo in una variabile

        foreach ($tags as $tag) {
            $posts = Post::inRandomOrder()->limit(6)->get();
            $tag->posts()->attach($posts); //attacco i post ai mie tag selezionati randomicamente nella riga prima
        }
    }
}
