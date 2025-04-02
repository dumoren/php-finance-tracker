<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * payments_category_id_option_list Model Action
     * @return array
     */
	function payments_category_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , name AS label FROM categories ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * payments_account_id_option_list Model Action
     * @return array
     */
	function payments_account_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , name AS label FROM accounts ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * payments_paymentsaccount_id_option_list Model Action
     * @return array
     */
	function payments_paymentsaccount_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM accounts";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * payments_paymentscategory_id_option_list Model Action
     * @return array
     */
	function payments_paymentscategory_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM categories";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_expensestoday Model Action
     * @return Value
     */
	function getcount_expensestoday(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(`amount`) FROM `payments` WHERE DATE(`payement_date`) = CURRENT_DATE" ;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_expensesthismonth Model Action
     * @return Value
     */
	function getcount_expensesthismonth(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(`amount`) FROM `payments` WHERE MONTH(`payement_date`) = MONTH(CURRENT_DATE) AND  YEAR(`payement_date`) = YEAR(CURRENT_DATE)" ;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_expensesthisyear Model Action
     * @return Value
     */
	function getcount_expensesthisyear(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(`amount`) FROM `payments` WHERE   YEAR(`payement_date`) = YEAR(CURRENT_DATE)" ;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* barchart_expensesbycategory Model Action
	* @return array
	*/
	function barchart_expensesbycategory(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT SUM(p.`amount`),c.`name` 
FROM `payments` as p,`categories` as c 
WHERE p.`category_id` = c.`id` 
AND MONTH(CURRENT_DATE) = MONTH(`payement_date`)
AND YEAR(CURRENT_DATE) = YEAR(`payement_date`)
GROUP BY  p.`category_id`";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'SUM(p.`amount`)');
		$dataset_labels =  array_column($dataset1, 'name');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* barchart_expensesbyaccount Model Action
	* @return array
	*/
	function barchart_expensesbyaccount(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT SUM(p.`amount`),a.`name` 
FROM `payments` as p,`accounts` as a 
WHERE p.`account_id` = a.`id` 
AND MONTH(CURRENT_DATE) = MONTH(`payement_date`)
AND YEAR(CURRENT_DATE) = YEAR(`payement_date`)
GROUP BY  p.`account_id`";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'SUM(p.`amount`)');
		$dataset_labels =  array_column($dataset1, 'name');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* linechart_expensesthismonth Model Action
	* @return array
	*/
	function linechart_expensesthismonth(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT SUM(`amount`),DAY(`payement_date`) 
FROM `payments` 
WHERE MONTH(CURRENT_DATE) = MONTH(`payement_date`)
AND YEAR(CURRENT_DATE) = YEAR(`payement_date`)
GROUP BY DAY(`payement_date`) 
";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'SUM(`amount`)');
		$dataset_labels =  array_column($dataset1, 'DAY(`payement_date`)');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		//set query result for dataset 2
		$sqltext = "SELECT COUNT(*),DAY(`payement_date`) FROM `payments` 
WHERE MONTH(CURRENT_DATE) = MONTH(`payement_date`)
AND YEAR(CURRENT_DATE) = YEAR(`payement_date`)
GROUP BY DAY(`payement_date`) ";
		$queryparams = null;
		$dataset2 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset2, 'COUNT(*)');
		$dataset_labels =  array_column($dataset2, 'DAY(`payement_date`)');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* linechart_expensesthisyear Model Action
	* @return array
	*/
	function linechart_expensesthisyear(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT SUM(`amount`) as val,DATE_FORMAT(`payement_date`, '%b') as month
FROM `payments` 
WHERE YEAR(CURRENT_DATE) = YEAR(`payement_date`) 
GROUP BY MONTH(`payement_date`)
ORDER BY  MONTH(`payement_date`) ASC";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'val');
		$dataset_labels =  array_column($dataset1, 'month');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		//set query result for dataset 2
		$sqltext = "SELECT COUNT(*) as val, DATE_FORMAT(`date_created`, '%b') as month
FROM `payments` 
WHERE YEAR(CURRENT_DATE) = YEAR(`date_created`)
GROUP BY MONTH(`date_created`)
ORDER BY  MONTH(`date_created`) ASC";
		$queryparams = null;
		$dataset2 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset2, 'val');
		$dataset_labels =  array_column($dataset2, 'month');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
