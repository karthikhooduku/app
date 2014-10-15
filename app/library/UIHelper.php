<?php

/**
 * Class and Function List:
 * Function list:
 * - getDeploymentStatus()
 * Classes list:
 * - UIHelper
 */
class UIHelper
{
	public static function getLabel($status)
	{
		
		/*
		 * Default	<span class="label">Default</span>
Success	<span class="label label-success">Success</span>
Warning	<span class="label label-warning">Warning</span>
Important	<span class="label label-important">Important</span>
Info	<span class="label label-info">Info</span>
Inverse	<span class="label label-inverse">Inverse</span>
		 */
		switch($status)
		{
			case 'Completed' 	: return '<span class="label label-success">'.$status.'</span>'; break;
			case 'In Progress'  : 
			case 'start' 		: 
			case 'started' 		: return '<span class="label label-info">'.$status.'</span>'; break;
			case 'stop' 		: return '<span class="label label-warning">'.$status.'</span>'; break;
			case 'failed' 		: return '<span class="label label-danger">'.$status.'</span>'; break;
			default:			  return '<span class="label label-danger">'.$status.'</span>'; break;
								
		}
		
	}

	public static function getDataOrganized($data, $params)
	{
			//Array ( [config] => Array ( [currency] => USD [unit] => perhr ) [regions] => 
			//Array ( [0] => Array ( [region] => us-east-1 [instanceTypes] 
			//=> Array ( [0] => Array ( [type] => m1.small [os] => linux [price] => 0.06 ) ) ) ) )
			$input = json_decode($params);
			$instanceType = $data['regions'][0]['instanceTypes'];
			$obj = json_decode(json_encode($data));
			
			return '<div class="table-responsive">  <table class="table table-bordered"> '.
              		' <thead> ' .
                		'<th>Ondemand</th>'.
	                    	'<th>Region</th> '.
	                    	'<th>Instance Type</th>'.
	                    	'<th>OS Flavor</th>'.
	                    	'<th>Price</th>'.
                	'</thead>'.
              		'<tr>'.
	              		'<td><span class=".glyphicon-ok-sign"></span></td>'.
	              		'<td>'.$obj->regions[0]->region.'</td>'.
	              		'<td>'.$input->instanceType.'</td>'.
	              		'<td>'.$input->instanceAmi.'</td>'.
	              		'<td>'.'</td>'.
					'</tr>'.
					'</table></div>';
			
	}	
	
	private static function getPrice($data)
	{
		$sym = '';
		switch ($data['config']['currency'])
		{
			case 'USD' : $sym = '$'; break;
		}
		
		return $sym.$data['regions'][0]['instanceTypes'][0]['price'] .' '. $data['config']['unit'];
	}
}
