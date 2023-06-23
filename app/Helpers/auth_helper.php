<?php
function authenticate($array = [])
{

    // check if logged in
    if (!session()->get('isLoggedIn')) {
        // save user start link
        if (isset($_SESSION)) {
			// save starting url
			$currentURL = current_url(); //http://myhost/main
			$params   = $_SERVER['QUERY_STRING']; //my_id=1,3
			if(strlen($params) > 0) $currentURL = $currentURL . '?' . $params;
			$_SESSION['user_start_url'] = $currentURL;
		}

        return '/login';
    }

    // matches the role?
    if (!empty($array)) {
        $search_role_in_args = array_search(session()->get('role'), $array);
        if (!is_numeric($search_role_in_args)) {
            return '/logout';
        }
    }
}

function userName(){
    if(!session()->get('isLoggedIn')) return "Unknown";
    return session()->get('firstname') . ' ' . session()->get('lastname');
}

function getUserIcon(){ 
    $name = (session()->get('isLoggedIn'))?(session()->get('firstname')[0] . session()->get('lastname')[0]):'';
    return '<span width="30" height="30" class="rounded-circle bg-secondary p-1">'.$name.'</span>';
}

