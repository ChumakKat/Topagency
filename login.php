<?php
session_start();
$pass='admintop'; // Пароль для входа в Админку
$adm=0; // Если в переменной $adm==1 то вы успешно авторизованы

if((isset($_POST['slovo'])||isset($_POST['sekret']))||($_SESSION['sekret']==md5($pass))){
	if (($_POST['slovo']==$pass)||($_SESSION['sekret']==md5($pass))){
		$_SESSION['sekret']=md5($pass); // Если пароль совпадает добавляем в сессию переменную secret с его md5 хэшем
		$adm=1;
		};
		} else {
			// Если пароля нет показываем форму входа
			echo('
			<!doctype html>
			<html lang="ru">
			<head>
			<meta charset="UTF-8">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			</head>
			<body>
			<center><form method="POST" action="login.php" style="margin-top: 30px;">
			<div style="color: #4e4e4e;
    height: 54px;
    line-height: 24px;
    font-size: 31px;
    font-family: sans-serif;">Вход в панель администрирования</div>
			<input type="password" autocomplete="off" placeholder="Введите пароль" name="slovo" size="100" style="min-height: 50px;
    margin-bottom: 15px;
    border: 1px solid gray;
    background-color: transparent;
    background-position: 0% 50%;
    background-size: 16px;
    background-repeat: no-repeat;
    <!-- box-shadow: inset 0 -3px 0 0 #005bff; -->
    -webkit-transition: all 555ms ease;
    transition: all 555ms ease;
    font-size: 18px;
    width: 296px;
    text-align: center;"><br>
			<input type=submit name="save" value="Войти" style="  width: 300px;
  padding-top: 19px;
  padding-bottom: 22px;
  background-color: #005bff;
  border: none;
  font-size: 18px;
  box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.3); 
  font-size: 20px;
    color: white;">
			</form></center></body></html>');
		};

