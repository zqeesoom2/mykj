<?php


namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    public $userModel;
    function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function Register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           return $this->userModel->setUserInfo($this->arrPost['contact'],$this->arrPost['address'],$this->arrPost['username'],$this->arrPost['id']);
        }else{
            $uid = $_SESSION['uid'];
            if(is_numeric($uid)){

                $user = $this->userModel->getUserById($uid);
                include 'Home/Register.php';
            }
        }


    }
}