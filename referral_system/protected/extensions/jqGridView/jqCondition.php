<?php
/**
 * Created on 01 06 2012 (11:57 AM)
 *
 */

class jqCondition
{
	public static function getProviderConfig($parametres)
	{
		$sidx	= 't.id';
		$order	= true;
		$search	= false;
		$where	= '';
		
		$page	= $parametres['page']; // get the requested page
		$limit	= $parametres['rows']; // get how many rows we want to have into the grid
		
		if (!empty($parametres['sidx']))
			$sidx	= $parametres['sidx']; // get index row - i.e. user click to sort
		
		if (!empty($parametres['sord']))
		{
			$order	= $parametres['sord'] == 'asc' ? true : false; // get the direction
			$sord	= $parametres['sord']; // get the direction
		}
		
		if (!empty($parametres['_search']))
		{
			$search	= $parametres['_search'] == 'true' ? true : false;
			$filters = json_decode($parametres['filters']);
		}
		
		if ($search == true && !empty($filters))
			$where = self::getSearchWhere($filters);
		
		$providerConfig = array(
			'pagination'=>array(
				'pageSize'=>$limit,
				'currentPage'=>$page-1,
			),
			'sort'=>array(
				'defaultOrder'=>array(
					$sidx=>$order,
				),
			),
			'criteria'=>array(
				'condition'=>$where,
				//'with'=>array('user'),
			),
		);
		
		if (strpos($sidx, '.') === false)
			$sidx = 't.' . $sidx;
		$providerConfig['criteria']['order'] = $sidx . ' ' . $sord;
		
		return $providerConfig;
	}
	
	public static function getSearchWhere($filters)
	{
		$where = '';
		
		// Condition generation for filter group 
		if(count($filters))
		{
			foreach($filters->rules as $index => $rule)
			{
				$rule = self::changeRuleFormat($rule);
				$rule->data = addslashes($rule->data);
				
				$where .= preg_replace('/|\'|\"/', '', $rule->field);
				switch($rule->op)
				{ // There will be more conditions for all possible filters
					case 'eq': $where .= " = '".$rule->data."'"; break;
					case 'ne': $where .= " != '".$rule->data."'"; break;
					case 'bw': $where .= " LIKE '".$rule->data."%'"; break;
					case 'bn': $where .= " NOT LIKE '".$rule->data."%'"; break;
					case 'ew': $where .= " LIKE '%".$rule->data."'"; break;
					case 'en': $where .= " NOT LIKE '%".$rule->data."'"; break;
					case 'cn': $where .= " LIKE '%".$rule->data."%'"; break;
					case 'nc': $where .= " NOT LIKE '%".$rule->data."%'"; break;
					case 'nu': $where .= " IS NULL"; break;
					case 'nn': $where .= " IS NOT NULL"; break;
					case 'in': $where .= " IN ('".str_replace(",", "','", $rule->data)."')"; break;
					case 'ni': $where .= " NOT IN ('".str_replace(",", "','", $rule->data)."')"; break;
					// For numbers
					case 'ef': $where .= " = ".$rule->data.""; break;
					case 'nf': $where .= " != ".$rule->data.""; break;
					case 'lt': $where .= " < ".$rule->data; break;
					case 'le': $where .= " <= ".$rule->data; break;
					case 'gt': $where .= " > ".$rule->data; break;
					case 'ge': $where .= " >= ".$rule->data; break;
					// For datas
					case 'bt': $where .= " >= ".$rule->data . ' AND ' . $rule->field . ' <= ' . $rule->data2 ; break;
					case 'nb': $where .= " <= ".$rule->data . ' OR ' . $rule->field . ' >= ' . $rule->data2 ; break;
				}
					
				// Add the connection logic if this is not the last condition
				if(count($filters->rules) != ($index + 1))
					$where .= " " . addslashes($filters->groupOp) . " ";
			}
		}
			
		// Condition generation for filter subgroup 
		$isSubGroup = false;	
		if(isset($filters->groups))
			foreach($filters->groups as $groupFilters)
			{
				$groupWhere = self::getSearchWhere($groupFilters);	
				// If filter subgroup contains conditions then add them too
				if($groupWhere)
				{
					// Add the connection logic if subgroup conditions add after the filter of this group
					// or after other group conditions
					if(count($filters->rules) or $isSubGroup) $where .= " ".addslashes($filters->groupOp)." ";
					$where .= $groupWhere;
					$isSubGroup = true; // Defines if there is at least one group condition
				}
			}
			
		if($where)
			return '(' . $where . ')';
			
		return ''; // Empty condition
	}
	