if($adm==1){
if(isset($_POST['pagename'])){
	$_SESSION['pagename']=$_POST['pagename']; // Получаем имя страницы для редактирования
};	
if(isset($_SESSION['pagename'])){	
	$pagename=$_SESSION['pagename'];
} else {
	$pagename='index.html';	// Если его нет в куках и нет в POST запросе то ставим его=index.html	
};

// В переменную $template поместим код редактируемой странички
$template=file_get_contents($pagename);

// Выводим шапку админки
echo('
<html>
<head>
<meta charset="UTF-8">
<style>
	body, html {
	padding: 0px; margin: 0px;
	background: #f2f3f5;
	text-align: center;
	font-family: sans-serif;
}
textarea {
	padding: 20px;
    width: 600px;
    height: 300px;
    font-size: 16px;
    box-shadow: 0 0 0 1px #005bff, inset 0 0 0 2px #005bff;
    border: none;
}
a {
	display: inline;
    -webkit-transition: all 555ms ease;
    transition: all 555ms ease;
    color: #005bff;
    text-decoration: none;
}
.kartinka {
	display: inline-block; 
	text-decoration: none;
	padding: 20px; padding-bottom: 5px;
	text-align: center; 
	cursor: pointer;
}
.kartinka:hover {
	background: #2196f33d; 
	border-radius: 5px;
}
.kartinka img {
	height: 100px; 
	margin-bottom: 10px;
}
.bigkartinka {
	height: 300px; 
	padding: 50px;
}
#menu {
background: #fffff0;
    padding-top: 15px;
    padding-bottom: 10px;
    padding-left: 10px;
    margin-bottom: 30px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    font-size: 20px;
    background-color: #2196f33d;
}
#myform {
	height: 40px; line-height: 40px;
	display: inline-block;
	vertical-align: top;
	padding-left: 20px; padding-right: 20px;
	margin-right: 3px;
	text-align: center;
	font-size: 90%;
}
#menu a {
	    padding: 7px 20px 9px 20px;
    background-color: #005bff;
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    color: white;
    font-size: 18px;
}
.mytext, .cssjs {
	display: block;
	border-radius: 5px;
	padding: 10px; padding-left: 20px; padding-right: 20px;
	margin: 20px;
	background: #fffff9;
	color: black;
}
.mytext:hover, .cssjs:hover {
	background: #2196f33d;
	cursor: pointer;
}
#help {
	max-width: 850px; margin: 0 auto; text-align: left; font-size: 120%;
}
</style>
</head>
<body>
<div id="menu">
<form action="login.php" id="myform" method="POST">
<select name="pagename">');
// Создаем список страниц в корневой папке доступных для редактирования
$filelist1 = glob("*.html");
$ddd=0;
$ssss='';
for ($j=0; $j<count($filelist1); $j++) {
	if($filelist1[$j]==$_SESSION['pagename']){
		$ssss.=('<option selected>'.$filelist1[$j].'</option>');
		$ddd=1;
	} else {
		$ssss.=('<option>'.$filelist1[$j].'</option>');
	};
};
if($ddd==0){
	$ssss='';
	for ($j=0; $j<count($filelist1); $j++) {
		if($filelist1[$j]=='index.html'){
			$ssss.=('<option selected>'.$filelist1[$j].'</option>');
			$ddd=1;
		} else {
			$ssss.=('<option>'.$filelist1[$j].'</option>');
		};
	};
};
echo($ssss);
echo('</select>
<input type="submit" value="Редактировать" title="Редактировать">
</form>
<a href="login.php?mode=0">Текст</a>
<a href="login.php?mode=7">Картинки</a>
<a href="login.php?mode=5">HTML</a>
<a href="login.php?mode=8">CSS и JS</a>
<a href="login.php">Помощь</a>
<a href="index.html" target="_blank">На сайт</a>
</div>
');

//******************************************************************************************
// Список картинок
if($_GET['mode']=='7'){
	// Вытаскиваем список картинок из HTML кода
	$imgreg = "/[\"|\(']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|png|gif|svg)))[\"|\)']/"; 
	preg_match_all($imgreg, $template, $imgmas);
	for ($j=0; $j< count($imgmas[1]); $j++) {
		$imgname=trim($imgmas[1][$j]);
		echo('<div class="kartinka"><a href="login.php?mode=1&img='.$imgname.'"><img src="'.$imgname.'?'.rand(1, 32000).'"></a><br>'.$imgname.'<br>');
		if(file_exists($imgname)){
			$size = getimagesize ($imgname); echo "Размер картинки: $size[0] * $size[1]"."<p>";
		} else { echo("Картинка не загружена"); };
		echo("</div>");
	};
	// Получаем список CSS файлов в массив $mycss	
	$mycss = array();
	$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/"; 
	preg_match_all($cssreg, $template, $cssmas);
	for ($j=0; $j< count($cssmas[1]); $j++) {
		array_push($mycss, trim($cssmas[1][$j]));
	};
	echo('<hr>');
	// Вытаскиваем с каждого CSS файла адреса картинок
	for ($i=0; $i< count($mycss); $i++) {
		$template=file_get_contents($mycss[$i]);
		$imgreg = "/[.\(]((.*\\/\\/|)([\\/a-z0-9_%]+\\.(jpg|png|gif|svg)))[\)]/"; 
		preg_match_all($imgreg, $template, $imgmas);
		for ($j=0; $j< count($imgmas[1]); $j++) {
			$imgname=trim($imgmas[1][$j]);
			echo('<div class="kartinka"><a href="login.php?mode=1&img='.$imgname.'"><img src="'.$imgname.'?'.rand(1, 32000).'"></a><br>'.$imgname.'<br>');
			if(file_exists($imgname)){
				$size = getimagesize ($imgname); echo "Размер картинки: $size[0] * $size[1]"."<p>";
			} else { 
				if(file_exists(substr($imgname,1))){
					$size = getimagesize(substr($imgname,1)); echo "Размер картинки: $size[0] * $size[1]"."<p>";
				} else { 
					echo("Картинка не загружена"); 
				};		
			};
			echo("</div>");
		};
	};
};

//******************************************************************************************
// Одна картинка
if($_GET['mode']=='1'){
	$imgname=$_GET['img'];
	if($imgname[0]=='/'){
		$imgname=substr($imgname,1);
	};
	echo('<center><img src="'.$imgname.'" class="bigkartinka"><br>'.$imgname.'<p>');
	if(file_exists($imgname)){
		$size = getimagesize ($imgname); echo "ВНИМАНИЕ!!! Рекомендуемый размер картинки: $size[0] * $size[1]"."<p>";
	} else { 
		if(file_exists(substr($imgname,1))){
			$size = getimagesize(substr($imgname,1)); echo "Размер картинки: $size[0] * $size[1]"."<p>";
		} else { 
			echo("Картинка не загружена"); 
		};		
	};
	echo('<form enctype="multipart/form-data" action="login.php?mode=2&img='.$imgname.'" method="POST">Загрузить картинку с компьютера: <p><input name="userfile" type="file" required><p><input type="submit" style="width: 300px;
    padding-top: 19px;
    padding-bottom: 22px;
    background-color: #005bff;
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    font-size: 20px;
    color: white;
    margin-top: 20px;" value="Начать загрузку" /></form>');	
};


//******************************************************************************************
// Замена картинки
if($_GET['mode']=='2'){
	$imgname=$_GET['img'];
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $imgname)) {
		echo "<br><br><center>Файл был успешно загружен.<p><a href='login.php'>Вернуться к списку картинок</a><p>Что бы увидеть изменения на сайте, обновите страницу (CTRL + F5 для Windows и Command + R для Mac).";
	};
};


