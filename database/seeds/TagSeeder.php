<?php

use illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Model\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'animals',
            'car',
            'food',
            'design',
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-'); //sostituzione di caraterri per slug unique
            $newTag->save();
        }
    }
}
