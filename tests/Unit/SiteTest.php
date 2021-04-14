<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class SiteTest extends TestCase
{

    public function test_create_user(){
        $user = User::factory()->create();
        User::factory()->create();
        $this->assertDatabaseCount('users', 2);
        return $user;
    }

    /**
     * @depends test_create_user
     */
    public function test_create_post($user){
        $post = Post::create([
            'title'=>'TestTitle',
            'text'=>'TestText',
            'desc' => 'TestDesc',
            'user_id'=> $user->id,
        ]);
        $this->assertEquals('TestText', $user->posts()->where('title', 'TestTitle')->first()->text);
        return $post;
    }

    /**
     * @depends test_create_user
     * @depends test_create_post
     */
    public function test_create_comment($user, $post){
        $comment = Comment::create([
            'text' => 'TestComment',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $this->assertEquals('TestComment', $post->comments()->where('user_id', $user->id)->first()->text);
        return $comment;
    }

    /**
     * @depends test_create_post
     */
    public function test_default_name_for_deleted_user($post){
        $user = User::factory()->create();
        Comment::create([
            'text' => 'CommentFromDeletedUser',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $user->delete();

        $this->assertEquals( 'Аноним', $post->comments()->where('text','CommentFromDeletedUser')->first()->user->name);
    }

}
