<?php

namespace App;

use App\DB;

class Auth
{

	/*  Check Login Credentials  */
	public function login($username, $password)
	{
		$sql = "SELECT * FROM useraccount_tbl 
						LEFT JOIN employee_tbl 
						ON useraccount_tbl.emp_id=employee_tbl.emp_id 
						LEFT JOIN department_tbl 
						ON useraccount_tbl.dept_id=department_tbl.dept_id
						WHERE username = ?
						LIMIT 1";

		$user = DB::single($sql, [$username]);

		if (!$user) {
			return null;
		}

		if (password_verify($password, $user->password)) {
			// Remove password
			unset($user->password);
			return $user;
		}
	}
}
