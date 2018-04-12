<?php namespace App\Services;


use App\Models\Tweet;
use Codebird\Codebird;

class Twitter
{
    private $callback;

    public function __construct($query, $callback)
    {
        // set bot callback
        // on tweet
        $this->callback = $callback;

        $cb = Codebird::getInstance();
        $cb->setToken(getenv('TWITTER_ACCESS_TOKEN'), getenv('TWITTER_ACCESS_SECRET'));

        // set the streaming callback in Codebird
        $cb->setStreamingCallback([$this, 'twitterCallback']);

        // start listening for tweets
        $cb->statuses_filter('track='.$query);
    }

    public function twitterCallback($tweet) {
        // gets called for every new streamed message
        // gets called with $tweet = NULL once per second

        if ($tweet !== null) {
            try { // ensure the content is a well formatted tweet
                $tweet = new Tweet($tweet);

                // notify the bot function of a new tweet
                call_user_func($this->callback, $tweet);
            } catch (\Exception $e) {

            }
            flush();
        }

        // return false to continue streaming
        // return true to close the stream

        return false;
    }
}
