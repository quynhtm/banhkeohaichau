<?php
/*
return array(
	'driver' => 'smtp',
	'host' => 'linux203.gnet.vn',
	'port' => 465,
	'from' => array('address' => 'mail@shopcuatui.com.vn', 'name' => CGlobal::web_name),
	'encryption' => 'ssl',
	'username' => 'mail@shopcuatui.com.vn',
	'password' => '~S;&aWW*ux9H',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);
*/
return array(
	'driver' => 'smtp',
	'host' => '27.118.30.5',
	'port' => 25,
    'from' => array('address' => 'no-reply@sanphamredep.com', 'name' => ucwords(CGlobal::web_name)),
    'username' => 'no-reply@sanphamredep.com',
    'password' => 'F2mft&37',
	'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
);