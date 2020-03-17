<?php
session_start();
include_once("../function/config.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
	$query = mysql_query("SELECT * FROM template") or die(mysql_error());
	$temp = mysql_fetch_array($query);
	
	// Template
	if(isset($_POST['editTemplate'])){
		$template= $_POST['template'];
		$updateTemp = mysql_query("UPDATE template SET template='".$template."'") or die(mysql_error());   
		$final_report0.= '<span style="color: green;">Update successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=template.php'/>";
	}
	
	// Design
	if(isset($_POST['design'])){
		$title= htmlspecialchars($_POST['title'],ENT_QUOTES); 
		$des= htmlspecialchars($_POST['des'],ENT_QUOTES); 
		$bgcolor= htmlspecialchars($_POST['bgcolor'],ENT_QUOTES); 
		$logo= htmlspecialchars($_POST['logo'],ENT_QUOTES); 
		$h2= htmlspecialchars($_POST['h2'],ENT_QUOTES); 
		$h3= htmlspecialchars($_POST['h3'],ENT_QUOTES); 
		$h4= htmlspecialchars($_POST['h4'],ENT_QUOTES); 
		$p= htmlspecialchars($_POST['p'],ENT_QUOTES); 
		$f1= htmlspecialchars($_POST['f1'],ENT_QUOTES);
		$f2= htmlspecialchars($_POST['f2'],ENT_QUOTES);
		$f3= htmlspecialchars($_POST['f3'],ENT_QUOTES);
		$f4= htmlspecialchars($_POST['f4'],ENT_QUOTES);
		$f5= htmlspecialchars($_POST['f5'],ENT_QUOTES);
		$f6= htmlspecialchars($_POST['f6'],ENT_QUOTES);
		$updateTemp = mysql_query("UPDATE template SET title='".$title."',des='".$des."',bgColor='".$bgcolor."',logo='".$logo."',heading2='".$h2."',heading3='".$h3."',heading4='".$h4."', paragraph='".$p."',f1='".$f1."',f2='".$f2."',f3='".$f3."',f4='".$f4."',f5='".$f5."',f6='".$f6."'") or die(mysql_error());   
		$final_report1.= '<span style="color: green;">Update successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=template.php'/>";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Settings</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php') ?>
   
    <div id="content">
		<div class="setting">
			<h2>Template</h2>	
			<div class="normal">
				<form action="" method="post">
					<select name="template">
						<option value="SOFT" <?php if ($temp['template'] == "SOFT") { echo 'selected="selected"';}?>>SOFT</option>
						<option value="HARD" <?php if ($temp['template'] == "HARD") { echo 'selected="selected"';}?>>HARD</option>
					</select>
					<input type="submit" name="editTemplate" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report0 !=""){?>
					<p class="error">
						<? echo $final_report0;?>
					</p>
					<?php } ?>
			</div>
			<div class="clear"></div>
			<div class="adbox">
			<form action="" method="POST">
				<p>Title</p>
				<input type="text" name="title" value="<? echo $temp['title'];?>"/>
				<p>Description</p>
				<input type="text" name="des" value="<? echo $temp['des'];?>"/>
				<p>Background Color (XXXXXX)</p>
				<input type="text" name="bgcolor" value="<? echo $temp['bgColor'];?>"/>
				<p>Logo Image URL (322px x 63px)</p>
				<input type="text" name="logo" value="<? echo $temp['logo'];?>"/>
				<p>Heading 2</p>
				<input type="text" name="h2" value="<? echo stripslashes($temp['heading2']);?>"/>
				<p>Heading 3</p>
				<input type="text" name="h3" value="<? echo $temp['heading3'];?>"/>
				<p>Heading 4</p>
				<input type="text" name="h4" value="<? echo $temp['heading4'];?>"/>
				<p>Feature 1</p>
				<input type="text" name="f1" value="<? echo $temp['f1'];?>"/>
				<p>Feature 2</p>
				<input type="text" name="f2" value="<? echo $temp['f2'];?>"/>
				<p>Feature 3</p>
				<input type="text" name="f3" value="<? echo $temp['f3'];?>"/>
				<p>Feature 4</p>
				<input type="text" name="f4" value="<? echo $temp['f4'];?>"/>
				<p>Feature 5</p>
				<input type="text" name="f5" value="<? echo $temp['f5'];?>"/>
				<p>Feature 6</p>
				<input type="text" name="f6" value="<? echo $temp['f6'];?>"/>
				<p>Paragraph</p>
				<textarea name="p"><? echo stripslashes($temp['paragraph']);?></textarea>
				<input type="submit" name="design" class="btn" value="OK" />
			</form>
			<?php if($final_report1 !=""){?>
					<p class="error">
						<? echo $final_report1;?>
					</p>
					<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>