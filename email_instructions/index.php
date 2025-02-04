<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Инструкция по изменению подписи в почтовом клиенте (Email)");
$APPLICATION->SetAdditionalCSS ("/email_instructions/email_instructions.css");
$APPLICATION->AddHeadScript ("/email_instructions/email_instructions.js");
?>

<div class="page-main-block email-instructions">

	<h1>Инструкция по изменению подписи в почтовом клиенте (Email)</h1>
	
	<a href="/email_template.php" target="_blank">Ссылка на актуальный шаблон подписи ➜</a>
	
	<br>
	<br>
	
	<h4>Выберите каким почтовым клиентом вы пользуетесь. Яндекс или Mail.ru.</h4>
	
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="switcher-button switcher-button-yandex" onclick="changeEmailClient('yandex');">Яндекс</div>
			</div>
			<div class="col-3">
				<div class="switcher-button switcher-button-mail" onclick="changeEmailClient('mail');">Mail.ru</div>
			</div>
		</div>
	</div>
	
	<br>
	
	<div class="block block-yandex">
		
		<h5>1. Войдите в свой почтовый клиент. Нажмите на "шестерёнку" настроек.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_1.png">
		</div>
		
		<h5>2. Перейдите во "Все настройки".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_2.png">
		</div>
		
		<h5>3. Перейдите в "Личные данные".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_3.png">
		</div>
		
		<h5>4. Пролистайте вниз до конца страницы.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_4.png">
		</div>
		
		<h5>5. Перейдите по <a href="/email_template.php" target="_blank">ссылке на шаблон ➜ (клик сюда)</a>.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_5.png">
		</div>
		
		<h5>6. Зажмите на клавиатуре клавишу Ctrl (слева снизу) и нажмите клавишу "A". (Ctrl + A). Тем самым вы выделяете весь шаблон.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_6.png">
		</div>
		
		<h5>7. Копируйте, нажав "Ctrl + C" или кликом по выделенному тексту правой клавишей мыши, а потом, нажав кнопку "Копировать".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_7.png">
		</div>
		
		<h5>8. Кликните в любую область текущей подписи.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_8.png">
		</div>
		
		<h5>
			9. Выделите весь текст, нажав Ctrl + A. Удалите весь текст, нажав Del или ← Backspace.<br>
			9.1 Вставьте скопированный шаблон, нажав Ctrl + V. Либо кликом правой клавишей мыши в пустое поле, и нажав "Вставить".
		</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_9.png">
		</div>
		
		<h5>10. Пролистайте к началу подписи и измените "должность", "ФИО" и "Номер телефона + добавочный" на свои собственные.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_10.png">
		</div>
		
		<h5>11. После заполнения личных данных, нажмите "Сохранить".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_11.png">
		</div>
		
		<h5>12. Вернитесь в почту.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_12.png">
		</div>
		
		<h5>13. Нажмите "Написать" для создания нового письма.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_13.png">
		</div>
		
		<h5>14. Посмотрите, что подпись корректно добавлена.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/yandex_14.png">
		</div>
		
		<h5>15. Вы великолепны! 😊</h5>
		
	</div>
	
	<div class="block block-mail">
		
		<h5>1. Войдите в свой почтовый клиент. Нажмите "Настройки".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_1.png">
		</div>
		
		<h5>2. Перейдите во "Все настройки".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_2.png">
		</div>
		
		<h5>3. Перейдите в "Имя и подпись".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_3.png">
		</div>
		
		<h5>4. Нажмите на редактирование подписи.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_4.png">
		</div>
		
		<h5>
			5. Кликните 1 раз в любое место подписи. Зажмите на клавиатуре клавишу Ctrl (слева снизу) и нажмите клавишу "A". (Ctrl + A). Тем самым вы выделяете весь текст.<br>
			5.1 Удалите весь текст, нажав Del или ← Backspace.
		</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_5.png">
		</div>
		
		<h5>6. Перейдите по <a href="/email_template.php" target="_blank">ссылке на шаблон ➜ (клик сюда)</a>.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_6.png">
		</div>
		
		<h5>7. Выделите весь шаблон, нажав Ctrl + A.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_7.png">
		</div>
		
		<h5>8. Копируйте, нажав "Ctrl + C" или кликом по выделенному тексту правой клавишей мыши, а потом, нажав кнопку "Копировать".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_8.png">
		</div>

		<h5>9. Кликните в поле подписи. Вставьте скопированный шаблон, нажав Ctrl + V. Либо кликом правой клавишей мыши в пустое поле, и нажав "Вставить".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_9.png">
		</div>
		
		<h5>10. Пролистайте к началу подписи и измените "должность", "ФИО" и "Номер телефона + добавочный" на свои собственные.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_10.png">
		</div>
		
		<h5>11. После заполнения личных данных, нажмите "Сохранить".</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_11.png">
		</div>
		
		<h5>12. Вернитесь в почту.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_12.png">
		</div>
		
		<h5>13. Нажмите "Написать письмо" для создания нового письма.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_13.png">
		</div>
		
		<h5>14. Посмотрите, что подпись корректно добавлена.</h5>
		
		<div class="image-link">
			<img src="/email_instructions/images/mail_14.png">
		</div>
		
		<h5>15. Вы великолепны! 😊</h5>

	</div>
	
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>