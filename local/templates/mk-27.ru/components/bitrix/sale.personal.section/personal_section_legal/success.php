<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}

if(COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y") { ?>
    <div class="success-block">
        <div class="success-block-note">Вы успешно зарегистрировались на нашем сайте. Осталось только подтвердить регистрацию, перейдя по ссылке, которую мы выслали вам на указанный при регистрации e-mail.</div>
    </div>

<? }

