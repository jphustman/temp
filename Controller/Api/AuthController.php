<?php

use \Firebase\JWT\JWT;
use \Model\User as User;

class AuthController extends BaseController
{


    public function __construct() {
        $this->jwt = new JWT;
        $this->user = new User(0,0,"","","", "");
    }

    function registerAction() {
        // Save User to Database
        $userId = UserFactory::create([
            'username' => $_REQUEST['username'],
            'email' => $_REQUEST['email'],
            'password' => password_hash($_REQUEST['password'], PASSWORD_BCRYPT)
        ]);

        if (isset($_REQUEST['role'])) {
            //$roles = Role::whereIn('name', $req->body->roles)->get();
            //$user->roles()->sync($roles);
        } else {
            // user role = 1
            $role = UserRoleFactory::setUserRole(1, $userId);
        }

        return $this->sendOutput(
            json_encode(['message' => "User was registered successfully!"]),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

    function signinAction() {
        $userQry = UserFactory::getUserByUsername([
            'username' => $_REQUEST['username']
        ]);
        if (!$userQry) {
            return $this->sendOutput(
                json_encode(['message' => "User Not found!"]),
                array('Content-Type: application/json', 'HTTP/1.1 500 ERROR')
            );
        }

        if (!password_verify($_REQUEST['password'], $userQry[0]['password'])) {
            return $this->sendOutput(
                json_encode(['message' => "Password does not match!"]),
                array('Content-Type: application/json', 'HTTP/1.1 500 ERROR')
            );
        }
        // If they made it this far they are in!
        // lets fill up their User object and send it back to React
        $role = UserRoleFactory::getUserRole($userQry[0]['username'])[0]['name'];
        $user = [
            'id' => $userQry[0]['id'],
            'apiaryid' => $userQry[0]['apiaryid'],
            'username' => $userQry[0]['username'],
            'email' => $userQry[0]['email'],
            'roles' => $role,
            'accessToken' => 'tempaccesstoken'
        ] ;
        return $this->sendOutput(
            json_encode($user)
        );

        exit;

        /*

        if (password_verify($req->body->password, PASSWORD_BCRYPT) !== $user->password) {
            return $res->status(401)->send([
                'accessToken' => null,
                'message' => "Invalid Password!"
            ]);
        }

        $token = $jwt->encode(['id' => $user->id], config('secret'), 'HS256');

        $authorities = [];
        foreach ($user->roles as $role) {
            array_push($authorities, "ROLE_" . strtoupper($role->name));
        }

        return $res->status(200)->send([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'roles' => $authorities,
            'accessToken' => $token
        ]);
        */
    }


}