<?php
// giving n-user the ability to add new videos


interface Iyoutube
{
    public function loginYoutube();
    public function logoutYoutube();
    public function notificationOfNewVideo();
}

interface IUser
{
    public function SubscribeToNewVideosNotification($newVideo);
}

class Youtube implements Iyoutube
{
    public static $newVideoCount = 0;
    private $newVideo = null;

    public function __construct()
    {
    }

    public function loginYoutube(IUser $IUser=null)
    {
        $this->IUser = $IUser;
        return $this;
    }

    public function logoutYoutube()
    {
    }

    public function notificationOfNewVideo()
    {
        $this->IUser->SubscribeToNewVideosNotification($this->newVideo);
    }

    public function addNewVideo()
    {
        $this->newVideo =  "<br>total ".  ++self::$newVideoCount . " New videos added ".date('m-d-H-i-s'). "<br>";
        return $this;
    }
}

class YoutubeUser implements IUser
{
    public function SubscribeToNewVideosNotification($newVideo)
    {
        echo "<br>How many new Videos are there <br>";
        echo $newVideo;
    }
}

// ping youtube
$youtube  = new Youtube();

// ping to self
$myself = new YoutubeUser();
$myselfInMultiVerse = new YoutubeUser();
// me: telling you give my new videos update
// youtube: keep pinging me I will update whenever I can
// No that's a a very heavy job I have other works to do
// ok give me your identity
// so whenever I have an update I will update you
// you will get my update immedialty if you are logged in
// me: cool ok let me tell you who I am and my address

$myselfAttached = new YoutubeUser($youtube);
$myselfInMultiVerseAttached = new YoutubeUser($youtube);

// either way both are same
// I want to get my new videos

$youtube->loginYoutube($myself)->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->notificationOfNewVideo();

$youtube->loginYoutube($myself)->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->notificationOfNewVideo();

$youtube->loginYoutube($myself)->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->addNewVideo()->notificationOfNewVideo();
