<? require ('evil.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>&laquo;потоки сознания&raquo;</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link type="text/css" rel="stylesheet" media="all" href="style.css" />
	<!--[if IE]><link rel="stylesheet" type="text/css" href="ie.css"><![endif]-->
	<!-- http://vkontakte.ru/editapp?id=2473830&section=options | VK API 2473830 -->
	<!--<script type="text/javascript" src="out/ckeditor/ckeditor.js"></script>-->
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<div id="wrapper">

	<h1>&laquo;<a href="<?=URL_PATH;?><? if ($options['talk']['parent']) echo '?stream=' . implode ('.', $options['talk']['parent']); ?>">потоки сознани<? if ($options['talk']['type'] == 'stream'): ?></a><a href="<?=URL_PATH;?>?<?=($_GET['stream'] ? 'stream' . '=' . $_GET['stream'] : '') . ($_GET['pass'] ? '' :'&pass=' . MEGA_PASS); ?>"><? endif; ?><span class="red">я</span></a>&raquo; <?=$options['talk']['path'] ? '<a href="' . URL_PATH . ($options['talk']['parent'] ? '?stream=' . implode ('.', $options['talk']['parent']) : '') . '">по&uarr;</a>' : '';?></h1>

		<div id="hidden"><div>&middot;</div></div>

		<div id="sidebar">
			<div class="box">
				<div class="boxHead">известия</div>
				<div class="boxBody">
					<p align="center">Версия думающего движка 0.002.</p>
					<p align="center">Что бы <em>подумать</em> нажмите на <span class="red"><b>себя</b></span> в заголовке.</p>
					<p align="center"><a href="/?stream=31">Рассказик</a> не окончен.</p>
					<p align="center"><a href="/forum">Форум</a> тоже.</p>
				</div>
			</div>

			<div class="box">
				<div class="boxHead">нас посчитали</div>
				<div class="boxBody">
<p align="center">
<!--Rating@Mail.ru counter-->
<script language="javascript"><!--
d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
<script language="javascript1.1"><!--
a+=';j='+navigator.javaEnabled();js=11;//--></script>
<script language="javascript1.2"><!--
s=screen;a+=';s='+s.width+'*'+s.height;
a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>
<script language="javascript1.3"><!--
js=13;//--></script><script language="javascript" type="text/javascript"><!--
d.write('<a href="http://top.mail.ru/jump?from=1995960" target="_top">'+
'<img src="http://d4.c7.be.a1.top.mail.ru/counter?id=1995960;t=56;js='+js+
a+';rand='+Math.random()+'" alt="Рейтинг@Mail.ru" border="0" '+
'height="31" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>
<noscript><a target="_top" href="http://top.mail.ru/jump?from=1995960">
<img src="http://d4.c7.be.a1.top.mail.ru/counter?js=na;id=1995960;t=56" 
height="31" width="88" border="0" alt="Рейтинг@Mail.ru"></a></noscript>
<script language="javascript" type="text/javascript"><!--
if(11<js)d.write('--'+'>');//--></script>
<!--// Rating@Mail.ru counter-->
</p>
				</div>
			</div>
		</div>

		<div class="containers">
		<?
			function reply_render ($preview = FALSE)
			{
				global $i, $t, $n, $u, $name, $ava, $date, $reply;

				if ($preview)
				{
					global $options;

					$i = 1;
					$t = $options['talk']['last'] + 1;
					$n = 0;
					$u = 1;
					$name = '';
					$ava = '';
					$date = date('d.m.Y');
					$reply = '';

					$preview_name    = ' id="preview-name"';
					$preview_reply   = ' id="preview-reply"';

					$preview_ava_url = ' id="preview-ava-url"';
					$preview_ava = 
						' id="preview-ava"' . 
						' style="display: none;"';
				}

				if ($_GET['think'])
					$path = $_GET['think'];
				else 
				if ($_GET['stream'])
					$path = $_GET['stream'] . ($n !== NULL ? '.' . $t : '');
				else ## root.
					$path = $t;

				$parity = 'odd';
				## $parity = $i++ % 2 ? 'odd' : 'even';
				## if (!$ava) $ava = AVA_DEFAULT;
				$preview_ava_onerror = 
					' onerror="this.style.display=\'none\';"';
						## $ava_default = AVA_DEFAULT;
						## this.src=\'' . $ava_default . '\'
				$stream = 
					($n !== NULL) 
						? 
							'<a href="?stream=' . $path . '">мысли на эту тему</a> &rarr; ' . $n 
						:
							'';

return <<< REPLY
<table class="container {$parity}">
<tr><td colspan="2" class="head">
	<span class="name"{$preview_name}>{$name}</span>
	<div><a href="?think={$path}">#$path</a></div>
</td></tr>
<tr>
	<td class="info">
		<a href="{$ava}"{$preview_ava_url}>
			<img src="{$ava}"{$preview_ava}{$preview_ava_onerror} />
		</a>
	</td>
	<td class="reply"><div class="html"{$preview_reply}>{$reply}</div></td>
</tr>
<tr class="link">
	<td class="date">{$date}</td>
	<td class="menu">
		<!--<a href="#">забыть</a> &middot; -->
		<!--<a href="#">передумать</a> &middot; -->
		{$stream}
	</td>
</tr>
</table>
REPLY;

			}
		?>

		<? if ($_GET['pass'] == MEGA_PASS): ?>
			<table class="container odd replying">
			<form method="post" action="doer.php">
			<tr><td colspan="2" class="head">
				<span class="name">&nbsp;</span>
				<div>новая мысль</div>
			</td></tr>
			<tr>
				<td class="info">
					именование:<br /><input type="text" name="name" maxlength="140" onkeyup="preview(this.form);" tabindex="1" /><br />
					<!--пароль:<br /><input type="password" name="pass" maxlength="140" onkeyup="preview(this.form);" /><br />-->
					олицетворение:<br /><input type="text" name="ava" maxlength="140" onkeyup="preview(this.form);" tabindex="2" /><br />
					<span class="small"><em>прямая ссылка на картинку (~150px)</em></span><br /><br />
					<span class="small2">Чистый HTML,<br />пожалуйста &rarr;</span>
				</td>
				<td class="reply">
					<button onclick="return ins(this.form, '<p>', '</p>');" title="Отметить параграф"><span style="line-height: 20px; vertical-align: bottom;">P</span></button><button onclick="return ins(this.form, '<blockquote>', '</blockquote>');" title="Отметить цитату"><span style="line-height: 20px; vertical-align: bottom;">Q</span></button><button onclick="return ins(this.form, '<code>', '</code>');" title="Отметить код"><span style="line-height: 20px; vertical-align: bottom;">C</span></button>
					<button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon1.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon6.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon4.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon2.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon3.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon9.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon7.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon5.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon14.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon8.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon11.gif" /></button><button onclick="return ins(this.form, this.innerHTML, '');"><img src="sm/best/icons/icon13.gif" /></button>
					<button onclick="return ins(this.form, '<br />\n', '');" title="Перенос на новую строку">
						<span style="line-height: 20px; vertical-align: bottom;">&crarr;</span>
					</button>
					<br />
					<textarea id="reply" name="reply" onkeyup="preview(this.form);" tabindex="3"></textarea>
					<input type="hidden" name="user" value="1" /><!-- check -->
					<input type="hidden" name="pass" value="<?=$_GET['pass'];?>" />
					<input type="hidden" name="stream" value="<?=$_GET['stream'];?>" />
					<input type="hidden" name="talk_insert" value="do" />
				</td>
			</tr>
			<tr class="link">
				<td class="date">&nbsp;</td>
				<td class="menu">
					<div style="text-align: right;">
						...вы <span class="red"><b>бoт</b></span>? <input type="text" name="bot" maxlength="140" style="width: 33px;" tabindex="4" /> 
						, тогда закончите мысль, нажав <input type="submit" value="точку." style="width: 100px;" tabindex="5" />
					</div>
				</td>
			</tr>
			</form>
			</table>
			<? print reply_render (TRUE); ?>
		<? endif; ?>

		<?
			if ($options['talk']['type'] == 'think')
			{
				if (($think = talk_think()) !== NULL)
				{
					$i = 1; $t = 0; $n = NULL;
					$u = intval (array_shift ($think));
					$name  = trim (array_shift ($think));
					$ava   = trim (array_shift ($think));
					$date  = trim (array_shift ($think));
					$reply = implode ('', $think);
						print reply_render();
				}
				else
					die ('Немыслимо.');
			}
			else
			{
				$page = intval ($_GET['page']);
				$stream = talk_stream 
				(
					$options['talk']['path'], 
						&$page, &$pager
				);

				if ## добавление порождающей мысли на первую страницу
				(
					($think = talk_think()) !== NULL 
								&& 
					($page == 1 || !$page)
				)
				{
					array_unshift ($think, NULL);
					$stream[0] = $think; /* child */
				}

				$i = 1;
				foreach ($stream as $t => $think)
				{
					## $i & $t & ...
					$n = array_shift ($think); ##
					$u = intval (array_shift ($think)); ##
					$name  = trim (array_shift ($think));
					$ava   = trim (array_shift ($think));
					$date  = trim (array_shift ($think));
					$reply = implode ('', $think);
						print reply_render();
				}

				if ($pager) print '<center>' . $pager . '</center>';
			}
		?>

		<div id="copyleft">evil &copy; злобные разработки</div>

		</div>
	</div>

</body>
</html>
