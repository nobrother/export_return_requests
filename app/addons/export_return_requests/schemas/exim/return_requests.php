<?php

use Tygh\Registry;

include_once( 'return_requests.functions.php' );

$schema = array(
	'section' => 'return_requests',
	'pattern_id' => 'return_requests',
	'name' => __('return_requests'),
	'key' => array('return_id'),
	'order' => 0,
	'table' => 'rma_returns',
	'export_only' => true,
	'permissions' => array(
		'import' => 'manage_users',
		'export' => 'view_users',
	),
	'references' => array(
		'orders' => array(
			'reference_fields' => array( 'order_id' => '&order_id' ),
			'join_type' => 'LEFT'
		),
		'rma_property_descriptions' => array(
			'reference_fields' => array( 'property_id' => '&action' ),
			'join_type' => 'LEFT'
		),
		'statuses' => array(
			'reference_fields' => array( 'status' => '&status', 'type' => STATUSES_RETURN ),
			'join_type' => 'LEFT'
		),
		'status_descriptions' => array(
			'reference_fields' => array( 'status_id' => '#statuses.status_id' ),
			'join_type' => 'LEFT'
		),
		
	),
	'options' => array(
		'delimiter' => array(
			'default_value' => 'C',
		),
	),
	'export_fields' => array(
		'Return ID' => array(
			'db_field' => 'return_id',
			'alt_key' => true,
			'required' => true,
		),
		'Status' => array(
			'db_field' => 'description',
			'table' => 'status_descriptions',
		),
		'Customer Firstname' => array(
			'db_field' => 'firstname',
			'table' => 'orders',
		),
		'Customer Lastname' => array(
			'db_field' => 'lastname',
			'table' => 'orders',
		),
		'Request Date' => array(
			'db_field' => 'timestamp',
			'process_get' => array( 'fn_timestamp_to_date', '#this' ),
		),
		'Action' => array(
			'db_field' => 'property',
			'table' => 'rma_property_descriptions',
		),
		'Order ID' => array(
			'db_field' => 'order_id',
		),
		'Quantity' => array(
			'db_field' => 'total_amount',
		),
	),
);

return $schema;
