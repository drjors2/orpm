<?php
// This script and data application were generated by AppGini 5.51
// Download AppGini for free from http://bigprof.com/appgini/download/

/*
	ajax-callable script that returns code for either a combo drop-down or an auto-complete
	drop-down, based on number of items.

	REQUEST parameters:
	===============
	t: table name
	f: lookup field name
	id: selected id
	p: page number (default = 1)
	s: search term
	o: 0 (default) for text-only or 1 for full options list
	text: selected text
	filterer_[filterer]: name of filterer field to be used to filter the drop-down contents
				must be one of the filteres defined for the concerned field
*/

	$start_ts = microtime(true);

	// how many results to return per call, in case of json output
	$results_per_page = 50;

	$curr_dir = dirname(__FILE__);
	include("$curr_dir/defaultLang.php");
	include("$curr_dir/language.php");
	include("$curr_dir/lib.php");

	handle_maintenance();

	// drop-downs config
	$lookups = array(   
		'applications_leases' => array(   
			'tenants' => array(
				'parent_table' => 'applicants_and_tenants',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`applicants_and_tenants`.`first_name`) || CHAR_LENGTH(`applicants_and_tenants`.`last_name`), CONCAT_WS(\'\', `applicants_and_tenants`.`first_name`, \' \', `applicants_and_tenants`.`last_name`), \'\')',
				'parent_from' => '`applicants_and_tenants` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`applicants_and_tenants`.`property` LEFT JOIN `units` as units1 ON `units1`.`id`=`applicants_and_tenants`.`unit` LEFT JOIN `properties` as properties2 ON `properties2`.`id`=`units1`.`property` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			),
			'property' => array(
				'parent_table' => 'properties',
				'parent_pk_field' => 'id',
				'parent_caption' => '`properties`.`property_name`',
				'parent_from' => '`properties` LEFT JOIN `rental_owners` as rental_owners1 ON `rental_owners1`.`id`=`properties`.`owner` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			),
			'unit' => array(
				'parent_table' => 'units',
				'parent_pk_field' => 'id',
				'parent_caption' => '`units`.`unit_number`',
				'parent_from' => '`units` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`units`.`property` ',
				'filterers' => array('property' => 'property'),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'residence_and_rental_history' => array(   
			'tenant' => array(
				'parent_table' => 'applicants_and_tenants',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`applicants_and_tenants`.`first_name`) || CHAR_LENGTH(`applicants_and_tenants`.`last_name`), CONCAT_WS(\'\', `applicants_and_tenants`.`first_name`, \' \', `applicants_and_tenants`.`last_name`), \'\')',
				'parent_from' => '`applicants_and_tenants` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`applicants_and_tenants`.`property` LEFT JOIN `units` as units1 ON `units1`.`id`=`applicants_and_tenants`.`unit` LEFT JOIN `properties` as properties2 ON `properties2`.`id`=`units1`.`property` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'employment_and_income_history' => array(   
			'tenant' => array(
				'parent_table' => 'applicants_and_tenants',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`applicants_and_tenants`.`first_name`) || CHAR_LENGTH(`applicants_and_tenants`.`last_name`), CONCAT_WS(\'\', `applicants_and_tenants`.`first_name`, \' \', `applicants_and_tenants`.`last_name`), \'\')',
				'parent_from' => '`applicants_and_tenants` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`applicants_and_tenants`.`property` LEFT JOIN `units` as units1 ON `units1`.`id`=`applicants_and_tenants`.`unit` LEFT JOIN `properties` as properties2 ON `properties2`.`id`=`units1`.`property` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'references' => array(   
			'tenant' => array(
				'parent_table' => 'applicants_and_tenants',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`applicants_and_tenants`.`first_name`) || CHAR_LENGTH(`applicants_and_tenants`.`last_name`), CONCAT_WS(\'\', `applicants_and_tenants`.`first_name`, \' \', `applicants_and_tenants`.`last_name`), \'\')',
				'parent_from' => '`applicants_and_tenants` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`applicants_and_tenants`.`property` LEFT JOIN `units` as units1 ON `units1`.`id`=`applicants_and_tenants`.`unit` LEFT JOIN `properties` as properties2 ON `properties2`.`id`=`units1`.`property` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'applicants_and_tenants' => array(   
			'property' => array(
				'parent_table' => 'properties',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`properties`.`property_name`) || CHAR_LENGTH(`properties`.`City`), CONCAT_WS(\'\', `properties`.`property_name`, \' - \', `properties`.`City`), \'\')',
				'parent_from' => '`properties` LEFT JOIN `rental_owners` as rental_owners1 ON `rental_owners1`.`id`=`properties`.`owner` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			),
			'unit' => array(
				'parent_table' => 'units',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`units`.`property`) || CHAR_LENGTH(`units`.`unit_number`), CONCAT_WS(\'\', IF(    CHAR_LENGTH(`properties1`.`property_name`), CONCAT_WS(\'\',   `properties1`.`property_name`), \'\'), \' - \', `units`.`unit_number`), \'\')',
				'parent_from' => '`units` LEFT JOIN `properties` as properties1 ON `properties1`.`id`=`units`.`property` ',
				'filterers' => array('property' => 'property'),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'properties' => array(   
			'owner' => array(
				'parent_table' => 'rental_owners',
				'parent_pk_field' => 'id',
				'parent_caption' => 'IF(CHAR_LENGTH(`rental_owners`.`first_name`) || CHAR_LENGTH(`rental_owners`.`last_name`), CONCAT_WS(\'\', `rental_owners`.`first_name`, \' \', `rental_owners`.`last_name`), \'\')',
				'parent_from' => '`rental_owners` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'units' => array(   
			'property' => array(
				'parent_table' => 'properties',
				'parent_pk_field' => 'id',
				'parent_caption' => '`properties`.`property_name`',
				'parent_from' => '`properties` LEFT JOIN `rental_owners` as rental_owners1 ON `rental_owners1`.`id`=`properties`.`owner` ',
				'filterers' => array(),
				'custom_query' => '',
				'inherit_permissions' => false,
				'list_type' => 0,
				'not_null' => false
			)
		),
		'rental_owners' => array(  
		)
	);


	// receive and verify user input
	$table_name = $_REQUEST['t'];
	$field_name = $_REQUEST['f'];
	$search_id = makeSafe(iconv('UTF-8', datalist_db_encoding, $_REQUEST['id']));
	$selected_text = iconv('UTF-8', datalist_db_encoding, $_REQUEST['text']);
	$returnOptions = ($_REQUEST['o'] == 1 ? true : false);
	$page = intval($_REQUEST['p']);
	if($page < 1)  $page = 1;
	$skip = $results_per_page * ($page - 1);
	$search_term = makeSafe(iconv('UTF-8', datalist_db_encoding, $_REQUEST['s']));

	if(!isset($lookups[$table_name][$field_name])) die('{ "error": "Invalid table or field." }');

	// can user access the requested table?
	$perm = getTablePermissions($table_name);
	if(!$perm[0] && !$search_id) die('{ "error": "' . addslashes($Translation['tableAccessDenied']) . '" }');

	$field = $lookups[$table_name][$field_name];

	$wheres = array();

	// search term provided?
	if($search_term){
		$wheres[] = "{$field['parent_caption']} like '%{$search_term}%'";
	}

	// any filterers specified?
	if(is_array($field['filterers'])){
		foreach($field['filterers'] as $filterer => $filterer_parent){
			$get = (isset($_REQUEST["filterer_{$filterer}"]) ? $_REQUEST["filterer_{$filterer}"] : false);
			if($get){
				$wheres[] = "`{$field['parent_table']}`.`$filterer_parent`='" . makeSafe($get) . "'";
			}
		}
	}

	// inherit permissions?
	if($field['inherit_permissions']){
		$inherit = permissions_sql($field['parent_table']);
		if($inherit === false && !$search_id) die($Translation['tableAccessDenied']);

		if($inherit['where']) $wheres[] = $inherit['where'];
		if($inherit['from']) $field['parent_from'] .= ", {$inherit['from']}";
	}

	// single value?
	if($field['list_type'] != 2 && $search_id){
		$wheres[] = "`{$field['parent_table']}`.`{$field['parent_pk_field']}`='{$search_id}'";
	}

	if(count($wheres)){
		$where = 'WHERE ' . implode(' AND ', $wheres);
	}

	// define the combo and return the code
	$combo = new DataCombo;
	if($field['custom_query']){
		$qm = array(); $custom_where = ''; $custom_order_by = '2';
		$combo->Query = $field['custom_query'];

		if(preg_match('/ order by (.*)$/i', $combo->Query, $qm)){
			$custom_order_by = $qm[1];
			$combo->Query = preg_replace('/ order by .*$/i', '', $combo->Query);
		}

		if(preg_match('/ where (.*)$/i', $combo->Query, $qm)){
			$custom_where = $qm[1];
			$combo->Query = preg_replace('/ where .*$/i', '', $combo->Query);
		}

		if($where && $custom_where){
			$combo->Query .=  " {$where} AND ({$custom_where}) ORDER BY {$custom_order_by}";
		}elseif($custom_where){
			$combo->Query .=  " WHERE {$custom_where} ORDER BY {$custom_order_by}";
		}else{
			$combo->Query .=  " {$where} ORDER BY {$custom_order_by}";
		}

		$query_match = array();
		preg_match('/select (.*) from (.*)$/i', $combo->Query, $query_match);

		if(isset($query_match[2])){
			$count_query = "SELECT count(1) FROM {$query_match[2]}";
		}else{
			$count_query = '';
		}
	}else{
		$combo->Query = "SELECT " . ($field['inherit_permissions'] ? 'DISTINCT ' : '') . "`{$field['parent_table']}`.`{$field['parent_pk_field']}`, {$field['parent_caption']} FROM {$field['parent_from']} {$where} ORDER BY 2";
		$count_query = "SELECT count(1) FROM {$field['parent_from']} {$where}";
	}
	$combo->table = $table_name;
	$combo->parent_table = $field['parent_table'];
	$combo->SelectName = $field_name;
	$combo->ListType = $field['list_type'];
	if($search_id){
		$combo->SelectedData = $search_id;
	}elseif($selected_text){
		$combo->SelectedData = getValueGivenCaption($combo->Query, $selected_text);
	}

	if($field['list_type'] == 2){
		$combo->Render();
		$combo->HTML = str_replace('<select ', '<select onchange="' . $field_name . '_changed();" ', $combo->HTML);

		// return response
		if($returnOptions){
			?><span id="<?php echo $field_name; ?>-combo-list"><?php echo $combo->HTML; ?></span><?php
		}else{
			?>
				<span id="<?php echo $field_name; ?>-match-text"><?php echo $combo->MatchText; ?></span>
				<input type="hidden" id="<?php echo $field_name; ?>" value="<?php echo html_attr($combo->SelectedData); ?>" />
			<?php
		}
	}else{
		/* return json */
		header('Content-type: application/json');

		if(!preg_match('/ limit .+/i', $combo->Query)){
			if(!$search_id) $combo->Query .= " LIMIT {$skip}, {$results_per_page}";
			if($search_id) $combo->Query .= " LIMIT 1";
		}

		$prepared_data = array();

		// specific caption provided and list_type is not radio?
		if(!$search_id && $selected_text){
			$search_id = getValueGivenCaption($combo->Query, $selected_text);
			if($search_id) $prepared_data[] = array('id' => $search_id, 'text' => $selected_text);
		}else{
			$res = sql($combo->Query, $eo);
			while($row = db_fetch_row($res)){
				if(empty($prepared_data) && $page == 1 && !$search_id && !$field['not_null']){
					$prepared_data[] = array('id' => empty_lookup_value, 'text' => "<{$Translation['none']}>");
				}

				$prepared_data[] = array('id' => iconv(datalist_db_encoding, 'UTF-8', $row[0]), 'text' => iconv(datalist_db_encoding, 'UTF-8', $row[1]));
			}
		}

		if(empty($prepared_data)){ $prepared_data[] = array('id' => '', 'text' => $Translation['No matches found!']); }

		echo json_encode(array(
			'results' => $prepared_data,
			'more' => (@db_num_rows($res) >= $results_per_page),
			'elapsed' => round(microtime(true) - $start_ts, 3)
		));
	}

