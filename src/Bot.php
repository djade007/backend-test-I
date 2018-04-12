<?php namespace App;

use App\Models\Tweet;
use App\Services\SpreadSheet;
use App\Services\Twitter;
use Garden\Cli\LogFormatter;

class Bot
{
    protected $query;
    protected $logger;
    protected $sheet;

    public function __construct($query)
    {
        $this->query = $query;
        $this->logger = new LogFormatter();
        $this->sheet = new SpreadSheet();
    }

    public function run() {
        // set the twitter query and callback function
        new Twitter($this->query, [$this, 'gotTweetEvent']);
    }

    // called when a tweet matches the hash tags
    public function gotTweetEvent(Tweet $tweet) {
        // ensure the criteria is met
        // the user's followers is between 1,000 to 50,000
        if($tweet->getUser()->getFollowersCount() >= 1000 && $tweet->getUser()->getFollowersCount() <= 50000) {
            $this->logger->success('Followers criteria met');
            $this->logTweet($tweet);
            // add to google sheet
            $this->sheet->add([$tweet->getUser()->getName(), $tweet->getUser()->getFollowersCount()]);
        } else {
            $this->logger->error('Followers criteria not met');
            $this->logTweet($tweet);
        }
    }

    protected function logTweet(Tweet $tweet) {
        $this->logger->message($tweet->getText());
        $this->logger->message("by " . $tweet->getUser()->getName());
        echo "------------------------------\n";
    }
}
