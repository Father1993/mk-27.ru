<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

    <div class="container mt-3">
        <h1 class="reg-title">Регистрация: </h1>
        <!-- Навигация с вкладками -->
        <ul class="nav-tabs">
            <li>
                <a class="nav-link <? if($_GET["type"] == "personal" || !isset($_GET["type"])) { ?>active<? } ?>"
                   href="/personal_section/registration.php?type=personal">Физическое лицо</a>
            </li>
            <li>
                <a class="nav-link <? if($_GET["type"] == "legal") { ?>active<? } ?>"
                   href="/personal_section/registration.php?type=legal">Юридическое Лицо</a>
            </li>
        </ul>

        <!-- Контент вкладок -->
        <div class="tab-content">
            <? if($_GET["type"] == "personal" || !isset($_GET["type"])) { ?>
                <div class="faq-tab-pane">
                    <?$APPLICATION->IncludeComponent("bitrix:main.register",
                        "physregistration",
                        Array(
                            "USER_PROPERTY_NAME" => "",
                            "SEF_MODE" => "Y",
                            "SHOW_FIELDS" => Array(),
                            "REQUIRED_FIELDS" => Array(),
                            "AUTH" => "Y",
                            "USE_BACKURL" => "Y",
                            "SUCCESS_PAGE" => "/personal_section/index.php?SECTION=success",
                            "SET_TITLE" => "Y",
                            "USER_PROPERTY" => Array(),
                            "SEF_FOLDER" => "/",
                            "VARIABLE_ALIASES" => Array()
                        )
                    );?>
                </div>
            <? } ?>
            <? if($_GET["type"] == "legal") { ?>
                <div class="faq-tab-pane">
                    <?$APPLICATION->IncludeComponent("mk:main.register","urregistration",Array(
                            "USER_PROPERTY_NAME" => "Юридическое лицо:",
                            "SEF_MODE" => "Y",
                            "SHOW_FIELDS" => Array(),
                            "REQUIRED_FIELDS" => Array(),
                            "AUTH" => "Y",
                            "USE_BACKURL" => "Y",
                            "SUCCESS_PAGE" => "/personal_section/index.php?SECTION=success",
                            "SET_TITLE" => "Y",
                            "USER_PROPERTY" => ["UF_ISURFACE",
                                                "UF_ORGNAME",
                                                "UF_ORGINN",
                                                "UF_FIO",
                                                "UF_POST_ADDRESS",
                                                "UF_REALADDRESS",
                                                "UF_URADDRESS",
                                                "UF_HEAD_PHONE"],
                            "SEF_FOLDER" => "/",
                            "VARIABLE_ALIASES" => Array()
                        )
                    );?>
                </div>
            <? } ?>
        </div>
    </div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>