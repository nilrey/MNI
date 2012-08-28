<?php
$arMenu = array(

array(
'name'=> 'ИНФОРМАЦИЯ',
'url'=> array('/'),
'level'=> '1',
'use_params_to_select'=> 'N',
'granted_groups' => array(2),

),
	array(
	'name'=> 'Новости',
	'url'=> array('/news/'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(2),

	),
array(
'name'=> 'КАБИНЕТ ПОЛЬЗОВАТЕЛЯ',
'url'=> array('/personal/login.php'),
'level'=> '1',
'use_params_to_select'=> 'N',
'granted_groups' => array(2),

),


array(
	'name'=> 'Морские научные исследования',
	'url'=> array('/zod/zod_exp_list.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 11, 12, 13, 14, 15),
),
	array(
	'name'=> 'Список МНИ',
	'url'=> array('/zod/zod_exp_list.php', '/zod/zod_exp_item.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 11, 12, 13, 14, 15),
	),

	array(
	'name'=> 'Запросы',
	'url'=> array(''),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(3, 4),
	),
	array(
	'name'=> 'Список МНИ',
	'url'=> array('/personal/mni_list.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(3),
	),
	array(
	'name'=> 'Список запросов',
	'url'=> array('/personal/applies_list.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(3),
	),
	array(
	'name'=> 'Создать запрос',
	'url'=> array('/personal/apply.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(3),
	),

	array(
	'name'=> 'Список МНИ',
	'url'=> array('/mon/mni_list.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(4),
	),
	array(
	'name'=> 'Список запросов',
	'url'=> array('/mon/mon_exp_list.php', '/mon/mon_exp_item.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(4),
	),

	array(
	'name'=> 'Авторизация',
	'url'=> array('/personal/login.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(2),
	),
	array(
	'name'=> 'Профиль',
	'url'=> array('/personal/profile.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 11, 12, 13, 14, 15),
	),
	array(
	'name'=> 'Регистрация',
	'url'=> array('/personal/registration.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(2),

	),

array(
'name'=> 'ПЛАНЫ МОРСКИХ ИССЛЕДОВАНИЙ',
'url'=> array('/mni/index.php'),
'level'=> '1',
'use_params_to_select'=> 'N',
'granted_groups' => array(2),

),

	array(
	'name'=> 'Список морских экспедиций',
	'url'=> array('/mni/index.php', '/mni/expedition.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(2),
	),
	array(
	'name'=> 'Поиск морских экспедиций',
	'url'=> array('/mni/search.php'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(2),
	),

array(
'name'=> 'АДМИНИСТРИРОВАНИЕ',
'url'=> array('/settings/'),
'level'=> '1',
'use_params_to_select'=> 'N',
'granted_groups' => array(1),

),
	array(
	'name'=> 'Группы',
	'url'=> array('/settings/groups/'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Список групп',
	'url'=> array('/settings/groups/list.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Добавить группу',
	'url'=> array('/settings/groups/editgroup.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),
	),
	array(
	'name'=> 'Пользователи',
	'url'=> array('/settings/users/'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Список пользователей',
	'url'=> array('/settings/users/list.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Добавить пользователя',
	'url'=> array('/settings/users/edituser.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),
	),
	array(
	'name'=> 'Справочники',
	'url'=> array('/settings/refbooks/'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Ведомства',
	'url'=> array('/settings/refbooks/departments.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Организации',
	'url'=> array('/settings/refbooks/organizations.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Порты',
	'url'=> array('/settings/refbooks/ports.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),
	),
	array(
	'name'=> 'Суда',
	'url'=> array('/settings/refbooks/ships.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),
	),
	array(
	'name'=> 'Страны',
	'url'=> array('/settings/refbooks/countries.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),
	),

	array(
	'name'=> 'Дополнительно',
	'url'=> array('/settings/support/'),
	'level'=> '2',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),
	array(
	'name'=> 'Группы и виды морских исследований',
	'url'=> array('/settings/support/groups_mnitype.php'),
	'level'=> '3',
	'use_params_to_select'=> 'N',
	'granted_groups' => array(1),

	),


);

?>