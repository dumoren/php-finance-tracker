<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("payments/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Payments 
                    </a>
                </div>
                <div class="col-sm-3 ">
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('payments'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('payments'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('payments'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-6 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3">
                                <div class="card-header h4 h4">Account</div>
                                <div class="p-2">
                                    <?php 
                                    $payments_account_id_options = $comp_model -> payments_paymentsaccount_id_option_list();
                                    if(!empty($payments_account_id_options)){
                                    $ci = 0;
                                    foreach($payments_account_id_options as $option){
                                    $ci++;
                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                    $checked = $this->set_field_checked('payments_account_id', $value);
                                    ?>
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="payments_account_id[]"  />
                                            <span class="custom-control-label"><?php echo $label; ?></span>
                                        </label>
                                        <?php
                                        }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group text-center">
                                    <button class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 comp-grid">
                            <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Category</div>
                                    <div class="p-2">
                                        <?php 
                                        $payments_category_id_options = $comp_model -> payments_paymentscategory_id_option_list();
                                        if(!empty($payments_category_id_options)){
                                        $ci = 0;
                                        foreach($payments_category_id_options as $option){
                                        $ci++;
                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                        $checked = $this->set_field_checked('payments_category_id', $value);
                                        ?>
                                        <label class="custom-control custom-checkbox custom-control-inline">
                                            <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="payments_category_id[]"  />
                                                <span class="custom-control-label"><?php echo $label; ?></span>
                                            </label>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 comp-grid">
                                <?php $this :: display_page_errors(); ?>
                                <div class="filter-tags mb-2">
                                    <?php
                                    if(!empty(get_value('payments_account_id'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Payments Account Id :</b> 
                                        <?php 
                                        if(get_value('payments_account_idlabel')){
                                        echo get_value('payments_account_idlabel');
                                        }
                                        else{
                                        echo get_value('payments_account_id');
                                        }
                                        $remove_link = unset_get_value('payments_account_id', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('payments_category_id'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Payments Category Id :</b> 
                                        <?php 
                                        if(get_value('payments_category_idlabel')){
                                        echo get_value('payments_category_idlabel');
                                        }
                                        else{
                                        echo get_value('payments_category_id');
                                        }
                                        $remove_link = unset_get_value('payments_category_id', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div  class=" animated fadeIn page-content">
                                    <div id="payments-list-records">
                                        <div id="page-report-body" class="table-responsive">
                                            <table class="table  table-striped table-sm text-left">
                                                <thead class="table-header bg-light">
                                                    <tr>
                                                        <th class="td-checkbox">
                                                            <label class="custom-control custom-checkbox custom-control-inline">
                                                                <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                                <span class="custom-control-label"></span>
                                                            </label>
                                                        </th>
                                                        <th class="td-sno">#</th>
                                                        <th  class="td-payement_date"> Payment Date</th>
                                                        <th  class="td-account_id"> Account</th>
                                                        <th  class="td-category_id"> Category</th>
                                                        <th  class="td-description"> Description</th>
                                                        <th  class="td-payment_to"> Payment To</th>
                                                        <th  class="td-mode"> Mode</th>
                                                        <th  <?php echo (get_value('orderby')=='amount' ? 'class="sortedby td-amount"' : null); ?>>
                                                            <?php Html :: get_field_order_link('amount', "Amount"); ?>
                                                        </th>
                                                        <th class="td-btn"></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if(!empty($records)){
                                                ?>
                                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <!--record-->
                                                    <?php
                                                    $counter = 0;
                                                    foreach($records as $data){
                                                    $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                    $counter++;
                                                    ?>
                                                    <tr>
                                                        <th class=" td-checkbox">
                                                            <label class="custom-control custom-checkbox custom-control-inline">
                                                                <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                                    <span class="custom-control-label"></span>
                                                                </label>
                                                            </th>
                                                            <th class="td-sno"><?php echo $counter; ?></th>
                                                            <td class="td-payement_date">
                                                                <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                                    data-value="<?php echo $data['payement_date']; ?>" 
                                                                    data-pk="<?php echo $data['id'] ?>" 
                                                                    data-url="<?php print_link("payments/editfield/" . urlencode($data['id'])); ?>" 
                                                                    data-name="payement_date" 
                                                                    data-title="Enter Payment Date" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="flatdatetimepicker" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" >
                                                                    <span title="<?php echo human_datetime($data['payement_date']); ?>" class="has-tooltip">
                                                                        <?php echo relative_date($data['payement_date']); ?>
                                                                    </span>
                                                                </span>
                                                            </td>
                                                            <td class="td-account_id">
                                                                <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("accounts/view/" . urlencode($data['account_id'])) ?>">
                                                                    <i class="material-icons">visibility</i> <?php echo $data['accounts_name'] ?>
                                                                </a>
                                                            </td>
                                                            <td class="td-category_id">
                                                                <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("categories/view/" . urlencode($data['category_id'])) ?>">
                                                                    <i class="material-icons">visibility</i> <?php echo $data['categories_name'] ?>
                                                                </a>
                                                            </td>
                                                            <td class="td-description">
                                                                <span  data-pk="<?php echo $data['id'] ?>" 
                                                                    data-url="<?php print_link("payments/editfield/" . urlencode($data['id'])); ?>" 
                                                                    data-name="description" 
                                                                    data-title="Enter Description" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="textarea" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" >
                                                                    <?php echo $data['description']; ?> 
                                                                </span>
                                                            </td>
                                                            <td class="td-payment_to">
                                                                <span  data-value="<?php echo $data['payment_to']; ?>" 
                                                                    data-pk="<?php echo $data['id'] ?>" 
                                                                    data-url="<?php print_link("payments/editfield/" . urlencode($data['id'])); ?>" 
                                                                    data-name="payment_to" 
                                                                    data-title="Enter Payment To" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="text" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" >
                                                                    <?php echo $data['payment_to']; ?> 
                                                                </span>
                                                            </td>
                                                            <td class="td-mode">
                                                                <span  data-source='<?php echo json_encode_quote(Menu :: $mode); ?>' 
                                                                    data-value="<?php echo $data['mode']; ?>" 
                                                                    data-pk="<?php echo $data['id'] ?>" 
                                                                    data-url="<?php print_link("payments/editfield/" . urlencode($data['id'])); ?>" 
                                                                    data-name="mode" 
                                                                    data-title="Select a value ..." 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="select" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" >
                                                                    <?php echo $data['mode']; ?> 
                                                                </span>
                                                            </td>
                                                            <td class="td-amount"> <span class="badge badge-success">$<?php echo  $data['amount']; ?></span></td>
                                                            <th class="td-btn">
                                                                <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("payments/edit/$rec_id"); ?>">
                                                                    <i class="material-icons">edit</i> 
                                                                </a>
                                                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("payments/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                    <i class="material-icons">clear</i>
                                                                </a>
                                                            </th>
                                                        </tr>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <!--endrecord-->
                                                    </tbody>
                                                    <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                                <?php 
                                                if(empty($records)){
                                                ?>
                                                <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                                    <i class="material-icons">block</i> No record found
                                                </h4>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if( $show_footer && !empty($records)){
                                            ?>
                                            <div class=" border-top mt-2">
                                                <div class="row justify-content-center">    
                                                    <div class="col-md-auto justify-content-center">    
                                                        <div class="p-3 d-flex justify-content-between">    
                                                            <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("payments/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                                <i class="material-icons">clear</i> Delete Selected
                                                            </button>
                                                            <div class="dropup export-btn-holder mx-1">
                                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="material-icons">save</i> Export
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                        </a>
                                                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                            </a>
                                                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                                </a>
                                                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                                    </a>
                                                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">   
                                                                            <?php
                                                                            if($show_pagination == true){
                                                                            $pager = new Pagination($total_records, $record_count);
                                                                            $pager->route = $this->route;
                                                                            $pager->show_page_count = true;
                                                                            $pager->show_record_count = true;
                                                                            $pager->show_page_limit =true;
                                                                            $pager->limit_count = $this->limit_count;
                                                                            $pager->show_page_number_list = true;
                                                                            $pager->pager_link_range=5;
                                                                            $pager->render();
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
