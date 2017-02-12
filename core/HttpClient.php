<?php namespace core;

/**
 * A HttpClient based on curl
 */
class HttpClient {

    /**
     * GET
     *
     * @param string $url
     * @param array $data
     * return string
     */
    public static function get($url, array $data = []) {
        if (!empty($data)) {
            $query = http_build_query($data);
            $url = strpos($url, '?') === false ? $url . '?' . $query : $url . $query;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * POST
     *
     * @param string $url
     * @param array $data
     * return string
     */
    public static function post($url, array $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        !empty($data) && curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}

