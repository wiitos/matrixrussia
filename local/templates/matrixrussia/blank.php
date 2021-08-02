
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file","PATH" => SITE_DIR."include/default.php"), false);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "",
    array(
        "ROOT_MENU_TYPE" => "top",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "36000000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_THEME" => "site",
        "CACHE_SELECTED_ITEMS" => "N",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "3",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
    ),
    false
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "",
    Array(
        "HIDE_ON_BASKET_PAGES" => "Y",
        "PATH_TO_AUTHORIZE" => "",
        "PATH_TO_BASKET" => SITE_DIR."basket/",
        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
        "PATH_TO_PROFILE" => SITE_DIR."personal/",
        "PATH_TO_REGISTER" => SITE_DIR."login/",
        "POSITION_FIXED" => "N",
        "SHOW_AUTHOR" => "N",
        "SHOW_EMPTY_VALUES" => "Y",
        "SHOW_NUM_PRODUCTS" => "Y",
        "SHOW_PERSONAL_LINK" => "N",
        "SHOW_PRODUCTS" => "N",
        "SHOW_REGISTRATION" => "N",
        "SHOW_TOTAL_PRICE" => "Y"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "",
    Array(
        "CATEGORY_0" => array("iblock_catalog"),
        "CATEGORY_0_TITLE" => "Каталог",
        "CATEGORY_0_iblock_catalog" => array("1"),
        "CATEGORY_1" => array("iblock_content"),
        "CATEGORY_1_TITLE" => "Статьи",
        "CATEGORY_1_iblock_content" => array("4","5"),
        "CHECK_DATES" => "N",
        "CONTAINER_ID" => "title-search",
        "INPUT_ID" => "title-search-input",
        "NUM_CATEGORIES" => "2",
        "ORDER" => "date",
        "PAGE" => "#SITE_DIR#catalog/index.php",
        "SHOW_INPUT" => "Y",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "Y"
    )
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "incbefore",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "universal",
    array(
        "START_FROM" => "0",
        "PATH" => "",
        "SITE_ID" => "-"
    ),
    false,
    Array('HIDE_ICONS' => 'Y')
);?>
