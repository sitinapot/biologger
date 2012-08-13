<?php
include_once('fxns.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
	<link href="iwebkit/css/style.css" rel="stylesheet" media="screen" type="text/css" />
	<script src="iwebkit/javascript/functions.js" type="text/javascript"></script>
	<title>Biologger</title>
</head>

<body>
<div id="topbar">
	<div id="leftnav"><a href="index.php" />Home</a></div>
</div>

<?
#Open a file and pull in all the options
$activities = load_activities(ACTIVITIES_FILE);

# make sure activity is in list
if (in_array($_POST["activity_type"], $activities)) {
	$activity_type = $_POST['activity_type'];
} else {
	print "Invalid activity";
	die();
}

# make sure count is an intval
if (intval($_POST['count'])) {
	$count = intval($_POST['count']);
} else {
	print "Invalid count<br />";
	die();
}

# we have $count and $activity_type, log it!
$event = "activity=".$activity_type.", amount=".$count;
$datetime = utcnow();
$timestamped_event = $datetime." ".$event."\n";
if (log_to_file(ACTIVITIES_LOG_FILE, $timestamped_event)) {
	?>
	<br /><br /><br /><br />
	<div align="center">LOGGED!</div>
	<?
		print $timestamped_event;
} else {
	print "FAILED TO LOG!";
}
?>

</body>
</html>