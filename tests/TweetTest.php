<?php


final class TweetTest extends \PHPUnit\Framework\TestCase {

    private $test_tweet = [
        'id' => 1,
        'text' => 'Test Tweet',
        'user' => [
            'name' => 'Tom'
        ]
    ];

    public function testCanBeCreated() {
        $this->assertInstanceOf(\App\Models\Tweet::class, new \App\Models\Tweet((object) $this->test_tweet));
    }

    public function testTweetData() {
        $tweet = new \App\Models\Tweet((object) $this->test_tweet);
        $this->assertEquals($this->test_tweet['text'], $tweet->getText());
    }
}
