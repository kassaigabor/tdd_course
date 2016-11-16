<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.16.
 * Time: 9:41
 */

namespace Stackoverflow\Api;


class Api
{
    /** @var string  */
    protected $host = 'http://api.stackexchange.com';

    /** @var string */
    protected $site = 'stackoverflow';

    /** @var string */
    protected $version = '2.2';

    /**
     * @param $order
     * @param $sort
     * @return mixed
     */
    public function getFeaturedQuestions($order, $sort)
    {
        $url = '/' . $this->version . '/questions/featured?order=' . $order . '&sort=' . $sort . '&site=' . $this->site;
        $result = json_decode($this->getRequest($url), true);
        return $result;
    }

    /**
     * @param $id
     * @param $order
     * @param $sort
     * @return mixed
     */
    public function getAnswers($id, $order, $sort)
    {
        $url = '/' . $this->version . '/questions/' . $id . '/answers?order=' . $order . '&sort=' . $sort . '&site=' . $this->site;
        $result = json_decode($this->getRequest($url), true);
        return $result;
    }

    /**
     * @param $url
     * @return mixed
     */
    protected function getRequest($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->host . $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_USERAGENT, 'cURL');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_ENCODING , "gzip");
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}