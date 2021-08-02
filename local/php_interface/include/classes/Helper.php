<?php
namespace SouthCoast\Handler\Main;

use Bitrix\Main\Loader as Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Iblock as Iblock,
    Bitrix\Main\Page\Asset;

define("INCLUDE_AREA_PATH","/local/include/southcoast/include_areas/");
define("IBLOCK_ID_ABHAZIA",28);


define("NO_PHOTO",'/upload/iblock/225/_-_-_-_-_.jpg');

class Helper
{

    function init() {
        Asset::getInstance()->addJs("/local/templates/.default/js/jquery.maskedinput.min.js");
        Asset::getInstance()->addJs("/local/templates/.default/js/custom.js");
        Asset::getInstance()->addCss("/local/templates/.default/css/custom.css");

        if (ADMIN_SECTION !== true)
        Asset::getInstance()->addCss("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");
    }

    static function generatePassword($length = 8) {

        return randString($length, array(
            "abcdefghijklnmopqrstuvwxyz",
            "ABCDEFGHIJKLNMOPQRSTUVWX­YZ",
            "0123456789",
            "!@#\$%^&*()",
        ));

    }

    static function getCountries() {
        $result = [
            'getRegions' => 'Россия',
            'getCities' => 'Абхазия',
        ];

        return $result;
    }

    static function getRegions() {

        Loader::includeModule("iblock");
        $arSort = [
            'SORT'=>'ASC',
            'NAME'=>'ASC'
        ];
        $arFilter = [
            'TYPE' => 'catalog',
            '!=ID' => [41,28],
            'ACTIVE' => 'Y',
        ];
        $arSelect = ['ID','NAME'];

        $rs = \CIblock::GetList($arSort,$arFilter,false,false,$arSelect);
        while($iblock = $rs->Fetch()) {
            $result[$iblock['ID']] = $iblock;
        }

        return $result;
    }

    static function getCities($iblockID) {

        if(empty($iblockID))
            $iblockID = IBLOCK_ID_ABHAZIA;

        Loader::includeModule("iblock");
        $arSort = [
            'SORT'=>'ASC',
            'NAME'=>'ASC'
        ];
        $arFilter = [
            'IBLOCK_ID' => $iblockID,
            'DEPTH_LEVEL' => 1,
            'ACTIVE' => 'Y',
        ];


        $rs = \CIblockSection::GetList($arSort,$arFilter);
        $parent = $rs->Fetch();

        $arFilter = [
            'IBLOCK_ID' => $iblockID,
            'DEPTH_LEVEL' => 2,
            'SECTION_ID' => $parent['ID'],
            'ACTIVE' => 'Y',
            '!=CODE' => 'inform'
        ];
        $rs = \CIblockSection::GetList($arSort,$arFilter,false);
        while($section = $rs->Fetch()) {
            $result[] = $section;
        }
        return $result;
    }


    static function getInfo($iblock) {

        Loader::includeModule("iblock");
        $arSort = [
            'SORT'=>'ASC',
            'NAME'=>'ASC'
        ];
        $arFilter = [
            'TYPE' => 'catalog',
            '=ID' => $iblock,
            'ACTIVE' => 'Y',
        ];
        $arSelect = ['ID','NAME'];

        if($iblock==IBLOCK_ID_ABHAZIA) {
            $result = [
                'COUNTRY' => 'Абхазия',
                'REGION' => false,
            ];
        }
        else {
        $rs = \CIblock::GetList($arSort,$arFilter,false,false,$arSelect);
        while($iblock = $rs->Fetch()) {

                $result = [
                    'COUNTRY' => 'Россия',
                    'REGION' => $iblock['NAME'],
                ];

        }

        }
        return $result;
    }

    public static function getB24ID($uid = false) {

        global $USER;
        if($_SESSION['USER_ID'])
            $uid = $_SESSION['USER_ID'];

        if(!$uid)
            $uid = $USER->GetID();

        if($_SESSION['B24_ID'])
            $result = $_SESSION['B24_ID'];
        else {
            $rsUser = \CUser::GetByID($uid);
            $arUser = $rsUser->Fetch();
            $result = $_SESSION['B24_ID'] = $arUser['UF_B24_ID'];

        }

        return $result;
    }

    public static function getB24Info($uid = false) {

        global $USER;
        if($_SESSION['USER_ID'])
            $uid = $_SESSION['USER_ID'];

        if(!$uid)
            $uid = $USER->GetID();

        if($_SESSION['B24_INFO'])
            $result = $_SESSION['B24_INFO'];
        else {
            $rsUser = \CUser::GetByID($uid);
            $arUser = $rsUser->Fetch();
            $result = $_SESSION['B24_INFO'] = [
                'B24_ID' => $arUser['UF_B24_ID'],
                'NAME' => $arUser['NAME'],
                'PHONE' => $arUser['PERSONAL_PHONE'],
                'EMAIL' => $arUser['EMAIL'],

            ];

        }

        return $result;
    }

    public static function getCityName($id) {

        $rs = \CIBlockSection::GetByID($id);
        if($section = $rs->GetNext())
            return $section['NAME'];

    }

    public static function getUserInfo($id,$email=false) {

        $filter = [];
        if($id)
        $filter["ID"] = $id;
        if($email)
            $filter["EMAIL"] = $email;

        $rs = \CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);

        if($user = $rs->GetNext()) {
            $user['USER_ID'] = $user['ID'];
        }
        else $user = false;
            return $user;

    }

}
