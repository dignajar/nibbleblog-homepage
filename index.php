<?php

$url = array(
	'page'=>null,
	'languages'=>'en'
);

if( isset($_GET['page']) ){ $url['page'] = $_GET['page']; }

if( isset($_GET['languages']) ) {
	$url['languages'] = trim($_GET['languages'],'/');
}

$html_path = '/';

// LANGUAGES
require( 'languages/en.bit' );
@include( 'languages/'. $url['languages'] . '.bit' );

$links['home'] = !empty($url['languages'])? $html_path.$url['languages'].'/' : $html_path;
$links['download'] = !empty($url['languages'])? $html_path.'download/'.$url['languages'].'/' : $html_path.'download/';
$links['documentation'] = !empty($url['languages'])? $html_path.'documentation/'.$url['languages'].'/' : $html_path.'documentation/';
$links['demo'] = !empty($url['languages'])? $html_path.'demo/'.$url['languages'].'/' : $html_path.'demo/';
$links['support'] = !empty($url['languages'])? $html_path.'support/'.$url['languages'].'/' : $html_path.'support/';

$langs = array(
	'Català'=>'ca',
	'Čeština'=>'cs',
	'Deutsch'=>'de',
	'English'=>'en',
	'Español'=>'es',
	'Français'=>'fr',
	'Magyar'=>'hu',
	'Italiano'=>'it',
	'Polski'=>'pl',
	'Português'=>'pt',
	'Pyccĸий'=>'ru',
	'Tϋrkçe'=>'tr',
	'Tiếng Việt'=>'vi',
	'繁體中文'=>'zh'
);

$layout = array(
	'title'=>'Nibbleblog - '.$_LANG['NIBBLEBLOG_DESCRIPTION_1'],
	'description'=>$_LANG['NIBBLEBLOG_DESCRIPTION_2'],
	'keywords'=>$_LANG['META_KEYWORDS']
);

if($url['page']=='download')
{
	$layout['title'] .= ' | '.$_LANG['DOWNLOAD'];
	$layout['description'] = $_LANG['DOWNLOAD_NIBBLEBLOG_THE'];
}
elseif($url['page']=='documentation')
{
	$layout['title'] .= ' | '.$_LANG['DOCUMENTATION'];
	$layout['description'] = $_LANG['HOW_TO_TUTORIALS'];
}
elseif($url['page']=='demo')
{
	$layout['title'] .= ' | '.$_LANG['DEMO'];
	$layout['description'] = $_LANG['CONTENT_DEMO'];
}
elseif($url['page']=='support')
{
	$layout['title'] .= ' | '.$_LANG['HELP_AND_SUPPORT'];
	$layout['description'] = $_LANG['CONTENT_HELP_AND_SUPPORT'];
}

?>
<!DOCTYPE HTML>
<html>
<head lang="<?php echo $url['languages'] ?>">
	<meta charset="utf-8">

	<title><?php echo $layout['title'] ?></title>
	<meta name="description" content="<?php echo $layout['description'] ?>" >
	<meta name="keywords" content="<?php echo $layout['keywords'] ?>" >
	<meta name="robots" content="index, follow" >

	<meta name="google-site-verification" content="i8tUMYyMEao3Tpi5kBT6MOSeBBWeV-29Mp0hXr-Ef20" >

	<link rel="stylesheet" type="text/css" href="<?php echo $html_path.'css/normalize.css'; ?>" >
	<link rel="stylesheet" type="text/css" href="<?php echo $html_path.'css/style.css'; ?>" >

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >

	<!-- Open Graph -->
	<meta property="og:locale" content="<?php echo $url['languages'] ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $layout['title'] ?>">
	<meta property="og:description" content="<?php echo $layout['description'] ?>">
	<meta property="og:image" content="http://www.nibbleblog.com/css/img/mrnibbler128.png">
	<meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<meta property="og:site_name" content="Nibbleblog">

	<?php
		$tags = explode(',', $_LANG['META_KEYWORDS']);
		foreach($tags as $tag)
			echo '<meta property="article:tag" content="'.trim($tag).'">'.PHP_EOL;
	?>

	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $layout['title'] ?>">
	<meta name="twitter:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<meta name="twitter:image" content="http://www.nibbleblog.com/css/img/mrnibbler128.png">
	<meta name="twitter:description" content="<?php echo $layout['description'] ?>">
	<meta name="twitter:site" content="@nibbleblog">
	<meta name="twitter:creator" content="@dignajar">

	<!-- Google Analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-33770801-1', 'auto');
	ga('send', 'pageview');

	</script>

</head>
<body>

	<div id="wrap">

		<header id="head">
			<div id="title">
				<div class="logo">
					<h1>nibbleblog</h1>
				</div>
			</div>
		</header>

		<?php
			if(file_exists('includes/'.$url['page'].'.php'))
			{
				include('includes/'.$url['page'].'.php');
			}
			else
			{
				include('includes/index.php');
			}
		?>

		<footer id="foot">
			<p>
				<?php
					foreach($langs as $key=>$value)
					{
						echo '<a class="lang" href="'.$html_path.$value.'/">'.$key.'</a>';
					}
				?>
			</p>

			<p><a href="http://demo.nibbleblog.com"><?php echo $_LANG['DEMO'] ?></a> | <a href="http://github.com/dignajar/nibbleblog">Github</a> | <a href="http://www.facebook.com/nibbleblog">Facebook</a> | <a href="http://sourceforge.net/projects/nibbleblog/">Sourceforge</a> | <a href="http://google.com/+Nibbleblog">Google+</a> | <a href="<?php echo $html_path ?>pad_file.xml">Pad File</a></p>

			<p>Nibbleblog ©2009 - <?php echo date('Y') ?> | Diego Najar ( <a target="_blank" href="http://www.linkedin.com/in/dignajar">Linkedin</a> )</p>
		</footer>

	</div>

</body>
</html>