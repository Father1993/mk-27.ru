<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?>

<div class="container mt-3">
  <h1 class="reg-title">Регистрация</h1>
  <!-- Навигация с вкладками -->
  <ul class="nav nav-tabs mb-4">
    <li class="nav-item">
      <a class="nav-link <?=(!isset($_GET["type"]) || $_GET["type"] == "personal") ? "active" : ""?>"
        href="?type=personal">Физическое лицо</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?=($_GET["type"] == "legal") ? "active" : ""?>" href="?type=legal">Юридическое лицо</a>
    </li>
  </ul>

  <!-- Контент вкладок -->
  <div class="tab-content">
    <?if (!isset($_GET["type"]) || $_GET["type"] == "personal"):?>
    <div class="tab-pane fade show active">
      <?$APPLICATION->IncludeComponent(
        "bitrix:main.register",
        "myUsers",
        Array(
          "AUTH" => "Y",
          "REQUIRED_FIELDS" => array("EMAIL", "NAME", "LAST_NAME", "PERSONAL_PHONE"),
          "SET_TITLE" => "N",
          "SHOW_FIELDS" => array("EMAIL", "NAME", "LAST_NAME", "PERSONAL_PHONE"),
          "SUCCESS_PAGE" => "/auth/personal.php",
          "USER_PROPERTY" => array(),
          "USER_PROPERTY_NAME" => "",
          "USE_BACKURL" => "Y"
        )
      );?>
    </div>
    <?endif?>

    <?if ($_GET["type"] == "legal"):?>
    <div class="tab-pane fade show active">
      <?$APPLICATION->IncludeComponent(
        "bitrix:main.register",
        "mySpecUsers",
        Array(
          "AUTH" => "Y",
          "REQUIRED_FIELDS" => array("LOGIN", "EMAIL", "UF_ORGINN", "UF_ORGNAME", "UF_URADDRESS", "UF_HEAD_PHONE", "UF_FIO"),
          "SET_TITLE" => "N",
          "SHOW_FIELDS" => array("LOGIN", "EMAIL", "PERSONAL_PHONE"),
          "SUCCESS_PAGE" => "/auth/personal.php",
          "USER_PROPERTY" => array(
            "UF_ORGNAME",
            "UF_ORGINN",
            "UF_KPP",
            "UF_URADDRESS",
            "UF_HEAD_PHONE",
            "UF_FIO",
            "UF_POST_ADDRESS",
            "UF_REALADDRESS"
          ),
          "USER_PROPERTY_NAME" => "Данные организации",
          "USE_BACKURL" => "Y"
        )
      );?>
    </div>
    <?endif?>
  </div>
</div>

<style>
.nav-tabs {
  border-bottom: 1px solid #dee2e6;
  margin-bottom: 2rem;
}

.nav-tabs .nav-link {
  margin-bottom: -1px;
  border: 1px solid transparent;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
  padding: 0.75rem 1.5rem;
  color: #6c757d;
}

.nav-tabs .nav-link:hover {
  border-color: #e9ecef #e9ecef #dee2e6;
  color: #495057;
}

.nav-tabs .nav-link.active {
  color: #495057;
  background-color: #fff;
  border-color: #dee2e6 #dee2e6 #fff;
  font-weight: 500;
}

.reg-title {
  font-size: 2rem;
  margin-bottom: 2rem;
  color: #333;
}

.tab-content {
  background: #fff;
  border-radius: 0.5rem;
  padding: 2rem;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

@media (max-width: 768px) {
  .nav-tabs .nav-link {
    padding: 0.5rem 1rem;
  }

  .tab-content {
    padding: 1rem;
  }
}
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>