//******************************************************************************************
// Список текстовых фрагментов
if($_GET['mode']=='0'){
	// Помещаем в массив $ff все тексты из HTML кода
	$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
	for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
	for ($j=0; $j< count($ff); $j++) { 
		echo('<a href="login.php?mode=3&j='.$j.'" class="mytext">'.$ff[$j].'</a>');
	};
};


//******************************************************************************************
// Текстовый фрагмент
if($_GET['mode']=='3'){
	// Помещаем в массив $ff все текстовые фрагменты из HTML кода
	$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
	for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
	$jj=$_GET['j'];
	$tektekst=$ff[$jj];
	$kol=1;
	for ($j=0; $j<$jj; $j++) { 
		$kol=$kol + substr_count($ff[$j],$tektekst);
	};
	echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="login.php?mode=4&j='.$jj.'"><br><br><h2>Редактирование текстового фрагмента</h2><br><br><textarea name="mytext">'.$tektekst.'</textarea><br><input style="width: 300px;
    padding-top: 19px;
    padding-bottom: 22px;
    background-color: #005bff;
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    font-size: 20px;
    color: white;
    margin-top: 20px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
};


//******************************************************************************************
// Редактирование текстового фрагмента
if($_GET['mode']=='4'){
	// Помещаем в массив $ff все текста из HTML кода
	$ff=array(); $content=preg_replace('/<[^>]+>/', '^', $template); $teksta = explode('^', $content);
	for ($j=0; $j< count($teksta); $j++) { if(strlen(trim($teksta[$j]))>1) $ff[]=(trim($teksta[$j])); };
	$jj=$_GET['j'];
	$tektekst=$ff[$jj];
	$kol=1;
	for ($j=0; $j<$jj; $j++) { 
		$kol=$kol + substr_count($ff[$j],$tektekst);
	};
	$subject=file_get_contents($pagename);
	function str_replace_nth($search, $replace, $subject, $nth)
	{
		$found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
		if (false !== $found && $found > $nth) {
			return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
		}
		return $subject;
	};
	$rez=str_replace_nth($tektekst, $_POST['mytext'], $subject, $kol-1);
	file_put_contents($pagename, $rez);
	echo "<br><br><center>Текст был успешно изменен!<p><a href='login.php?mode=0'>Вернуться к списку текстов</a><p>Что бы увидеть изменения, обновите страницу сайта (CTRL + F5 для Windows и Command + R для Mac).";
};


//******************************************************************************************
// Форма для HTML кода
if($_GET['mode']=='5'){
	$template=htmlspecialchars(file_get_contents($pagename));
	echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="login.php?mode=6"><br><br><h2>Редактирование HTML кода</h2><br><br><textarea name="mytext" style="width: 90%; height: 500px;">'.$template.'</textarea><br><input style="width: 300px;
    padding-top: 19px;
    padding-bottom: 22px;
    background-color: #005bff;
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    font-size: 20px;
    color: white;
    margin-top: 20px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
};


//******************************************************************************************
//Редактирование HTML кода
if($_GET['mode']=='6'){
	file_put_contents($pagename, $_POST['mytext']);
};

