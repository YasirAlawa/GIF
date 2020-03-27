<?php


namespace App\helpers;

use App\Article;
use App\Exceptions\UserException;
use App\Picture;

/**
 * Class FacebookHandler
 * @package App\helpers
 */
class FacebookHandler
{
    /**
     * Posting types
     */
    const postingArticle = 'article';
    const postingAlbum = 'album';
    const fb_page_id = 111362890429466;
    /**
     * @var int
     */
//    public $page_id = 243067265774918;
    public $page_id = 111362890429466; //Ammar Page
    /**
     * @var string
     */
    public $user_access_token;
    /**
     * @var string
     */
    public $page_access_token;

    /**
     * FacebookHandler constructor.
     * @param string $user_access_token
     */
    public function __construct($user_access_token)
    {
        $this->user_access_token = $user_access_token;
        $data = $this->getData($this->getUrlForPageAccessToken());
        $data = json_decode($data, true);
        $this->page_access_token = $data['access_token'];
    }

    /**
     * @param string $url
     * @return mixed
     */

    private function getData($url)
    {
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * @return string
     */
    private function getUrlForPageAccessToken()
    {
        return  "https://graph.facebook.com/v2.2/$this->page_id?fields=access_token&access_token=".$this->user_access_token;
    }

    /**
     * @param Article $article
     * @param array $params
     * @return string
     */
    public function postArticle($article,$params)
    {
        $ch      = curl_init();
        $timeout = 50;
        $endPoint = 'feed';
        $post_as_link = (array_key_exists('post_as_link',$params)?$params['post_as_link']:true);
        $time =  MySqlHelper::UNIX_TIMESTAMP($article->publish_date);
        $now =  MySqlHelper::UNIX_TIMESTAMP( MySqlHelper::selectNow());

        $post = array(
            'access_token' => $this->page_access_token,
          //  'timeline_visibility' => "starred",
            'message' => $params['fp_intro'],
        );
        if ($post_as_link)
        {
//            $post['link'] = "http://www.syr-res.com/article/".$article->id.'.html';//for test
            $post['link'] = $article->getPath();//real link
        }
        else
        {
            //$post['url'] = 'https://www.facebook.com/images/fb_icon_325x325.png';// for test
            /** @var Picture $hp */
            $hp = $article->homePicture;
            $post['url'] = $hp->getPath();
            $post['caption'] = 'SYR-RES';
            $endPoint = 'photos';
        }

        if ($now<$time)
        {
            $post['published'] = false;
            $post['scheduled_publish_time'] = $time;
        }



        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/$this->page_id/$endPoint/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $ar = json_decode($data,true);

        if (array_key_exists('id',$ar))
        {
            $article->fb_intro = $post['message'];
            $article->fbid = $ar['id'];
            $article->save();
        }

        return $ar;
    }

    /**
     * @param Article $article
     * @param array $params
     * @param bool $forAlbum
     * @return string
     */
    public function postImage($article,$params,$forAlbum=false)
    {
        $ch      = curl_init();
        $timeout = 50;
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/$this->page_id/photos/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $time_dt = $article->publish_date;
        $time_dt = '2020-02-28 00:00:00';

        $time =  MySqlHelper::UNIX_TIMESTAMP($time_dt);
        $now =  MySqlHelper::UNIX_TIMESTAMP( MySqlHelper::selectNow());

        $post = array(

            'access_token' => $this->page_access_token,
            'message' => array_key_exists('msg',$params)?$params['msg']:'',
            'caption' => 'SYR-RES',
        //    'url' =>  'http://www.syr-res.com/pictures/5014019653.jpg', // for test
            'url' =>  $params['imagepath']
        );

        if ($forAlbum)
            $post['published'] = false;
        else
        {
            if ($now<$time)
            {
                $post['published'] = false;
                $post['scheduled_publish_time'] = $time;
            }
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $ar = json_decode($data,true);
        return $ar;
    }

    /**
     * @param Article $article
     * @param array $params
     * @return string
     */
    public function postAlbum($article,$params)
    {
        /** @var string[] $photos */
        $photos = $params['photos'];
        $uploadedImages = [];
        foreach ($photos as $photo)
        {
            /** @var array $res */
            $res = $this->postImage($article,['imagepath'=>$photo],true);
            if (!array_key_exists('id',$res))
                throw new UserException('Uploading images to facebook failed');
            $uploadedImages[] = $res['id'];
        }
        $ch      = curl_init();
        $timeout = 50;
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/$this->page_id/feed/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $time =  MySqlHelper::UNIX_TIMESTAMP($article->publish_date);
        $time =  MySqlHelper::UNIX_TIMESTAMP('2020-02-28 00:00:00');
        $now =  MySqlHelper::UNIX_TIMESTAMP( MySqlHelper::selectNow());
        $post = array(
            'access_token' => $this->page_access_token,
            'message' => array_key_exists('msg',$params)?$params['msg']:'',
        );
        $i=0;
        foreach ($uploadedImages as $image)
        {
            $post['attached_media['.$i.']'] = '{"media_fbid":"'.$image.'"}';
            $i++;
        }

        if ($now<$time)
        {
            $post['published'] = false;
            $post['scheduled_publish_time'] = $time;
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $ar = json_decode($data,true);

        if (array_key_exists('id',$ar))
        {
            $article->fb_intro = $post['message'];
            $article->fbid = $ar['id'];
            $article->save();
        }

        return $ar;
    }
}