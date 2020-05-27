<?php

/*
1. youtube users N
2. If user A adds/deletes a video than all the users belogs (N-A) should get the new video update
3. If youtube adds/deletes a video than all the N users should get update
*/

/**
 * IVideoContainer interface
 */
interface IVideoContainer
{
    public function addVideo($object);
    public function deleteVideo($object);
}

/**
 * IUpdateAllSubscribers interface
 */
interface IUpdateAllSubscribers
{
    public function videoNotification($whoAdded, $thisVideo, $videoLists);
}

/**
 * IYoutubeDashboardSubcribers interface
 */
interface IYoutubeDashboardSubcribers
{
    public function addSubcriber($object);
    public function removeSubcriber($object);
}

/**
 * AddersIdenitity interface
 */
interface AddersIdenitity
{
    public function getData();
    public function whoAdded();
    public function WhichVideoAdded();
}

/**
 * ImyVideos interface
 */
interface ImyVideos
{
    public function myNewVideo();
    public function myName();
}

/**
 * YoutubeDashBoard class
 * update only to youtube dude whenever I get an update for video
 */
class YoutubeDashBoard implements IVideoContainer, AddersIdenitity
{
    private $videoListWithUsers = [];
    private $youtube = null;

    public function __construct()
    {
    }

    public function addVideo($videoAdderObject)
    {
        $this->videoAddedBy = $videoAdderObject->myName();
        $this->thisVideoAdded = $videoAdderObject->myNewVideo();

        $this->videoListWithUsers[$this->videoAddedBy][] = $videoAdderObject->myNewVideo();
        // state change
        $this->updateToYoutube();
    }

    public function deleteVideo($video)
    {
    }

    public function getData()
    {
        return $this->videoListWithUsers;
    }

    public function whoAdded()
    {
        return $this->videoAddedBy;
    }

    public function WhichVideoAdded()
    {
        return $this->thisVideoAdded;
    }

    public function addSubcriber($youtube)
    {
        $this->youtube = $youtube;
    }
    public function removeSubcriber()
    {
        // youtube can not unsubcribe
        unset($this->youtube);
    }

    public function updateToYoutube()
    {
        if (isset($this->youtube)) {
            $this->youtube->videoNotification($this->whoAdded(), $this->WhichVideoAdded(), $this->getData());
        }
    }
}

/**
 * Youtube class
 * I need an update whereever any new video is added - not my job dashboard job
 * my part is to handle which user should get update and which user should not
 */
class Youtube implements IYoutubeDashboardSubcribers, IUpdateAllSubscribers, ImyVideos
{
    /**
     * dashBoardSubscribers variable
     *
     * @var array
     */
    private $dashBoardSubscribers = [];

    /**
     * addSubcriber function
     *
     * @param [object] $subcribers
     *
     * @return void
     */
    public function addSubcriber($subcribers)
    {
        if (!isset($this->dashBoardSubscribers[$subcribers->myName()])) {
            $this->dashBoardSubscribers[$subcribers->myName()] = $subcribers;
        }
    }

    /**
     * removeSubcriber function
     *
     * @param [object] $subcribers
     *
     * @return void
     */
    public function removeSubcriber($subcribers)
    {
        if (isset($this->dashBoardSubscribers[$subcribers->myName()])) {
            unset($this->dashBoardSubscribers[$subcribers->myName()]);
        }
    }

    /**
     * suspendNotifications function
     *
     * @param [object] $subcribers
     *
     * @return void
     */
    public function suspendNotifications($subcribers)
    {
        if (isset($this->dashBoardSubscribers[$subcribers->myName()])) {
            unset($this->dashBoardSubscribers[$subcribers->myName()]);
        }
    }

    // dear youtubedashboard you have to tell me which user added the video or is it you
    /**
     * videoNotification function
     *
     * @param [string] $addedBy
     * @param [string] $thisVideo
     * @param [array] $getData
     *
     * @return void
     */
    public function videoNotification($addedBy, $thisVideo, $getData=[])
    {
        if (isset($this->dashBoardSubscribers[$addedBy])) {
            $doNotUpdate = $this->dashBoardSubscribers[$addedBy];
            unset($this->dashBoardSubscribers[$addedBy]);
        }

        foreach ($this->dashBoardSubscribers as $subcribers) {
            $subcribers->videoNotification($addedBy, $thisVideo, $getData);
        }

        if (isset($doNotUpdate)) {
            $this->dashBoardSubscribers[$addedBy] = $doNotUpdate;
        }
    }

    /**
     * myNewVideo function
     *
     * @return void
     */
    public function myNewVideo()
    {
        $newVideo = "My new Video".date("Y-m-d-H-i-s");
        
        return $newVideo;
    }