//******************************************************************************************
// Получаем список CSS и JS файлов
if($_GET['mode']=='8'){
	echo('<br><h2>CSS и JS файлы относящиеся к '.$pagename.'</h2><p><br>');
	$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(css)))[\"']/"; 
	preg_match_all($cssreg, $template, $cssmas);
	for ($j=0; $j< count($cssmas[1]); $j++) {
	$rrr=trim($cssmas[1][$j]);
	if (!(strstr($rrr, "http"))) {
 	echo('<a class="cssjs" href="login.php?mode=9&fl='.$rrr.'">'.$rrr.'</a><p>');
	};
	};
	$cssreg = "/[\"']((.*\\/\\/|)([\\/a-z0-9_%]+\\.(js)))[\"']/"; 
	preg_match_all($cssreg, $template, $cssmas);
	for ($j=0; $j< count($cssmas[1]); $j++) {
	$rrr=trim($cssmas[1][$j]);
	if (!(strstr($rrr, "http"))) {
	echo('<a class="cssjs"  href="login.php?mode=9&fl='.$rrr.'">'.$rrr.'</a><p>');
	};
	};
};

//******************************************************************************************
// Форма для HTML кода
if($_GET['mode']=='9'){
	$template=htmlspecialchars(file_get_contents($_GET['fl']));
	echo('<div style="margin: 0 auto; text-align: center;"><form method="POST" action="login.php?mode=10&fl='.$_GET['fl'].'"><br><br><h2>Редактирование кода</h2><br><br><textarea name="mytext" style="width: 90%; height: 500px;">'.$template.'</textarea><br><input style="width: 300px;
    padding-top: 19px;
    padding-bottom: 22px;
    background-color: #005bff;
    box-shadow: 0 20px 18px -10px rgba(0, 91, 255, 0.43);
    font-size: 20px;
    color: white;
    margin-top: 20px;" type="submit" value="Заменить текст" title="Заменить текст"></form></div>');
};

//******************************************************************************************
//Редактирование всего HTML кода
if($_GET['mode']=='10'){
	file_put_contents($_GET['fl'], $_POST['mytext']);
};

//******************************************************************************************
// Помощь
if(!isset($_GET['mode'])){
	echo('<div id="help"><p><h2>Вы находитесь в панели управления сайтом.</h2><h4>Ниже приведена инструкция по редактированию содержимого сайта:</h4></p>
		<p>1. Слева вверху в выпадающем списке выбирите страницу, которую вы хотите отредактировать. index.html это главная страница, остальные внутренние, их названия видно в адрестной строке браузера. После выбора страницы нажмите кнопку "Редактировать".</p>
		<p>2. Далее выбирите тип контента, который вы хотите изменить - текст или картинки, нажав соответсвующую кнопку.</p>
		<p>3. При нажатии на кнопку "Текст" на экран будет выведен весь текст содержащийся на странице. Текст разбит на абзацы, которые следуют поочередно соответсвенно как они находятся на самой странице. Например, первой строкой идет заголовок страницы, который выводится во вкладке браузера, далее идут все пункты меню, и далее абзацы с текстом самой страницы. Нажав на нужный вам абзац или слово, оно станет активным для редактирования. Отредактируйте текст и нажмите кнопку "Заменить текст".</p>
		<p>4. При нажатии на кнопку "Картинки" на экран будут выведены все картинки содержащиеся на странице. При нажатии на картинку, она станет доступной для замены. Нажмите кнопку "Выбирите файл" и укажите путь к новой картинке, после чего нажмите кнопку "Начать загурзку".</p>
		<hr>
		<p> ОБРАТИТЕ ВНИМАНИЕ! pазмер новой картинки должен быть такой же как и у старой, например если старая была 348x234 px, то и новая тоже должна быть 348x234 px.</p><hr>
		<p> Кнопки "HTML" и "CSS и JS" предназначены для корректировки кода страницы, его html блоков, стилей и javascript файлов. Данные корректировки может вносить только специалист понимающий код. Внеся туда даже мелкое неверное изменение можно сломать структуру и внешний вид страницы.</p>
        <br><br>
		<p>По вопросам администирования сайта пишити не почту <a href=""mailto:gf.muzkat@gmail.com" target="_blank">gf.muzkat@gmail.com</a> или <a href="tg://resolve?domain=ChumakKat">Telegram</a></p>
	</div>');
};

echo('</body></html>');
};
?>
