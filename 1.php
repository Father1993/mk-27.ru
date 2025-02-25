<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестирование почты");
?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <h3>Тест стандартной отправки почты</h3>
        </div>
        <div class="card-body">
          <?php
                    if ($_POST['test_mail'] == 'Y') {
                        // Создаем тестовое событие
                        $arEventFields = array(
                            "EMAIL_TO" => "enjoy_hill@mail.ru",
                            "SUBJECT" => "Тестовое письмо Bitrix",
                            "MESSAGE" => "Это тестовое письмо отправлено через стандартную систему Bitrix.",
                        );
                        
                        // Отправляем письмо через систему событий Bitrix
                        if (CEvent::Send("TEST_EMAIL", SITE_ID, $arEventFields)) {
                            echo '<div class="alert alert-success">Тестовое письмо успешно отправлено</div>';
                        } else {
                            echo '<div class="alert alert-danger">Ошибка при отправке тестового письма</div>';
                        }
                    }
                    ?>
          <form method="post">
            <input type="hidden" name="test_mail" value="Y">
            <button type="submit" class="btn btn-primary">Отправить тестовое письмо</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3>Тест восстановления пароля</h3>
        </div>
        <div class="card-body">
          <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.forgotpasswd",
                        "",
                        Array(
                            "FORGOT_PASSWORD_URL" => "",
                            "PROFILE_URL" => "",
                            "REGISTER_URL" => "",
                            "SHOW_ERRORS" => "Y"
                        )
                    );
                    ?>
        </div>
      </div>
    </div>
  </div>

  <?php
    // Выводим текущие настройки почты из административной панели
    if ($USER->IsAdmin()):
        $smtp_server = COption::GetOptionString("main", "smtp_server", "");
        $smtp_port = COption::GetOptionString("main", "smtp_port", "");
        $smtp_use_tls = COption::GetOptionString("main", "smtp_use_tls", "");
    ?>
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3>Текущие настройки почты (видно только администраторам)</h3>
        </div>
        <div class="card-body">
          <pre>
Настройки SMTP:
- Сервер: <?= htmlspecialchars($smtp_server) ?>
- Порт: <?= htmlspecialchars($smtp_port) ?>
- Использование TLS: <?= $smtp_use_tls ? 'Да' : 'Нет' ?>

Для изменения настроек перейдите в:
Настройки > Настройки продукта > Настройки модулей > Главный модуль > Настройки почтовой системы
(или по адресу /bitrix/admin/settings.php?mid=main&lang=ru)
                    </pre>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php
// Создаем почтовое событие TEST_EMAIL, если оно не существует
$eventType = new CEventType;
$eventTypeExists = $eventType->GetList(array("TYPE_ID" => "TEST_EMAIL"))->Fetch();

if (!$eventTypeExists) {
    $eventType->Add(array(
        "LID" => "ru",
        "EVENT_NAME" => "TEST_EMAIL",
        "NAME" => "Тестовое письмо",
        "DESCRIPTION" => "#EMAIL_TO# - Email получателя\n#SUBJECT# - Тема письма\n#MESSAGE# - Текст письма"
    ));

    // Создаем почтовый шаблон
    $eventMessage = new CEventMessage;
    $eventMessage->Add(array(
        "ACTIVE" => "Y",
        "EVENT_NAME" => "TEST_EMAIL",
        "LID" => SITE_ID,
        "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
        "EMAIL_TO" => "#EMAIL_TO#",
        "SUBJECT" => "#SUBJECT#",
        "BODY_TYPE" => "text",
        "MESSAGE" => "#MESSAGE#"
    ));
}
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>