<?php

class SocialstreamSiteConfig extends DataExtension
{
    private static $db = array(
        'TwitterUsername' => 'Varchar(255)',
        'TwitterHashtag' => 'Varchar(255)',
        'FacebookPage' => 'Varchar(255)',
        'VimeoUsername' => 'Varchar(255)',
        'YoutubeUsername' => 'Varchar(255)',
        'DailymotionUsername' => 'Varchar(255)',
        'RssFeed' => 'Varchar(255)',
        'FlickrUsername' => 'Varchar(255)',
        'GithubUsername' => 'Varchar(255)',
        'LifestreamWhitelist' => 'Varchar(255)'
    );

    public static function listAvailableMediaServices()
    {
        return array(
            'bitly' => array(),
            'blogger' => array(),
            'citeulike' => array(),
            'dailymotion' => array(),
            'delicious' => array(),
            'deviantart' => array('template' => array('deviationpost' => '')),
            'dribbble' => array(),
            'facebook_page' => array(),
            'flickr' => array(),
            'formspring' => array(),
            'forrst' => array(),
            'github' => array(),
            'gimmebar' => array(),
            'googleplus' => array('key'),
            'instapaper' => array(),
            'iusethis' => array(),
            'lastfm' => array(),
            'librarything' => array(),
            'miso' => array(),
            'mlkshk' => array(),
            'pinboard' => array(),
            'posterous' => array(),
            'reddit' => array(),
            'rss' => array(),
            'slideshare' => array(),
            'snipplr' => array(),
            'stackoverflow' => array(),
            'tumblr' => array(),
            'twitter' => array(),
            'vimeo' => array(),
            'wikipedia' => array('language'),
            'wordpress' => array(),
            'youtube' => array(),
            'zotero' => array(),
            // custom services
            'twitter_hashtag' => array(),
        );
    }

    public function updateCMSFields(FieldList $fields)
    {
        $services = SiteConfig::config()->available_services;
        if (!$services) {
            $services = array_keys(self::listAvailableMediaServices());
        }

        if (in_array('twitter', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('TwitterUsername'));
        }
        if (in_array('twitter_hashtag', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('TwitterHashtag'));
        }
        if (in_array('facebook_page', $services)) {
            $fields->addFieldToTab('Root.Social', new TextField('FacebookPage'));
        }
        if (in_array('vimeo', $services)) {
            $fields->addFieldToTab('Root.Social', new TextField('VimeoUsername'));
        }
        if (in_array('youtube', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('YoutubeUsername'));
        }
        if (in_array('dailymotion', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('DailymotionUsername'));
        }
        if (in_array('rss', $services)) {
            $fields->addFieldToTab('Root.Social', new TextField('RssFeed'));
        }
        if (in_array('flickr', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('FlickrUsername'));
        }
        if (in_array('github', $services)) {
            $fields->addFieldToTab('Root.Social',
                new TextField('GithubUsername'));
        }

        $fields->addFieldToTab('Root.Social',
            $wl = new ListboxField('LifestreamWhitelist',
            'Lifestream Whitelist', array_combine($services, $services)));
        $wl->setMultiple(true);
        $wl->setDescription('A list of services to display on the Lifestream. If left blank, all configured streams will be used.');
        return $fields;
    }

    public function TwitterLink()
    {
        return 'https://twitter.com/'.$this->owner->TwitterUsername;
    }

    public function FacebookLink()
    {
        return 'https://www.facebook.com/'.$this->owner->FacebookPage;
    }
}