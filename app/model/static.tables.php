<?php 
return array (
  'log' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'subscribe_id' => 
    array (
      'field' => 'subscribe_id',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => false,
    ),
    'tag_id' => 
    array (
      'field' => 'tag_id',
      'key' => '',
      'default' => NULL,
      'lenght' => '50',
      'unsigned' => false,
      'null' => false,
    ),
    'send_data' => 
    array (
      'field' => 'send_data',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => false,
    ),
    'response_data' => 
    array (
      'field' => 'response_data',
      'key' => '',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => true,
    ),
    'url' => 
    array (
      'field' => 'url',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => false,
    ),
    'err_code' => 
    array (
      'field' => 'err_code',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => false,
    ),
    'retry' => 
    array (
      'field' => 'retry',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => false,
    ),
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => '1',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => true,
    ),
    'create_time' => 
    array (
      'field' => 'create_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => false,
    ),
    'update_time' => 
    array (
      'field' => 'update_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'sqs_log' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'subscribe_id' => 
    array (
      'field' => 'subscribe_id',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => false,
    ),
    'tag' => 
    array (
      'field' => 'tag',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '50',
      'unsigned' => false,
      'null' => false,
    ),
    'source' => 
    array (
      'field' => 'source',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'response' => 
    array (
      'field' => 'response',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'ip_address' => 
    array (
      'field' => 'ip_address',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '100',
      'unsigned' => false,
      'null' => true,
    ),
    'http_code' => 
    array (
      'field' => 'http_code',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => true,
    ),
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => true,
    ),
    'update_time' => 
    array (
      'field' => 'update_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'create_time' => 
    array (
      'field' => 'create_time',
      'key' => '',
      'default' => 'CURRENT_TIMESTAMP',
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'sqs_subscribe' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'tag' => 
    array (
      'field' => 'tag',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => false,
    ),
    'address' => 
    array (
      'field' => 'address',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => false,
    ),
    'desc' => 
    array (
      'field' => 'desc',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => false,
    ),
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => '1',
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => false,
      'null' => true,
    ),
    'create_time' => 
    array (
      'field' => 'create_time',
      'key' => '',
      'default' => 'CURRENT_TIMESTAMP',
      'unsigned' => false,
      'null' => true,
    ),
    'update_time' => 
    array (
      'field' => 'update_time',
      'key' => '',
      'default' => '0000-00-00 00:00:00',
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'subscribe' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'tag_id' => 
    array (
      'field' => 'tag_id',
      'key' => '',
      'default' => NULL,
      'lenght' => '5',
      'unsigned' => true,
      'null' => false,
    ),
    'url' => 
    array (
      'field' => 'url',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => false,
    ),
    'remark' => 
    array (
      'field' => 'remark',
      'key' => '',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => true,
    ),
    'order' => 
    array (
      'field' => 'order',
      'key' => '',
      'default' => '250',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => true,
    ),
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => '1',
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => false,
      'null' => true,
    ),
    'create_time' => 
    array (
      'field' => 'create_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => false,
    ),
    'update_time' => 
    array (
      'field' => 'update_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'tags' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'lenght' => '5',
      'unsigned' => true,
      'null' => false,
    ),
    'title' => 
    array (
      'field' => 'title',
      'key' => '',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '50',
      'unsigned' => false,
      'null' => true,
    ),
    'name' => 
    array (
      'field' => 'name',
      'key' => 'UNI',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '100',
      'unsigned' => false,
      'null' => false,
    ),
    'suber_count' => 
    array (
      'field' => 'suber_count',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => false,
    ),
    'send_ch' => 
    array (
      'field' => 'send_ch',
      'key' => '',
      'default' => '2',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => true,
    ),
    'remark' => 
    array (
      'field' => 'remark',
      'key' => '',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => true,
    ),
    'create_time' => 
    array (
      'field' => 'create_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => false,
    ),
    'update_time' => 
    array (
      'field' => 'update_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
);