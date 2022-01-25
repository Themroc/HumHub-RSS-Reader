<?php

namespace sij\humhub\modules\rss\models;

use Yii;

class ConfigureForm extends \yii\base\Model
{

    /**
     * String:
     * the URL of the RSS feed
     */
    public $url;

    /**
     * String:
     * "summary" = show a summary of the article
     * "full" = show the full article
     */
    public $article;

    /**
     * String:
     * "yes" = show pictures in the article
     * "no" = remove all pictures from the article
     */
    public $pictures;

    /**
     * Integer:
     * maximum width (pixels) of pictures in an article
     */
    public $maxwidth;

    /**
     * Integer:
     * maximum height (pixels) of pictures in an article
     */
    public $maxheight;

    /**
     * Integer:
     * update interval in minutes
     */
    public $interval;

    /**
     * String:
     * guid of User who owns the posts
     */
    public $owner;

    /**
     * Integer:
     * maximum age (in days) of news items to be extract from the RSS feed.
     * this is useful if the feed contains a large amount of history,
     * but we are only interested in recent information.
     */
    public $dayshistory;

    /**
     * Integer:
     * maximum number of days into the future we accept items from the RSS feed.
     * some RSS feeds contain advance postings for the comming days or months,
     * but we may only be interesting in current and past events.
     */
    public $daysfuture;

    public function rules()
    {
        return [
            [
                ['url', 'owner'],
                'safe'
            ],[
                'url',
                'trim'
            ],[
                ['url', 'maxwidth', 'maxheight'],
                'required'
            ],[
                'url',
                'string',
                'max' => 255,
            ],[
                'article',
                'in',
                'range' => ['summary', 'full'],
            ],[
                'pictures',
                'in',
                'range' => ['yes', 'no'],
            ],[
                ['maxwidth', 'maxheight'],
                'integer',
                'min' => 10,
                'max' => 2500,
            ],[
                'interval',
                'integer',
                'min' => 1,
            ],[
                ['daysfuture', 'dayshistory'],
                'integer',
                'min' => 0,
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'url' => 'URL of the RSS Feed',
            'article' => 'Show the full article or just a summary?',
            'pictures' => 'Show pictures in the news articles?',
            'maxwidth' => 'Maximum width of pictures',
            'maxheight' => 'Maximum height of pictures',
            'interval' => 'Update interval in minutes',
            'owner' => 'The user who owns the posts',
            'daysfuture' => 'Ignore news dated beyond this number days into the future',
            'dayshistory' => 'Ignore news older than this number of days in the past',
        ];
    }

}
