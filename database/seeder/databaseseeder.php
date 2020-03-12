<?php

require_once('../../config/init.php');

try {
  // opag employee
  // Employee::create(8, 1, 'opag employee fname', 'opag employee lname', 'opag employee position');

  // pgo it employee
  // Employee::create(1, 2, 'pgo it employee fname', 'pgo it employee lname', 'pgo it employee position');

  // User::create('admin', 'password');
  // User::create('opag', 'password');

  echo 'Database seeding completed successfully.';
} catch (\Exception $e) {
  die($e->getMessage());
}
