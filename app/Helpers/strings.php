<?php

if(!function_exists('to_persian_numbers')) {
    /**
     * convert latin number to persian
     *
     * @param string $string
     *   string that we want change number format
     *
     * @return string
     */
    function to_persian_numbers($string) {
        return str_replace(range(0, 9), ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], $string);
    }
}

if (!function_exists('to_latin_numbers')) {
    /**
     * convert persian number to latin
     *
     * @param string $string
     *   string that we want change number format
     *
     * @return string
     */
    function to_latin_numbers($string) {
        return str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'], range(0, 9), $string);
    }
}

if (!function_exists('convertArabicStringToPersian')) {
    function convertArabicStringToPersian($string)
    {
        $arabic = ['ي', 'ك', 'ة', 'ؤ', 'إ', 'أ', '٤', '٥', '٦'];
        $persian = ['ی', 'ک', 'ه', 'و', 'ا', 'ا', '۴', '۵', '۶'];
        return str_replace($arabic, $persian, $string);
    }
}

if(!function_exists('numberToPersianWords')) {
    function numberToPersianWords($number) {
        $ones = [
            '',
            'یک',
            'دو',
            'سه',
            'چهار',
            'پنج',
            'شش',
            'هفت',
            'هشت',
            'نه',
            'ده',
            'یازده',
            'دوازده',
            'سیزده',
            'چهارده',
            'پانزده',
            'شانزده',
            'هفده',
            'هجده',
            'نوزده'
        ];

        $tens = [
            '',
            '',
            'بیست',
            'سی',
            'چهل',
            'پنجاه',
            'شصت',
            'هفتاد',
            'هشتاد',
            'نود'
        ];

        $hundreds = [
            '',
            'صد',
            'دویست',
            'سیصد',
            'چهارصد',
            'پانصد',
            'ششصد',
            'هفتصد',
            'هشتصد',
            'نهصد'
        ];

        $thousands = [
            '',
            ' هزار',
            ' میلیون',
            ' میلیارد'
        ];

        // Check if the number is zero
        if ($number == 0) {
            return 'صفر';
        }

        $words = '';

        // Handling each group of three digits
        $i = 0;
        while ($number > 0) {
            $group = $number % 1000;
            $number = (int)($number / 1000);

            if ($group > 0) {
                $h = (int)($group / 100); // hundreds
                $t = (int)($group / 10) % 10; // tens
                $o = $group % 10; // ones

                $group_words = '';

                if ($h > 0) {
                    $group_words .= $hundreds[$h] . ' ';
                }

                if ($t > 1) {
                    $group_words .= $tens[$t] . ' ';
                    if ($o > 0) {
                        $group_words .= 'و ';
                    }
                } elseif ($t == 1) {
                    $group_words .= $ones[$t * 10 + $o] . ' ';
                    $t = $o = 0; // Skip the ones place processing
                }

                if ($o > 0) {
                    $group_words .= $ones[$o] . ' ';
                }

                $group_words .= $thousands[$i];

                $words = $group_words . $words;
            }

            $i++;
        }

        // Remove extra spaces
        $words = trim($words);

        return $words;
    }
}

if (!function_exists('str_limit')) {
    function str_limit($string, $limit = 150, $end = '...')
    {
        return \Illuminate\Support\Str::limit($string, 150, $end = '...');
    }
}