	public static function changeRuleFormat($rule)
	{
		switch($rule->field)
		{
			case 't.status':
				$rule->data = array_search($rule->data, Contest::$status);
				break;
			case 't.status_int':
				$rule->field = 't.status';
				if (in_array($rule->data, Contest::$noneTransactionStatus))
					self::$withTransaction = false;
				break;
			case 'transaction.method':
				if ($rule->data == 'authorize') 
					$rule->data = 'authorizenet';
				break;
			case 'prize':
				$rule->field = 'prize + comission'; 
				break;
			case 'weekend_day':
				$rule->field = 'DAYOFWEEK(FROM_UNIXTIME(transaction.paydate))';
				switch(strtolower($rule->data))
				{
					case 'monday':
					case 'mon':
						$rule->data = 2;
						break;
					case 'tuesday':
					case 'tue':
						$rule->data = 3;
						break;
					case 'wednesday':
					case 'wed':
						$rule->data = 4;
						break;
					case 'thursday':
					case 'thu':
						$rule->data = 5;
						break;
					case 'friday':
					case 'fri':
						$rule->data = 6;
						break;
					case 'saturday':
					case 'sat':
						$rule->data = 7;
						break;
					case 'sunday':
					case 'sun':
						$rule->data = 1;
						break;
					case 'yes':
						$rule->op = 'in';
						$rule->data = '1,7';
						break;
				}
				break;
			case 'transaction.paydate':
				preg_match("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})|i", $rule->data, $dataInfo);
				switch($rule->op)
				{
					case 'eq':
						$rule->op = 'bt';
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						$rule->data2 = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'ne':
						$rule->op = 'nb';
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						$rule->data2 = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'lt':
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'le':
						$rule->data = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'gt':
						$rule->data = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'ge':
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
				}
				break;
			//case 'deadline':
			case 'FROM_UNIXTIME(t.publishedon) + INTERVAL t.period DAY';
				//$rule->field = 'UNIX_TIMESTAMP(FROM_UNIXTIME(t.publishedon) + INTERVAL t.period DAY)';
				$rule->field = 'UNIX_TIMESTAMP(' . $rule->field . ')';
				preg_match("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})|i", $rule->data, $dataInfo);
				switch($rule->op)
				{
					case 'eq':
						$rule->op = 'bt';
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						$rule->data2 = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'ne':
						$rule->op = 'nb';
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						$rule->data2 = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'lt':
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'le':
						$rule->data = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'gt':
						$rule->data = mktime(23, 59, 59, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
					case 'ge':
						$rule->data = mktime(0, 0, 0, $dataInfo[1], $dataInfo[2], $dataInfo[3]);
						break;
				}
				break;
			case 'fraud.client_ip':
			case 'fraud.forwarded_ip':
			case 'fraud.winner_ip':
			case 't.ip_address':
				$rule->data = ip2long($rule->data); 
				break;
			case 't.lightning':
				$rule->field = 't.options';
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'nc' : 'cn';
					$rule->data = 'i';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'cn' : 'nc';
					$rule->data = 'i';
				}
				break;
			case 'closed_earlier':
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'gt' : 'lt';
					$rule->data = 'period';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'lt' : 'gt';
					$rule->data = 'period';
				}
				$rule->field = 'stoppedon != 0 AND (stoppedon - publishedon) / 3600 / 24';
				break;
				break;
			case 'fraud.mm_risk_score':
			case 'fraud.mm_proxy_score':
			case 'fraud.winner_proxy_score':
			case 't.proxy_score':
				if ($rule->op == 'eq')
					$rule->op = 'ef';
				break;
			case 'fraud.mm_bin_match':
			case 'fraud.mm_phone_in_billing':
				if ($rule->data == 'not found') 
					$rule->data = 'notfound';
				break;
			case 'winner_ip_in_chs_country':
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'nf' : 'ef';
					$rule->data = 'mm_country_code';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'ef' : 'nf';
					$rule->data = 'mm_country_code';
				}
				$rule->field = 'winner_country_code'; 
				break;
			case 'winner_ip_in_chs_city':
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'nf' : 'ef';
					$rule->data = 'mm_city';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'ef' : 'nf';
					$rule->data = 'mm_city';
				}
				$rule->field = 'winner_city'; 
				break;
			case 'winner_ip_matchs_chs':
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'nf' : 'ef';
					$rule->data = 'client_ip';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'ef' : 'nf';
					$rule->data = 'client_ip';
				}
				$rule->field = 'winner_ip'; 
				break;
			case 'close_winners_register_date':
				if ($rule->op == 'eq')
				{
					$rule->op = ($rule->data == 'no') ? 'gt' : 'lt';
					$rule->data = '7';
				}
				elseif ($rule->op == 'ne')
				{
					$rule->op = ($rule->data == 'no') ? 'lt' : 'gt';
					$rule->data = '7';
				}
				$rule->field = 'abs(winner.joindate/3600/24 - publishedon/3600/24)'; 
				break;
		}
		
		return $rule;
	}
	
	public static function getGridButtons($module, $id, $buttons = array('update', 'delete')) {
		for ($i = 0; $i < count($buttons); $i++)
		{
			if (count($buttons[$i]) == 1)
				$buttons[$i] = array($buttons[$i], ucfirst($buttons[$i]), 'id/' . $id);
			$buttons[$i] = CHtml::link(
				CHtml::image('/images/icons/' . $buttons[$i][0] . '.png', $buttons[$i][1]),
				array('/' . $module . '/' . $buttons[$i][0] . '/' . $buttons[$i][2]), array('class'=>$buttons[$i][0], 'title'=>$buttons[$i][1])
			);
		}
		return '<span class="nowrap">' . implode(' ', $buttons) . '</span>';
	}
}