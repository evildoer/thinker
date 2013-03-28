<?

## talk | db_type
## чтение/запись (файлов)
## ~редактирование/удаление

## возвращает массив строк файла
function read ($file) ## !== FALSE
{
	## file_get_contents()
	return @file ($file);
}

## возвращает количество записаных в файл байтов
function write ($file, $s, $m = 'w') ## !== FALSE
{
	## file_put_contents()
	if ($f = @fopen ($file, $m))
	{
		chmod ($file, 0777); ## !
		return @fwrite ($f, $s);
	}
	## fclose()?
}

function talk_path ($get)
{
	$path = explode ('.', $get);
	foreach ($path as &$s)
		$s = intval ($s);
	if ($path[0] == 0) ## root.
		array_shift ($path);
	return $path;
}

function talk_child ($path = array(), &$child = '')
{
	global $options;

	$parent_dir = $options['talk']['dir'];
	$parent_path = $path 
		? $path ## talk_path ($stream) 
		: $options['talk']['path'];
	$child_file = array_pop ($parent_path);

	if ($child_file)
	{
		$child = $parent_dir;
		foreach ($parent_path as $i)
			$child .= 's' . $i . '/';
		$child .= 't' . $child_file;
		return is_file ($child);
	}
	else
		return NULL;
}

function talk_think ($path = array()) ## talk_path()
{
	if (talk_child ($path, $child) === TRUE)
		if (($think = read ($child)) !== FALSE)
			return $think;
		else
			die ('Ошибка чтения мысли... '. $child);
	else
		return NULL;
}

function talk_stream ($path = array(), &$page = 0, &$pager = '')
{
	global $options;
	$stream = array();

	$dir = $options['talk']['dir'];
	foreach ($path as $i) $dir .= 's' . $i . '/';
	if (($list = read ($dir . 'list')) !== FALSE)
	{
		$list = array_reverse ($list);

		## pages
		$total = count ($list);
		$count = ceil ($total / ON_PAGE);
		$page  = $page ? $page : $count;
		$start = ($count - $page) * ON_PAGE;

		## foreach ($list as &$t)
		for ($i = $start; ($i < $start + ON_PAGE) && $list[$i]; $i++)
		{
			## $t = intval ($t);
			$t = intval ($list[$i]);

			$file = $dir . 't' . $t;
			if (($think = read ($file)) !== FALSE)
			{
				$subdir = $dir . 's' . $t . '/';
				if (is_dir ($subdir))
				{
					if (($sublist = read ($subdir . 'list')) !== FALSE)
						array_unshift ($think, count ($sublist));
					else
						die ('Ошибка чтения листа внутреннего потока... ' . $subdir . 'list');
				}
				else
					array_unshift ($think, 0); 

				$stream[$t] = $think;
			}
			else
				die ('Ошибка чтения мысли... ' . $file);
		}

		## pager
		if ($total > ON_PAGE)
		{
			$pager = 'Страницы: ';
			for ($i = $count; $i > 0; $i--)
			{
				$link = 
					$i != $page 
						? 
							'<a href="' . ($_GET['stream'] ? '?stream=' . $_GET['stream'] . '&' : '?') . 'page=' . $i . '"' . '>' . 
								$i . 
							'</a>' 
						: 
							$i;

				$pager .= 
					$i != 1 
						? $link . ', ' 
						: $link;
			}
		}
	}
	else
	{
		## новый поток
		if (talk_child() === FALSE)
			## потому что необходимо наличие родителя
			die ('Немыслимо.');
	}

	return $stream;
}

?>