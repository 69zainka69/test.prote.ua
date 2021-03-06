<?php

$_ =  array(
	'heading_title' => 'Увійти за допомогою:',

	'text_login_fb' => 'Увійти через Facebook',
	'text_login_g' => 'Увійти через Gmail',
	'ulogin_add_account_success' => 'Аккаунт успішно доданий',
	'ulogin_db_error' => 'Помилка при роботі з БД.',

	'ulogin_verify' => 'Підтвердження облікового запису.',
	'ulogin_verify_text' => 'Електронна адреса даного облікового запису збігається з адресою електронної пошти існуючого користувача.<br>Необхідно підтвердити на володіння зазначеним email.',

	'ulogin_synch' => 'Синхронізація акаунтів.',
	'ulogin_synch_text' => "З даними акаунтом вже пов'язані дані з іншої соціальної мережі. <br>Потрібно прив'язка нового облікового запису соціальної мережі до цього аккаунту.",

	'ulogin_reg_error' => 'Помилка при реєстрації.',
	'ulogin_reg_error_text' => 'Виникла помилка при реєстрації користувача.',

	'ulogin_auth_error' => 'Виникла помилка при авторизації.',
	'ulogin_add_account_error' => 'Не вдалося записати дані про акаунт.',
	'ulogin_no_token_error' => 'Не был одержаний токен uLogin.',
	'ulogin_no_user_data_error' => 'Не вдалося отримати данні про користувача за допомогою токена.',
	'ulogin_wrong_user_data_error' => 'Дані про користувача містять невірний формат.',
	'ulogin_host_address_error' => '<i>ERROR</i>: адрес хоста не совпадает с оригиналом %s',
	'ulogin_token_expired_error' => '<i>ERROR</i>: время жизни токена истекло',
	'ulogin_invalid_token_error' => '<i>ERROR</i>: неверный токен',
	'ulogin_no_variable_error' => 'В возвращаемых данных отсутствует переменная <b>%s</b>',

	'ulogin_account_not_available' => 'Данный аккаунт привязан к другому пользователю. </br>Вы не можете использовать этот аккаунт',

	'ulogin_delete_account_success' => 'Удаление аккаунта %s успешно выполнено',
	'ulogin_delete_account_error' => 'Ошибка при удалении аккаунта',

	'ulogin_back_url' => 'Вернуться',

	'ulogin_account_inactive' => 'Аккаунт создан. Тем не менее, требуется активация аккаунта, ссылка для активации выслана на адрес электронной почты <b>%s</b>',

	'ulogin_read_response_error' => 'Невозможно получить данные.',
	'ulogin_read_response_error_text' => 'Для получения данных должен быть curl или file_get_contents.',

	'ulogin_login_error' => 'Получен неверный ID пользователя',

	'ulogin_profile_title'   => 'Социальные сети',
	'add_account'            => 'Социальные сети',
	'add_account_explain'    => 'Привяжите аккаунты соцсетей, кликнув по значку',
	'delete_account'         => 'Привязанные аккаунты',
	'delete_account_explain' => 'Удалите привязку к аккаунту, кликнув по значку',

	'admin_ulogin_title'          => 'uLogin',
	'admin_ulogin_title_explain'  => '
<p><a href="http://ulogin.ru" target="_blank">uLogin</a> — это инструмент, который позволяет пользователям получить единый доступ к различным Интернет-сервисам без необходимости повторной регистрации,
	а владельцам сайтов — получить дополнительный приток клиентов из социальных сетей и популярных порталов (Google, Яндекс, Mail.ru, ВКонтакте, Facebook и др.)</p>

<p>Чтобы создать свой виджет для входа на сайт достаточно зайти в Личный Кабинет (ЛК) на сайте <a href="http://ulogin.ru/lk.php" target="_blank">uLogin</a>,
	добавить свой сайт к списку "Мои сайты" и на вкладке "Виджеты" добавить новый виджет. Вы можете редактировать свой виджет самостоятельно.</p>

<p><b style="color: red;">Важно! </b>Для успешной работы плагина необходимо включить в обязательных полях профиля поле <b>Еmail</b> в Личном кабинете uLogin.</p><br/>

<p>Здесь Вы можете указать значение параметра "<b>uLogin ID</b>" Ваших виджетов.</p>',
	'admin_uloginid'                 => 'Значение поля uLogin ID',
	'admin_uloginid1'                => 'Значение поля uLogin ID №1',
	'admin_uloginid1_explain'        => 'Идентификатор виджета в окне входа и регистрации. Пустое поле - виджет по умолчанию.',
	'admin_uloginid2'                => 'Значение поля uLogin ID №2',
	'admin_uloginid2_explain'        => 'Идентификатор виджета в шапке сайта. Пустое поле - виджет по умолчанию.',
	'admin_uloginid_profile'         => 'Значение поля uLogin ID профиля пользователя',
	'admin_uloginid_profile_explain' => 'Идентификатор виджета в профиле пользователя. Пустое поле - виджет по умолчанию.',
	'ulogin_save'                    => 'Сохранить',
);