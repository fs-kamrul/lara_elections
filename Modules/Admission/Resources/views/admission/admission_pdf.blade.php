<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangla PDF Example</title>
    <style>
        table{
            width: 100%;
            padding-bottom: 10px;
        }
        th, td {
            padding-bottom: 6px;
            /*border: 1px solid #ddd;*/
        }
        .border_bos {
            border: 1px solid #000000;
        }
        .logo{
            /*padding-top: -40px;*/
        }
        .header{
            /*padding-left: -40px;*/
            /*padding-right: -60px;*/
            align-items: flex-start;
            margin: 0;
        }
        .header_2{
            font-size: 22px;
            text-align: center;
        }
        .header_3{
            font-size: 18px;
            text-align: left;
        }
        .header_4{
            font-size: 18px;
            text-align: center;
            padding-top: 120px;
        }
        .header_5{
            font-size: 18px;
            text-align: left;
        }
        .title{
            font-size: 30px;
            text-align: center;
        }
        .underline {
            display: inline-block;
            border-bottom: 2px dotted;
            background-image: linear-gradient(to right, transparent 50%, black 50%);
            background-size: 4px 1px; /* Adjust the size of the dots */
            width: 100%;
        }
        .topline {
            display: inline-block;
            border-top: 2px dotted;
            background-image: linear-gradient(to right, transparent 50%, black 50%);
            background-size: 4px 1px; /* Adjust the size of the dots */
            width: 100%;
        }
    </style>
</head>
@php
$n = 0;
@endphp
<body>
<table class="header">
    <tr>
        <td>
            <img class="logo" src="{{ asset(getImageUrlById(theme_option('logo'), 'shortcodes')) }}" height="60px">
        </td>
        <td class="title">
            <span>{{ theme_option('site_title') }}</span><br/>
            <span>{{ theme_option('address') }}</span>
        </td>
        <td>
            <img src="{{ asset(getImageUrl($record->photo, 'admission')) }}" height="100px">
        </td>
    </tr>
</table>
<table class="header_2">
    <tr>
        <td class="title_2">
            <span>@lang('রোল নং'): </span><span class="underline"> {{ englishToBanglaNumber($record->roll) }}</span>
        </td>
        <td class="title_2">
            <span>@lang('ভর্তি ফরম'): </span><span class="underline"> {{ englishToBanglaNumber($record->id) }}</span>
        </td>
    </tr>
</table>
<table class="header_3">
    <tr>
        <td colspan="3">
            <span>@lang('ভর্তিইচ্ছুক ক্লাস') :</span><span class="underline"> {{ Option::getClassNameById($record->class) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}. <span>@lang('শিক্ষার্থীর নাম') :</span><span class="underline"> {{ englishToBanglaNumber($record->name) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}. <span>@lang('পিতার নাম') :</span><span class="underline"> {{ englishToBanglaNumber($record->father_name) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}. <span>@lang('মাতার নাম') :</span><span class="underline"> {{ englishToBanglaNumber($record->mother_nane) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            {{ englishToBanglaNumber(++$n) }}. <span>@lang('জন্ম তারিখ') :</span><span class="underline"> {{ englishToBanglaNumber($record->dob) }}</span>
        </td>
        <td colspan="2">
            <span>@lang('বয়স') :</span><span class="underline"> {{ calculate_age($record->dob) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}. <span>@lang('জন্ম নিবন্ধন নম্বর') :</span><span class="underline"> {{ englishToBanglaNumber($record->birth_registration) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('ধর্ম') :</span><span class="underline"> {{ Option::getReligionNameById($record->religion) }}</span>
        </td>
        <td colspan="">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('জাতীয়তা') :</span><span class="underline"> {{ Location::getNationalityNameById($record->nationality) }}</span>
        </td>
        <td colspan="">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('মোবাইল নং') :</span><span class="underline"> {{ englishToBanglaNumber($record->phone) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('পূর্বের অধ্যয়নরত বিদ্যালয়ের নাম') :</span><span class="underline"> {{ $record->pre_institution }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            <span>@lang('পূর্বের ক্লাস') :</span><span class="underline"> {{ Option::getClassNameById($record->pre_class) }}</span>
        </td>
        <td colspan="2">
            <span>@lang('পূর্বের জিপিএ') :</span><span class="underline"> {{ englishToBanglaNumber($record->pre_gpa) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('শিক্ষার্থীর বর্তমান ঠিকানা') :</span><span class="underline"> {{ $record->pre_address }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            <span>@lang('পোস্টকোড') :</span><span class="underline"> {{ englishToBanglaNumber($record->pre_postcode) }}</span>
        </td>
        <td colspan="1">
            <span>@lang('জেলা') :</span><span class="underline"> {{ Location::getStateNameById($record->pre_states) }}</span>
        </td>
        <td colspan="1">
            <span>@lang('উপজেলা') :</span><span class="underline"> {{ Location::getCityNameById($record->pre_city) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('শিক্ষার্থীর স্থায়ী ঠিকানা') :</span><span class="underline"> {{ $record->per_address }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            <span>@lang('পোস্টকোড') :</span><span class="underline"> {{ englishToBanglaNumber($record->per_postcode) }}</span>
        </td>
        <td colspan="1">
            <span>@lang('জেলা') :</span><span class="underline"> {{ Location::getStateNameById($record->per_states) }}</span>
        </td>
        <td colspan="1">
            <span>@lang('উপজেলা') :</span><span class="underline"> {{ Location::getCityNameById($record->per_city) }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            {{ englishToBanglaNumber(++$n) }}.  <span>@lang('স্থানীয় অভিভাবকের নাম') :</span><span class="underline"> {{ $record->loc_name }}</span>
        </td>
    </tr>
    <tr>
        <td colspan="">
            <span>@lang('সম্পর্ক') :</span><span class="underline"> {{ englishToBanglaNumber($record->loc_relation) }}</span>
        </td>
{{--        <td colspan="1">--}}
{{--            <span>@lang('পেশা') :</span><span class="underline"> {{ Location::getStateNameById($record->loc_address) }}</span>--}}
{{--        </td>--}}
        <td colspan="2">
            <span>@lang('মোবাইল নং') :</span><span class="underline"> {{ englishToBanglaNumber($record->loc_phone) }}</span>
        </td>
    </tr>
</table>

<table class="header_4">
    <tr>
        <td>
            <span class="topline">@lang('অভিভাবকের স্বাক্ষর')</span>
        </td>
        <td>
            <span class="topline">@lang('আবেদনকারীর স্বাক্ষর')</span>
        </td>
        <td>
            <span class="topline">@lang('প্রতিষ্ঠান প্রধানের স্বাক্ষর')</span>
        </td>
    </tr>
</table>

<table class="header_5">
    <tr>
        <td>
            <span class="underline">@lang('প্রয়োজনীয় কাগজপত্র') :</span><br/><br/>
            <span>@lang('১.৫ম শ্রেণী প্রত্যয়নপত্র ।')</span><br/>
            <span>@lang('শিক্ষার্থীর অনলাইন জন্ম নিবন্ধন ফটোকপি ।')</span><br/>
            <span>@lang('পিতা মাতার NID অথবা স্থানীয় অভিভাবকের NID ফটোকপি ।')</span>
        </td>
    </tr>
</table>
</body>
</html>
