<?php

use Illuminate\Support\Str;

if(!function_exists('callout')) {
    /**
     * Prepares flash data to use in panel.layout.partials.blade template.
     *
     * This function helps you to create appropriate Callout boxes. Every call create one callout.
     * you can hide icon by passing null values to the third argument of this function.
     *
     * @param string $message Sets a message for the callout
     * @param string|null $title Sets a title for the callout. pass null to remove it
     * @param string|null $type Sets a title for the callout. pass null to remove ir or pass on of the following values: info, warning, danger, success
     * @param bool $button Sets it true to show a button
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function callout($message, $title = 'توجه', $type = 'info', $button = false) {

        if ($title !== null)
        {
            $title .= ': ';
        }

        switch ($type)
        {
            case 'success':
                $icon = 'check';
                break;
            case 'warning':
                $icon = 'exclamination-triangle';
                break;
            case 'danger':
                $icon = 'close';
                break;
            case null:
                $icon = null;
                break;
            case 'info':
            default:
                $icon = 'info';
        }

        if (!in_array($type, ['info', 'danger', 'warning', 'success'])) {
            $type = 'info';
        }

        if (session()->has('callout'))
        {
            $callouts = session()->get('callout');
        }

        if ($button !== true)
        {
            $button = false;
        }

        $callouts[] = [
            'message'   => $message,
            'title'     => $title,
            'type'      => $type,
            'icon'      => $icon,
            'button'    => $button,
        ];

        session()->flash('callout', $callouts);
    }
}

if (!function_exists('dash2comma')) {
    /**
     * Converts hyphen (-) to comma (,) with removing whitespaces.
     *
     * @param $string string The string you want to convert
     * @return bool|string FALSE if not string and converted string if string
     */
    function dash2comma($string) {
        if (!is_string($string) OR is_null($string)) {
            return NULL;
        }
        $array = explode('-', $string);
        $array = array_map('trim', $array);
        return implode(',', $array);
    }
}

if (!function_exists('comma2dash')) {
    /**
     * Converts comma (,) to hyphen (-) with removing whitespaces.
     *
     * @param $string string The string you want to convert
     * @return bool|string FALSE if not string and converted string if string
     */
    function comma2dash($string) {
        if (!is_string($string)OR is_null($string)) {
            return NULL;
        }
        $array = explode(',', $string);
        $array = array_map('trim', $array);
        return implode('-', $array);
    }
}

if (!function_exists('count_unicode_words')) {
    /**
     * The function to count words in Unicode  strings.
     *
     * First remove all the punctuation marks & digits,
     * Then replace all the whitespaces (tabs, new lines, multiple spaces) by single space,
     * The words are now separated by single spaces and can be splitted to an array,
     * I have included \n\r\t here as well, but only space will also suffice,
     * Now we can get the word count by counting array elements.
     *
     * @see https://gist.github.com/abhineetmittal/d250083def7c356bbf161ff74444ebcc
     * @param $unicode_string
     * @return int
     */
    function count_unicode_words($unicode_string){
        $unicode_string = preg_replace('/[[:punct:][:digit:]]/', '', $unicode_string);
        $unicode_string = preg_replace('/[[:space:]]/', ' ', $unicode_string);
        $words_array = preg_split( "/[\n\r\t ]+/", $unicode_string, 0, PREG_SPLIT_NO_EMPTY );

        return count($words_array);
    }
}

if(!function_exists('reading_time')) {
    /**
     * Estimates the approximate time of reading a content.
     *
     * @param string $content text to calculate time of reading
     * @param bool $second calculate second or not
     * @return array|float returns minutes if $second set false, returns an array include minutes and seconds if $second set to true
     */
    function reading_time($content, $second = false) {
        $words      = count_unicode_words(strip_tags($content));
        $minutes    = floor($words / 200);
        if ($second) {
            $seconds = floor($words % 200 / (200 / 60));
            return compact('minutes', 'seconds');
        }
        return $minutes;
    }
}

if (!function_exists('words')) {
    /**
     * @param string $content The main content to reduce
     * @param int $length How many words of the content do you need?
     * @param string $end Characters to end new string.
     * @return string reduced string
     *
     */
    function words($content, $length = 100, $end = '...') {
        return Str::words($content, $length, $end);
    }
}

if (!function_exists('gravatar')) {
    function gravatar($email, $size = 'nano') {
    	switch($size) {
    		case 'large':
    		    $size = 512;
    		break;
    		case 'normal':
    		    $size = 256;
    		break;
    		case 'micro':
    		    $size = 160;
    		break;
    		case 'mini':
    		    $size = 100;
    		break;
    		case 'nano':
    		    $size = 45;
    		default:
    		    $size = 45;
    	}
    	$size = is_int($size) ? $size : 45;
    	return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=' . $size . '&d=mp';
    }
}

if (!function_exists('doneMessage')) {
    function doneMessage($msg = 'با موفقیت انجام شد', $status = 'success', $title = '')
    {
        return session()->flash('msg', ['status' => $status, 'title' => $title, 'message' => $msg]);
    }
}

if (!function_exists('success')) {
    function success($msg = 'با موفقیت انجام شد', $title = '')
    {
        return session()->flash('msg', ['status' => 'success', 'title' => $title, 'message' => $msg]);
    }
}

if (!function_exists('error')) {
    function error($msg = 'خطایی رخ داده است', $title = '')
    {
        return session()->flash('msg', ['status' => 'error', 'title' => $title, 'message' => $msg]);
    }
}

if (!function_exists('avatar')) {
    function avatar($email = null)
    {
        return gravatar($email, 'micro');
    }
}

if (!function_exists('mini_avatar')) {
    function mini_avatar($email = null)
    {
        return gravatar($email);
    }
}

if(!function_exists('encrypt_pkcs7')) {
    /**
     * Create sign data(Tripledes(ECB,PKCS7)).
     *
     * @param $str
     * @param $key
     * @return string
     */
    function encrypt_pkcs7($str, $key)
    {
        $key = base64_decode($key);
        $ciphertext = OpenSSL_encrypt($str,"DES-EDE3", $key, OPENSSL_RAW_DATA);
        return base64_encode($ciphertext);
    }
}

if(!function_exists('CallAPI')) {
    /**
     * Send Data
     * @param $url
     * @param bool $data
     * @return bool|string
     */
    function CallAPI($url, $data = false)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data)));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}

if (!function_exists('isValidNationalId')) {
    /**
     * Determine if a national id is valid or not
     *
     * @param $nid string The national id of a user
     */
    function isValidNationalId(string $nid): bool
    {
        $value = to_latin_numbers($nid);
        if(!preg_match('/^[0-9]{10}$/', $value))
        {
            return false;
        }

        for($i = 0; $i < 10; $i++)
        {
            if(preg_match('/^' . $i . '{10}$/', $value))
            {
                return false;
            }
        }

        for($i = 0, $sum = 0; $i < 9; $i++)
        {
            $sum += ((10-$i) * intval(substr($value, $i, 1)));
        }

        $ret = $sum % 11;

        $parity = intval(substr($value, 9, 1));

        if(($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
        {
            return true;
        }

        return false;
    }

    function d(...$args)
    {
        $allowedIp = '5.202.168.55'; // آی‌پی خود را اینجا قرار دهید

        if (request()->ip() === $allowedIp || request()->has('developer_token')) {
            dd(...$args);
        }
    }
}
