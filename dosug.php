<?php
require_once('inc/open_conn.php');

	$arrSearch = explode(" ",$_GET['uSearch']);
	$strSql = "SELECT * FROM cat_users WHERE intId <> -2 ";
	for ($intIx = 0; $intIx < sizeof($arrSearch); $intIx++)
	{
		if ($arrSearch[$intIx] != ''){
			$strSql .= "AND (strName LIKE '%" . $arrSearch[$intIx] . "%' OR strLastName LIKE '%" . $arrSearch[$intIx] . "%' OR strNick LIKE '%" . $arrSearch[$intIx] . "%')";
		}
	}
	$strSql .= " ORDER BY strName, strLastName, strNick LIMIT 10;";
	//echo $strSql;
	
	$rstSugs = mysql_query($strSql);
	$strResponse = "<ul>";
	while ($objDataLogin = mysql_fetch_array($rstSugs))
	{
		$strResponse .= "<li>" . $objDataLogin['strName'] . " " . $objDataLogin['strLastName'] . " (" . $objDataLogin['strNick'] . ")</li>";
	}
	$strResponse .= "</ul>";
	mysql_close($con);
	echo $strResponse;
?>