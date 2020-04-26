<?php

/**
 * Schxz Instagram.
 *
 * ...
 *
 * @version    Release: 1.0
 * @author     Schxz
 */

namespace Schxz;

class Instagram
{
    public      $User = null;
    private     $QueryHash = null;

    function __construct()
    {
        $QueryHash = $this->get("https://www.instagram.com/static/bundles/es6/ProfilePageContainer.js/535dde806870.js", false);
        $QueryHash = explode('"', explode(';return o?null:null===(s=t.profilePosts.byUserId.get(n))||void 0===s?void 0:s.pagination},queryId:"', $QueryHash)[1])[0];
        $this->QueryHash = $QueryHash;
    }

    /**
     * It loads the information for the user to be processed.
     *
     * @param Username Desired username.
     */
    function loadUser($Username)
    {
        $userData = $this->get("https://www.instagram.com/$Username/?__a=1");
        $this->User = $userData->graphql->user;
        return $this;
    }

    function getUserId()
    {
        return $this->User != null ? $this->User->id : null;
    }

    function numberFormat($num)
    {
        $thousands = $num % 1000000;
        $millions = ($num - $thousands) / 1000000;
        $thousands = $thousands / 1000;

        if ($millions >= 1) {
            return round($millions, 2) . " M";
        } else if ($thousands >= 1) {
            return round($thousands, 2) . " K";
        } else {
            return $num;
        }
    }

    /**
     * It allows you to take the shares made by the user.
     *
     * @param Limit How many will be brought since the last share
     * @return Posts
     */
    function getPosts($Limit = 12)
    {
        if ($this->User != null && $this->QueryHash != null) {
            $Posts = $this->get('https://www.instagram.com/graphql/query/?query_hash=' . $this->QueryHash . '&variables={"id":"' . $this->User->id . '","first":' . $Limit . '}');
            return $Posts->data->user->edge_owner_to_timeline_media->edges;
        } else {
            return [];
        }
    }

    private function get($url, $decode = true)
    {
        $ch = curl_init();
        $hc = "YahooSeeker-Testing/v3.9 (compatible; Mozilla 4.0; MSIE 5.5; Yahoo! Search - Web Search)";
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $hc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $Content = curl_exec($ch);
        curl_close($ch);

        return $decode ? json_decode($Content) : $Content;
    }
}
