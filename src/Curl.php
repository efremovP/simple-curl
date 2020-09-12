<?php

namespace efremovP\curl;

/**
 *
 *  class work with cURL
 *
 * @author Efremov Petr
 * @since 2.0
 */
class Curl
{
    /**
     * send request through cURL
     * @param string $url
     * @param array $headers - headers list
     * @param array $params - params list(send in method POST)
     * @param string $method - method send request
     * @return string
     */
    public static function send($url, $headers, $params = null, $method = 'post')
    {
        if (is_array($params)) {
            $data = http_build_query($params);
        } else {
            $data = $params;
        }

        $handle = curl_init();

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        if ($data) {
            if($method == 'put') {
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "PUT");
            } else {
                curl_setopt($handle, CURLOPT_POST, true);
            }

            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        curl_close($handle);

        return ['code' => $code, 'response' => $response];
    }
}