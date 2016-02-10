<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['id'=> 1, 'name' => 'Ned Flanders',
            'email' => 'ned@flanders.com', 'password' => 'password']);
        User::create(['id'=> 2, 'name' => 'Clancy Wiggum',
            'email' => 'clancy@wiggum.com', 'password' => 'password']);
    }

}

class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        Post::create(['id'=> 1, 'post_title' => 'Oh, my-diddly-eye!',
            'post_content' => 'Will you look at this place. And the price has been slashed repeatedly.',
            'post_date' => new DateTime(), 'post_author' => 1, 'post_status'=> 'published']);
        Post::create(['id'=> 2, 'post_title' => 'Yeah, right, pops',
            'post_content' => 'No jury in the world is going to convict a baby.',
            'post_date' => new DateTime(), 'post_author' => 2, 'post_status'=> 'draft']);
    }

}
