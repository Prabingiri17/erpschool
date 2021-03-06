<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/classattendance.php");
	include("$currDir/classattendance_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('classattendance');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "classattendance";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`classattendance`.`id`" => "id",
		"IF(    CHAR_LENGTH(`subjects1`.`Name`), CONCAT_WS('',   `subjects1`.`Name`), '') /* Subject */" => "Subject",
		"IF(    CHAR_LENGTH(`students1`.`FullName`), CONCAT_WS('',   `students1`.`FullName`), '') /* Student */" => "Student",
		"IF(    CHAR_LENGTH(`students1`.`RegNo`), CONCAT_WS('',   `students1`.`RegNo`), '') /* RegNo */" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"concat('<img src=\"', if(`classattendance`.`Attended`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "Attended",
		"if(`classattendance`.`Date`,date_format(`classattendance`.`Date`,'%m/%d/%Y'),'')" => "Date"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`classattendance`.`id`',
		2 => '`subjects1`.`Name`',
		3 => '`students1`.`FullName`',
		4 => '`students1`.`RegNo`',
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`classattendance`.`Date`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`classattendance`.`id`" => "id",
		"IF(    CHAR_LENGTH(`subjects1`.`Name`), CONCAT_WS('',   `subjects1`.`Name`), '') /* Subject */" => "Subject",
		"IF(    CHAR_LENGTH(`students1`.`FullName`), CONCAT_WS('',   `students1`.`FullName`), '') /* Student */" => "Student",
		"IF(    CHAR_LENGTH(`students1`.`RegNo`), CONCAT_WS('',   `students1`.`RegNo`), '') /* RegNo */" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"`classattendance`.`Attended`" => "Attended",
		"if(`classattendance`.`Date`,date_format(`classattendance`.`Date`,'%m/%d/%Y'),'')" => "Date"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`classattendance`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`subjects1`.`Name`), CONCAT_WS('',   `subjects1`.`Name`), '') /* Subject */" => "Subject",
		"IF(    CHAR_LENGTH(`students1`.`FullName`), CONCAT_WS('',   `students1`.`FullName`), '') /* Student */" => "Student",
		"IF(    CHAR_LENGTH(`students1`.`RegNo`), CONCAT_WS('',   `students1`.`RegNo`), '') /* RegNo */" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"`classattendance`.`Attended`" => "Attended",
		"`classattendance`.`Date`" => "Date"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`classattendance`.`id`" => "id",
		"IF(    CHAR_LENGTH(`subjects1`.`Name`), CONCAT_WS('',   `subjects1`.`Name`), '') /* Subject */" => "Subject",
		"IF(    CHAR_LENGTH(`students1`.`FullName`), CONCAT_WS('',   `students1`.`FullName`), '') /* Student */" => "Student",
		"IF(    CHAR_LENGTH(`students1`.`RegNo`), CONCAT_WS('',   `students1`.`RegNo`), '') /* RegNo */" => "RegNo",
		"IF(    CHAR_LENGTH(`classes1`.`Name`), CONCAT_WS('',   `classes1`.`Name`), '') /* Class */" => "Class",
		"IF(    CHAR_LENGTH(`streams1`.`Name`), CONCAT_WS('',   `streams1`.`Name`), '') /* Stream */" => "Stream",
		"concat('<img src=\"', if(`classattendance`.`Attended`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "Attended",
		"if(`classattendance`.`Date`,date_format(`classattendance`.`Date`,'%m/%d/%Y'),'')" => "Date"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'Subject' => 'Subject', 'Student' => 'Student');

	$x->QueryFrom = "`classattendance` LEFT JOIN `subjects` as subjects1 ON `subjects1`.`id`=`classattendance`.`Subject` LEFT JOIN `students` as students1 ON `students1`.`id`=`classattendance`.`Student` LEFT JOIN `classes` as classes1 ON `classes1`.`id`=`students1`.`Class` LEFT JOIN `streams` as streams1 ON `streams1`.`id`=`students1`.`Stream` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "classattendance_view.php";
	$x->RedirectAfterInsert = "classattendance_view.php?SelectedID=#ID#";
	$x->TableTitle = "Class Attendance";
	$x->TableIcon = "resources/table_icons/chart_down_color.png";
	$x->PrimaryKey = "`classattendance`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Subject", "Student", "RegNo", "Class", "Stream", "Attended", "Date");
	$x->ColFieldName = array('Subject', 'Student', 'RegNo', 'Class', 'Stream', 'Attended', 'Date');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8);

	// template paths below are based on the app main directory
	$x->Template = 'templates/classattendance_templateTV.html';
	$x->SelectedTemplate = 'templates/classattendance_templateTVS.html';
	$x->TemplateDV = 'templates/classattendance_templateDV.html';
	$x->TemplateDVP = 'templates/classattendance_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `classattendance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='classattendance' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `classattendance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='classattendance' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`classattendance`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: classattendance_init
	$render=TRUE;
	if(function_exists('classattendance_init')){
		$args=array();
		$render=classattendance_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: classattendance_header
	$headerCode='';
	if(function_exists('classattendance_header')){
		$args=array();
		$headerCode=classattendance_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: classattendance_footer
	$footerCode='';
	if(function_exists('classattendance_footer')){
		$args=array();
		$footerCode=classattendance_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>