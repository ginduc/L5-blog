<?php

class PostResourceTest extends TestCase
{
    public function testPOSTandGET()
    {
        $res = $this->call('POST', '/api/posts',
            ['post_title' => 'Lorem Ipsum',
             'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
             'post_date' => new DateTime(),
             'post_author' => 1]);
        $data = json_decode($res->getContent());
        $this->assertTrue($data->id > 0);

        $this->get('/api/posts/' . $data->id)
             ->seeJsonStructure([
                 'id',
                 'post_title',
                 'post_content',
                 'post_date',
                 'post_author',
                 'created_at'
             ]);
    }

    public function testIndex()
    {
        $this->get('/api/posts')
            ->seeJsonStructure([
               'posts'
            ]);
    }
}