    /**
     * myName function
     *
     * @return void
     */
    public function myName()
    {
        $this->myName = "youtube";
        return $this->myName;
    }
}

abstract class User implements IUpdateAllSubscribers, ImyVideos
{
    abstract public function myNewVideo();
    abstract public function myName();

    /**
     * videoNotification function
     *
     * @param [string] $addedby
     * @param [string] $thisVideo
     * @param [array] $getList
     *
     * @return void
     */
    public function videoNotification($addedby, $thisVideo, $getList=[])
    {
        $this->addedby = $addedby;
        $this->thisVideo = $thisVideo;
        $this->showVideos();
    }

    /**
     * myTotalVideos function
     *
     * @return void
     */
    public function myTotalVideos()
    {
    }

    /**
     * OtherUserTotalVideos function
     *
     * @return void
     */
    public function OtherUserTotalVideos()
    {
    }

    /**
     * showVideos function
     *
     * @return void
     */
    public function showVideos()
    {
        echo "<br> - - -  this video $this->thisVideo - - - -added by $this->addedby<br>";
    }
}


/**
 * Raveena class
 */
class Raveena extends User
{
    /**
     * myNewVideo function
     *
     * @return void
     */
    public function myNewVideo()
    {
        $newVideo = "My new Video". date("Y-m-d-H-i-s");
        
        return $newVideo;
    }

    /**
     * myName function
     *
     * @return void
     */
    public function myName()
    {
        $this->myName = "raveena";
        return $this->myName;
    }

    /**
     * showVideos function
     *
     * @return void
     */
    public function showVideos()
    {
        echo "<br> my custom call $this->myName- - -  this video $this->thisVideo - - - -added by $this->addedby<br>";
    }
}

/**
 * Rohan class
 */
class Rohan extends User
{
    /**
     * myNewVideo function
     *
     * @return void
     */
    public function myNewVideo()
    {
        $newVideo = "My new Video". date("Y-m-d-H-i-s");
        
        return $newVideo;
    }

    /**
     * myName function
     *
     * @return void
     */
    public function myName()
    {
        $this->myName = "rohan";
        return $this->myName;
    }

    /**
     * showVideos function
     *
     * @return void
     */
    public function showVideos()
    {
        echo "<br> my custom call $this->myName- - -  this video $this->thisVideo - - - -added by $this->addedby<br>";
    }
}

/**
 * Reehna class
 */
class Reehna extends User
{
    /**
     * myNewVideo function
     *
     * @return void
     */
    public function myNewVideo()
    {
        $newVideo = "My new Video". date("Y-m-d-H-i-s");
        
        return $newVideo;
    }

    /**
     * myName function
     *
     * @return void
     */
    public function myName()
    {
        $this->myName = "rheena";
        return $this->myName;
    }

    /**
     * showVideos function
     *
     * @return void
     */
    public function showVideos()
    {
        echo "<br> my custom call $this->myName- - -  this video $this->thisVideo - - - -added by $this->addedby<br>";
    }
}

function pp($data, $space=null)
{
    echo "<pre>";
    if (isset($space)) {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        print_r($data);
        echo "<br>";
        echo "<br>";
        echo "<br>";
    } else {
        print_r($data);
    }
    echo "</pre>";
}

$youtube  = new Youtube();
$youtubeDashBoard = new YoutubeDashBoard();
$rohan = new Rohan();
$raveena = new Raveena();
pp('rohan adding new video');
$youtubeDashBoard->addVideo($rohan);

$youtubeDashBoard->addSubcriber($youtube);
pp('rohan adding new video');
$youtubeDashBoard->addVideo($rohan);
pp('raveena subcribed');
$youtube->addSubcriber($raveena);
pp('rohan subcribed');
$youtube->addSubcriber($rohan);
$reehna = new Reehna();
pp('rohan adding 3 new video');
$youtubeDashBoard->addVideo($rohan);
$youtubeDashBoard->addVideo($rohan);
$youtubeDashBoard->addVideo($rohan);
sleep(1);

pp('rheena subcribed');
$youtube->addSubcriber($reehna);
pp('raveena adding new video');
$youtubeDashBoard->addVideo($raveena);
pp('rohan adding new video');
$youtubeDashBoard->addVideo($rohan);
sleep(1);
pp('raveena adding new video');
$youtubeDashBoard->addVideo($raveena);
pp('youotube adding new video', 1);
$youtubeDashBoard->addVideo($youtube);
pp('raveena unsibcribed', 1);
$youtube->removeSubcriber($raveena);

pp('youotube adding new video', 1);
$youtubeDashBoard->addVideo($youtube);

pp('rohan adding 2 new video');
$youtubeDashBoard->addVideo($rohan);
$youtubeDashBoard->addVideo($rohan);
