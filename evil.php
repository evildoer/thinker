<?

## библиотечка
require ('dll.php');

/* константы */

## сайт
define ('URL_PATH', '/'); ## /blog/
## define ('ROOT_PATH', '/var/www/clients/client6/web18/web/'); ## ?

## база данных
define ('db_type', 'file');
define ('db_dir',  'db');

## мегапароль
define ('MEGA_PASS', 'lthgfhjk'); ## дерпарол

## аватар по-умолчанию ## + /script.js!
define ('AVA_DEFAULT', 'ava/default.png');

## страницы
define ('ON_PAGE', 10);

/* значения */
$options = array();

## общение
$options['talk'] = array();
$options['talk']['dir'] = db_dir . '/talk/';

$options['talk']['type'] = $_GET['think'] ? 'think' : 'stream';
$options['talk']['path'] = talk_path ($_GET[$options['talk']['type']]);

## родители и дети
$options['talk']['parent'] = $options['talk']['path']; ## think
$options['talk']['child'] = array_pop ($options['talk']['parent']);

## сумма мыслей
if (is_file ($options['talk']['dir'] . 'last'))
	if (($last = read ($options['talk']['dir'] . 'last')) !== FALSE)
		$options['talk']['last'] = intval ($last[0]);
	else
		die ('Ошибка чтения последнего номера...' . $options['talk']['dir'] . 'last');
else
	if (write ($options['talk']['dir'] . 'last', 0) === FALSE)
		die ('Ошибка записи последнего номера...' . $options['talk']['dir'] . 'last');

?>
