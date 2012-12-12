<?php
require_once('inc/open_conn.php');

if($_GET['access_token']){
	header("Location: http://www.beebrite.com/beebrite.php?fbaccess_token=" . $_GET['access_token']);
}else{
?>
<html>
<head>
<script>
var query = location.href.split('#');
var token = query[1].split('=');
var access_token = token[1].split('&');
window.location = 'dofbtoken.php?access_token=' + access_token[0];
</script>
</head>
</html>

<?php
};
?>
<?php
mysql_close($con);
?>