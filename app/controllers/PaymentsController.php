<?php 
/**
 * Payments Page Controller
 * @category  Controller
 */
class PaymentsController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "payments";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("payments.id", 
			"payments.payement_date", 
			"payments.account_id", 
			"accounts.name AS accounts_name", 
			"payments.category_id", 
			"categories.name AS categories_name", 
			"payments.description", 
			"payments.payment_to", 
			"payments.mode", 
			"payments.amount");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				payments.id LIKE ? OR 
				payments.payement_date LIKE ? OR 
				payments.account_id LIKE ? OR 
				payments.category_id LIKE ? OR 
				payments.description LIKE ? OR 
				payments.payment_to LIKE ? OR 
				payments.mode LIKE ? OR 
				payments.amount LIKE ? OR 
				payments.date_updated LIKE ? OR 
				payments.date_created LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "payments/search.php";
		}
		$db->join("accounts", "payments.account_id = accounts.id", "INNER");
		$db->join("categories", "payments.category_id = categories.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("payement_date", "DESC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->payments_account_id)){
			$vals = $request->payments_account_id;
			$db->where("payments.account_id", $vals, "IN");
		}
		if(!empty($request->payments_category_id)){
			$vals = $request->payments_category_id;
			$db->where("payments.category_id", $vals, "IN");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Payments";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("payments/list.php", $data); //render the full page
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("payement_date","category_id","account_id","description","payment_to","amount","mode");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'payement_date' => 'required',
				'category_id' => 'required',
				'account_id' => 'required',
				'description' => 'required',
				'payment_to' => 'required',
				'amount' => 'required|numeric|min_numeric,1',
				'mode' => 'required',
			);
			$this->sanitize_array = array(
				'payement_date' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'account_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'payment_to' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'mode' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['date_created'] = datetime_now();
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("payments");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payments";
		$this->render_view("payments/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","payement_date","category_id","account_id","description","payment_to","amount","mode");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'payement_date' => 'required',
				'category_id' => 'required',
				'account_id' => 'required',
				'description' => 'required',
				'payment_to' => 'required',
				'amount' => 'required|numeric|min_numeric,1',
				'mode' => 'required',
			);
			$this->sanitize_array = array(
				'payement_date' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'account_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'payment_to' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'mode' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['date_updated'] = datetime_now();
			if($this->validated()){
				$db->where("payments.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("payments");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("payments");
					}
				}
			}
		}
		$db->where("payments.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Payments";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("payments/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","payement_date","category_id","account_id","description","payment_to","amount","mode");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'payement_date' => 'required',
				'category_id' => 'required',
				'account_id' => 'required',
				'description' => 'required',
				'payment_to' => 'required',
				'amount' => 'required|numeric|min_numeric,1',
				'mode' => 'required',
			);
			$this->sanitize_array = array(
				'payement_date' => 'sanitize_string',
				'category_id' => 'sanitize_string',
				'account_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'payment_to' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'mode' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['date_updated'] = datetime_now();
			if($this->validated()){
				$db->where("payments.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("payments.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("payments");
	}
}
