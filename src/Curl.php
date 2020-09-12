<?php

namespace efremovP\curl;

/**
 *
 * Функции для работы с curl
 *
 * @author Ефремов Петр
 * @since 2.0
 */
class Curl
{
    /**
     * отправляем запрос по curl
     * @param string $url
     * @param array $headers - заголовки
     * @param array $params - необходимые параметры(посылаемые методом POST)
     * @param string $method - метод отправки запроса
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