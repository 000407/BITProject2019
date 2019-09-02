<?php
/**
 * Created by IntelliJ IDEA.
 * User: LocalAdmin
 * Date: 3/9/2019
 * Time: 5:29 PM
 */

class UserController extends BaseController
{
    public function login($postBack = null)
    {
        if(isset($_SESSION["user"]["name"])){
            $url = APPROOT . "/home/index";
            header("location:$url");
        }
        $data = array("postBack"=>$postBack, "pageTitle"=>"Login");
        $this->loadView($data, true);
    }

    public function authenticate()
    {
        $users = array(
            "esoft" => array(
                "username" => "esoft",
                "password" => "Pass123@",
                "roles" => ["ROLE_ROOT", "ROLE_CREATE_REPORT"]
            ),
            "anuruddha" => array(
                "username" => "anuruddha",
                "password" => "Pass123@",
                "roles" => ["ROLE_VIEW_REPORT"]
            )
        );
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];
        $postBack = $_POST["postBack"];

        if (!array_key_exists($username, $users)) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }

        if ($password !== $users[$username]["password"]) {
            header("HTTP/1.1 403 FORBIDDEN");
            return;
        }

        $_SESSION["user"]["name"] = $users[$username];
        $loggedUser = $users[$username];
        unset($loggedUser["password"]);

        $loggedUser["postBack"] = "/home/index";
        if(isset($postBack)){
            $loggedUser["postBack"] = urldecode(urldecode(urldecode($postBack)));
        }
        echo json_encode($loggedUser);
    }

    public function register(){
        if(isset($_SESSION["user"]["name"])) {
            $url = APPROOT . "/home/index";
            header("location:$url");
        }

        $this->loadView(null,true);
    }

    public function doRegistration(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $userData = $_POST["userData"];

        $passHash = password_hash($userData["password"], PASSWORD_BCRYPT);

        $user = new User();
        $user->setUsername($userData["username"]);
        $user->setPassword($passHash);
        $user->setFirstName($userData["firstName"]);
        $user->setLastName($userData["lastName"]);
        $user->setEmail($userData["email"]);
        //TODO: Get the phone and set to user object

        $res = $user->save();
        if($res){
            try {
                $mailer = new BITMailer();
                $mailer->addTo($user->getEmail())
                    ->addSubject("Welcome to BITProject2019")
                    ->addBody("Your registration with the BITProject2019 has been successfully completed!")
                    ->send();
            } catch (Exception $e) {
                //TODO: Log the mailer error!
            }

            //Sending phone verification SMS
            $otp = OTPUtility::generate();
            MessageUtility::sendMessage($user->getPhone(), "Your OTP for phone number verification is $otp");

            $result = array("success"=>true, "message"=>"Welcome " . $user->getFirstName() . "!");
            echo json_encode($result);
        }
        else{
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function exists(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];

        if($username === "admin"){
            echo "false";
        }
        else {
            echo "true";
        }
    }
}