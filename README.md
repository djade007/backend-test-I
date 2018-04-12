## TwitBot

### Devcenter Backend Developer Test I

This is a bot that extracts the following from people’s Twitter bio (on public/open accounts), into a Google spreadsheet:

* Twitter profile name 
* Number of followers

Target accounts using criteria:
* Based on hashtags used
* Based on number of followers; Between 1,000 - 50,000

The bot is suppose to maintain a session and continously listen to the predefined hashtag

## Requirements
  - PHP >= 7.0.0
  - Composer - A PHP package manager: https://getcomposer.org/
  
## Installation
Create .env file from the example given in .env.example
```
$ cp .env.example .env
$ vim .env
```
Get your api keys from (Twitter)[https://apps.twitter.com] and insert your .env file

Visit (Google Console)[https://console.developers.google.com/flows/enableapi?apiid=sheets.googleapis.com] and download your service api file
```
$ vim .google_credentials.json
```
copy it to the project folder and rename to .google_credentials.json

Install the external dependencies
```
$ composer install
```

## Usage
```
$ php twitbot
```

## Demo
![screen shot](https://user-images.githubusercontent.com/8668661/33088863-330b4250-ceef-11e7-9e9c-b4fd9ca299d8.gif)
