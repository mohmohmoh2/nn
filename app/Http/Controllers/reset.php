<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class reset extends Controller
{
    //

public function index ()
{
    return view('reset.email');
}

public function emailcheck (Request $request)
{
    $connection = mysqli_connect("localhost", "root", "", "nezam1");
    if(! $connection){echo "problem";}
      // Generate random credintial id for the Reset Password
    $creditId = "";
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";  
    $size = strlen( $chars );  
    for( $i = 0; $i < 6; $i++ ) {  
        $str= $chars[ rand( 0, $size - 1 ) ];
        $creditId = $creditId.$str;
    }
    $data = ['reset' => $creditId];
    //$request->email;
    $users['users'] = User::select('id', 'email')->get();
    $emails = [];
    foreach ($users['users'] as $key => $value) {
        array_push($emails,$value['email']);
    }
    if (in_array($_GET['email'], $emails)) {
        $users['users'] = User::select('id', 'email')->where('email', $_GET['email'])->get();

        $select = "UPDATE `users` SET `reset` = '".$creditId."' WHERE `email` = '".$_GET['email']."' LIMIT 1";
        $result = mysqli_query($connection, $select);
        
        $_SESSION['eee'] = $_GET['email'];
        mail($_GET['email'],"Nezam Verification Code",$creditId);
        setcookie('em', 'done', time()+5);

        return redirect('code/'.$_GET['email']);
    }else{
        setcookie('error', 'This Email Does Not Exist', time()+5);
        return back();
    }
}

public function code ($id)
{
    $id = [
        'id' => $id
        ];
    return view('reset.code')->with($id);
}

public function codecheck ()
{
    $users['users'] = User::select('id', 'email', 'reset')->where('email', $_GET['email'])->get();

    foreach ($users['users'] as $key => $value) {
        if ($value['reset'] == $_GET['code']) {
            return redirect('freset/'.$value['id']);
        }
    }

}

public function reset ($id)
{
    $id = [
        'id' => $id
        ];
    return view('reset.reset')->with($id);
}

public function passcheck ()
{
    $connection = mysqli_connect("localhost", "engmsigl_admin", "J,YkUJVNEA[U", "engmsigl_Nezam");
    if(! $connection){echo "problem";}
    $pass = bcrypt($_GET['new']);
    $select = "UPDATE `users` SET `password` = '".$pass."' WHERE `id` = '".$_GET['id']."' LIMIT 1";
    $result = mysqli_query($connection, $select);
    
    return redirect('login');
}

}
