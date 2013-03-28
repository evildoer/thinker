<?

## злобный движок
require ('evil.php');

$location = 
	URL_PATH . ## '/?' . 
	(
		$_POST['stream'] 
			? 
				'?' . 
					'stream' . 
				'=' . 
					$_POST['stream'] 
			: ''
	);

if ($_POST['talk_insert'])
{
	## check
	if ($_POST['pass'] == MEGA_PASS && $_POST['bot'] == 'нет')
	{
		$dir = $options['talk']['dir'];
		$path = talk_path ($_POST['stream']);
		foreach ($path as $i) $dir .= 's' . $i . '/';

		if (talk_child ($path) !== FALSE)
		{
			## die ($dir);
			if (!is_dir ($dir))
				if (!mkdir ($dir, 0777)) ## !
					die ('Ошибка создания внутреннего потока... ' . $dir);

			$last = ++$options['talk']['last'];
			if (write ($options['talk']['dir'] . 'last', $last) === FALSE)
				die ('Ошибка записи последнего номера...' . $options['talk']['dir'] . 'last');

			if (write ($dir . 'list', $last . "\n", 'a') === FALSE)
				die ('Ошибка записи листа...' . $dir . 'list');

			$user  = intval ($_POST['user']); ## 1.
			$name  = $_POST['name'];
			$ava   = $_POST['ava'];
			$date  = date('d.m.Y');
			$reply = $_POST['reply'];
			$think = 
				$user . "\n" . 
				$name . "\n" . 
				$ava  . "\n" . 
				$date . "\n" . 
				$reply;

			if (write ($dir . 't' . $last, $think) === FALSE)
				die ('Ошибка записи мысли...' . $dir . 't' . $last);

		}
		else
			die ('Немыслимо.');
	}
	else
		## die ('sorry:<br />' . htmlspecialchars ($_POST['reply']));
		die ($_POST['reply']); ## ?
}
else 
if ($_GET['talk_update'])
	die ('talk_edit');
else 
if ($_GET['talk_delete'])
	die ('talk_delete');
else
	die ('none');

header 
(
	'Location: ' . $location
);

?>
