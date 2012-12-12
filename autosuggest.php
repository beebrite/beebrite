<?php
	echo '<img class="notifup" src="img/notif_up.png" />';

	require_once('inc/open_conn.php');
	$arrSearch = explode(" ",$_POST['queryString']);
	$strSql = "SELECT * FROM cat_users WHERE intId <> -2 ";
	for ($intIx = 0; $intIx < sizeof($arrSearch); $intIx++)
	{
		if ($arrSearch[$intIx] != ''){
			$strSql .= "AND (strName LIKE '%" . $arrSearch[$intIx] . "%' OR strLastName LIKE '%" . $arrSearch[$intIx] . "%' OR strNick LIKE '%" . $arrSearch[$intIx] . "%')";
		}
	}
	$strSql .= " ORDER BY strName, strLastName, strNick LIMIT 8;";
	$rstSugs = mysql_query($strSql);
	echo "<ul>";
	if (mysql_num_rows($rstSugs)==0)
	{
		echo "<li>No results ...</li>";
	}
	else
	{
		while ($objSugs = mysql_fetch_array($rstSugs))
		{
			$strOut = "<li><img width='38' height='38' src='" .  str_replace("usrpics/180/", "usrpics/50/", str_replace("?type=large" ,"?type=square" ,$objSugs['strUsrPic'])) . "' /><a href='profile.php?s=0&vId=" . $objSugs['intId'] . "'>" . $objSugs['strName'] . " " . $objSugs['strLastName'] . "</a><span>" . $objSugs['strNick'] . "</span></li>";
			echo $strOut;
		};
		$strOut = "<li class='allnotify round' style='border:none;'><a href='users.php?qstring=" . $_POST['queryString'] . "'>View more users...</a></li>";
		echo $strOut;
	};
	echo "</ul>";
	mysql_close($con);
?>