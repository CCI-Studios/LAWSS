<?php 
$node_type = "reports"; // can find this on the node type's "edit" screen in the Drupal admin section.

$result = db_query("SELECT nid FROM node WHERE type = :nodeType ", array(':nodeType'=>$node_type)); //<-- change 1

$nids = array();
foreach ($result as $obj) { 
  $nids[] = $obj->nid;
}

$years_financial = [];
$years_compliance = [];
$years_other = [];

for ($i=1990; $i < date("Y"); $i++) { 

	$flag_financial = 0;
	$flag_compliance = 0;
	$flag_other = 0;
	foreach ($nids as $key => $value) {

	$node = node_load($value);
	
	$report_year = $node->field_report_year['und'][0]['value'];
    $user_tz = 'Canada/Eastern';
    $report_year = new DateTime($report_year,new DateTimeZone($user_tz));
    $report_year = $report_year->format('Y');

	if(isset($node->field_report_type))
	{	
		if($node->field_report_type['und'][0]['tid'] == 1)
		{	
			$formatted_date = $report_year;

			if($formatted_date == $i )
			{	
				$flag_financial++;
			}
		}

		if($node->field_report_type['und'][0]['tid'] == 2)
		{
			$formatted_date = $report_year;
			if($formatted_date == $i )
			{	
				$flag_compliance++;
			}
		}

		if($node->field_report_type['und'][0]['tid'] == 3)
		{
			$formatted_date = $report_year;

			if($formatted_date == $i )
			{	
				$flag_other++;
			}
		}
	}
	
}	


	if($flag_financial)
	{	
		array_push($years_financial, $i);
	}
	if($flag_compliance)
	{	

		array_push($years_compliance, $i);
	}
	if($flag_other)
	{	
		array_push($years_other, $i);
	}
	
}

if($view->args[0] == 'financial reports')
{	
	if(!empty($years_financial))
	{	
		print_r(display_block($years_financial));
	}
}

if($view->args[0] == 'compliance reports')
{
	if(!empty($years_compliance))
	{	
		print_r(display_block($years_compliance));
	}
}

if($view->args[0] == 'other reports')
{
	if(!empty($years_other))
	{	
		print_r(display_block($years_other));
	}
}

function display_block($years)
{	
	$links = '';
	foreach ($years as $key => $value) {
		$parts = explode('/',$_SERVER['REQUEST_URI']);

		$links .= "<a href='/reports/".$parts[2]."/".$value."'>".$value." ></a><br/>";
	}
	$html = "<div id='archive-block'><h2>Archives</h2>".
	$links
	."</div>";
	return $html;
}


if(!isset($empty))
{
	print $rows;
}

if(isset($empty))
{	
	print $empty;
} 

?>