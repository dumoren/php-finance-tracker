<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Dashboard', 
			'icon' => '<i class="material-icons ">dashboard</i>'
		),
		
		array(
			'path' => 'payments', 
			'label' => 'Payments', 
			'icon' => '<i class="material-icons ">payment</i>'
		),
		
		array(
			'path' => 'accounts', 
			'label' => 'My Accounts', 
			'icon' => '<i class="material-icons ">account_balance_wallet</i>'
		),
		
		array(
			'path' => 'categories', 
			'label' => 'Payment Categories', 
			'icon' => '<i class="material-icons ">apps</i>'
		),
		
		array(
			'path' => '/', 
			'label' => 'Reports', 
			'icon' => '<i class="material-icons ">print</i>','submenu' => array(
		array(
			'path' => '/', 
			'label' => 'Monthly', 
			'icon' => ''
		),
		
		array(
			'path' => '/', 
			'label' => 'Quartely', 
			'icon' => ''
		),
		
		array(
			'path' => '/', 
			'label' => 'Annual', 
			'icon' => ''
		)
	)
		)
	);
		
	
	
			public static $mode = array(
		array(
			"value" => "Cash", 
			"label" => "Cash", 
		),
		array(
			"value" => "Bank", 
			"label" => "Bank", 
		),
		array(
			"value" => "Online", 
			"label" => "Online", 
		),
		array(
			"value" => "Mobile", 
			"label" => "Mobile", 
		),);
		
}