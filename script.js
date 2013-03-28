// Inserts HTML line breaks before all newlines in a string
// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
function nl2br(str) {return str.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br />$2');}

function preview(f)
{
	document.getElementById('preview-name').innerHTML = f.name.value; // || 'имя'
	document.getElementById('preview-reply').innerHTML = f.reply.value; // nl2br()

	var ava = f.ava.value;// escape(), encodeURI(ava), encodeURIComponent()
	// var img = new Image();
	// img.onerror = function() {alert(1);}
	// try {img.src = ava;} catch(e) {ava = 'blackbox.gif'}
	if (ava)
	{
		document.getElementById('preview-ava').style.display = 'block';
		document.getElementById('preview-ava').src = ava; // onerror
		document.getElementById('preview-ava-url').href = ava;
	}
	else
	{
		document.getElementById('preview-ava').style.display = 'none';
		// document.getElementById('preview-ava').src = 'ava/default.png';
		// document.getElementById('preview-ava-url').href = 'ava/default.png';
	}

	return false;
}

function ins(f, t1, t2)
{
	t = f.reply;

	/*
	if (typeof t == 'string')
		t = document.getElementById(t);
	*/

	t.focus();
   if (document.selection)
	{
		var rng = document.selection.createRange();
		if (rng) // ?
			if (rng.text)
				document.selection.createRange().text = t1 + rng.text + t2;
			else
				document.selection.createRange().text = t1 + t2; // t.value += t1 + t2;
		else
			t.value += t1 + t2;
		t.focus();
	}
	else 
	if (t.selectionStart || t.selectionStart == '0')
	{
		var selStart = t.selectionStart;
		var selEnd = t.selectionEnd;
		var s = t.value;    
		s = s.substring(0, selStart) + t1 + s.substring(selStart, selEnd) + t2 + s.substring(selEnd, s.length);
		t.value = s;
		if (selEnd != selStart)
		{
			t.selectionStart = selStart;
			t.selectionEnd = selEnd + t1.length + t2.length;
		}
		else
		{
			t.selectionStart = selStart + t1.length;
			t.selectionEnd = t.selectionStart;
		}
	}
	else
		t.value += t1 + t2;  

	preview(f);
	return false;
}

window.onload = function()
{
	/*
	CKEDITOR.replace 
	(
		'reply', 
		{
			language: 'ru', 
			uiColor:  '#eee', 
			enterMode: CKEDITOR.ENTER_BR, 
			shiftEnterMode: CKEDITOR.ENTER_P, 
			toolbar: 'Full', 
			// skin: 'v2'
		}
	);
	*/
};
