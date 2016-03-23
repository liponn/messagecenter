<?php 
return array (
  'admin_user' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => true,
      'null' => false,
    ),
    'name' => 
    array (
      'field' => 'name',
      'key' => 'UNI',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => true,
    ),
    'password' => 
    array (
      'field' => 'password',
      'key' => '',
      'default' => '',
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => true,
    ),
    'display_name' => 
    array (
      'field' => 'display_name',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => true,
    ),
    'last_time' => 
    array (
      'field' => 'last_time',
      'key' => '',
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'last_ip' => 
    array (
      'field' => 'last_ip',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => true,
    ),
    'is_del' => 
    array (
      'field' => 'is_del',
      'key' => '',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'apiurls' => 
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
    'ver_id' => 
    array (
      'field' => 'ver_id',
      'key' => '',
      'default' => '0',
      'lenght' => '5',
      'unsigned' => true,
      'null' => false,
    ),
    'category' => 
    array (
      'field' => 'category',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => true,
      'null' => false,
    ),
    'name_cn' => 
    array (
      'field' => 'name_cn',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '50',
      'unsigned' => false,
      'null' => false,
    ),
    'name' => 
    array (
      'field' => 'name',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '30',
      'unsigned' => false,
      'null' => false,
    ),
    'description' => 
    array (
      'field' => 'description',
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
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => false,
      'null' => false,
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
      'default' => NULL,
      'unsigned' => false,
      'null' => true,
    ),
    'pk_name' => 'id',
  ),
  'appinfo' => 
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
    'name' => 
    array (
      'field' => 'name',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '10',
      'unsigned' => false,
      'null' => false,
    ),
    'description' => 
    array (
      'field' => 'description',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '250',
      'unsigned' => false,
      'null' => false,
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
  'apppeacock' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'key' => 'PRI',
      'default' => NULL,
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => true,
      'null' => false,
    ),
    'app_id' => 
    array (
      'field' => 'app_id',
      'key' => '',
      'default' => NULL,
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'app_img' => 
    array (
      'field' => 'app_img',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '255',
      'unsigned' => false,
      'null' => false,
    ),
    'start_time' => 
    array (
      'field' => 'start_time',
      'key' => '',
      'default' => '0',
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => false,
    ),
    'end_time' => 
    array (
      'field' => 'end_time',
      'key' => '',
      'default' => '0',
      'type' => 'int',
      'lenght' => '11',
      'unsigned' => false,
      'null' => false,
    ),
    'app_sort' => 
    array (
      'field' => 'app_sort',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => false,
      'null' => false,
    ),
    'status' => 
    array (
      'field' => 'status',
      'key' => '',
      'default' => NULL,
      'type' => 'tinyint',
      'lenght' => '4',
      'unsigned' => false,
      'null' => false,
    ),
    'pk_name' => 'id',
  ),
  'appver' => 
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
    'os' => 
    array (
      'field' => 'os',
      'key' => '',
      'default' => '0',
      'type' => 'tinyint',
      'lenght' => '3',
      'unsigned' => true,
      'null' => false,
    ),
    'app_id' => 
    array (
      'field' => 'app_id',
      'key' => '',
      'default' => NULL,
      'lenght' => '10',
      'unsigned' => true,
      'null' => false,
    ),
    'ver_code' => 
    array (
      'field' => 'ver_code',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '10',
      'unsigned' => false,
      'null' => false,
    ),
    'ver_name' => 
    array (
      'field' => 'ver_name',
      'key' => '',
      'default' => NULL,
      'type' => 'varchar',
      'lenght' => '25',
      'unsigned' => false,
      'null' => false,
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
);