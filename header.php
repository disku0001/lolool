<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php echo Title ?> <?php echo Des; ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <?  if(Template=="SOFT") {  ?>
  <link rel="stylesheet" href="style2.css" type="text/css" />
  <? } else {  ?>
  <link rel="stylesheet" href="style.css" type="text/css" />
  <? } ?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75072341-1', 'auto');
  ga('send', 'pageview');

</script>
  <style type="text/css">
	body { background-color: #<? echo bgColor;?>}
	#header .logo {background: url("<? echo logo;?>")}
  </style>