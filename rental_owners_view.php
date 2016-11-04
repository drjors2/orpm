<?php
// This script and data application were generated by AppGini 5.51
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/rental_owners.php");
	include("$currDir/rental_owners_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('rental_owners');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "rental_owners";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV=array(   
		"`rental_owners`.`id`" => "id",
		"`rental_owners`.`first_name`" => "first_name",
		"`rental_owners`.`last_name`" => "last_name",
		"if(`rental_owners`.`date_of_birth`,date_format(`rental_owners`.`date_of_birth`,'%Y-%m-%d'),'')" => "date_of_birth",
		"`rental_owners`.`primary_email`" => "primary_email",
		"`rental_owners`.`phone`" => "phone",
		"`rental_owners`.`country`" => "country"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`rental_owners`.`id`',
		2 => 2,
		3 => 3,
		4 => '`rental_owners`.`date_of_birth`',
		5 => 5,
		6 => 6,
		7 => 7
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV=array(   
		"`rental_owners`.`id`" => "id",
		"`rental_owners`.`first_name`" => "first_name",
		"`rental_owners`.`last_name`" => "last_name",
		"if(`rental_owners`.`date_of_birth`,date_format(`rental_owners`.`date_of_birth`,'%Y-%m-%d'),'')" => "date_of_birth",
		"`rental_owners`.`primary_email`" => "primary_email",
		"`rental_owners`.`phone`" => "phone",
		"`rental_owners`.`country`" => "country"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters=array(   
		"`rental_owners`.`id`" => "ID",
		"`rental_owners`.`first_name`" => "First name",
		"`rental_owners`.`last_name`" => "Last name",
		"`rental_owners`.`date_of_birth`" => "Date of birth",
		"`rental_owners`.`primary_email`" => "Email",
		"`rental_owners`.`phone`" => "Phone",
		"`rental_owners`.`country`" => "Country"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS=array(   
		"`rental_owners`.`id`" => "id",
		"`rental_owners`.`first_name`" => "first_name",
		"`rental_owners`.`last_name`" => "last_name",
		"if(`rental_owners`.`date_of_birth`,date_format(`rental_owners`.`date_of_birth`,'%Y-%m-%d'),'')" => "date_of_birth",
		"`rental_owners`.`primary_email`" => "primary_email",
		"`rental_owners`.`phone`" => "phone",
		"`rental_owners`.`country`" => "country"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom="`rental_owners` ";
	$x->QueryWhere='';
	$x->QueryOrder='';

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
	$x->ScriptFileName = "rental_owners_view.php";
	$x->RedirectAfterInsert = "rental_owners_view.php?SelectedID=#ID#";
	$x->TableTitle = "Owners Center";
	$x->TableIcon = "resources/table_icons/administrator.png";
	$x->PrimaryKey = "`rental_owners`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("First name", "Last name", "Date of birth", "Email", "Phone", "Country");
	$x->ColFieldName = array('first_name', 'last_name', 'date_of_birth', 'primary_email', 'phone', 'country');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7);

	$x->Template = 'templates/rental_owners_templateTV.html';
	$x->SelectedTemplate = 'templates/rental_owners_templateTVS.html';
	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `rental_owners`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='rental_owners' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `rental_owners`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='rental_owners' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`rental_owners`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: rental_owners_init
	$render=TRUE;
	if(function_exists('rental_owners_init')){
		$args=array();
		$render=rental_owners_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: rental_owners_header
	$headerCode='';
	if(function_exists('rental_owners_header')){
		$args=array();
		$headerCode=rental_owners_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: rental_owners_footer
	$footerCode='';
	if(function_exists('rental_owners_footer')){
		$args=array();
		$footerCode=rental_owners_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>