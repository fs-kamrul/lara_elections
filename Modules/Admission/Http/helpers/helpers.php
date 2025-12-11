<?php
if (! defined('ADMISSION_MODULE_SCREEN_NAME')) {
    define('ADMISSION_MODULE_SCREEN_NAME', 'admission');
}
if (!defined('ADMISSION_FORM_TEMPLATE_VIEW')) {
    define('ADMISSION_FORM_TEMPLATE_VIEW', 'admission-form-template-view');
}
//add_next_line

if(! function_exists('englishToBanglaNumber')) {
    function englishToBanglaNumber($number)
    {
        $englishNumbers = range(0, 9);
        $banglaNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        if(Language::getCurrentLocale() == 'bn'){
            $convertedNumber = str_replace($englishNumbers, $banglaNumbers, $number);

            return $convertedNumber;
        }
        return $number;
    }
}
if(! function_exists('calculate_age')) {
    function calculate_age($birthdate)
    {
//        $birthdate = '1990-05-15';
        $birthDateObj = new DateTime($birthdate);
        $currentDateObj = new DateTime();
        $ageInterval = $currentDateObj->diff($birthDateObj);
        $age = $ageInterval->y;
//        echo "Age: " . $age . " years";
        return $age;
    }
}
