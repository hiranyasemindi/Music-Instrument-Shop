<?php
require_once "libs/connection.php";
session_start();

$process = new Process();
$process->checkUser();

class Process
{
    public function checkUser()
    {
        if (isset($_SESSION['user'])) {
            $this->loggedUser();
        } else {
            $this->notLoggedUser();
        }
    }

    private function loggedUser()
    {
        $email = $_SESSION['user']['email'];
        $user = $this->getUserByEmail($email);
        $address = $this->getuserAdressDetails($email);
        $cities = $this->loadCities();
        $districts = $this->loadDistricts();
        $provinces = $this->loadProvinces();
        $genders = $this->loadGender();
        if ($user) {
            include "App/views/logged_user_template.php";
            LoggedUserTemplate::generate($user, $address, $genders, $cities, $districts, $provinces);
        } else {
            echo "Not valid user.";
        }
    }

    private function notLoggedUser()
    {
        include "App/views/notLogged_user_templete.php";
    }

    private function getUserByEmail($email)
    {
        $result = $this->search("SELECT * FROM `user` INNER JOIN `gender` ON `user`.`gender_id`=`gender`.`id` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getuserAdressDetails($email)
    {
        $result = $this->search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
            INNER JOIN `district` ON `district`.`id`=`city`.`district_id` INNER JOIN `province` ON `province`.`id`=`district`.`province_id`
            WHERE `user_email` = '" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function loadCities()
    {
        $result = $this->search("SELECT * FROM `city`");
        return $result->num_rows  > 0 ? $result : null;
    }

    private function loadDistricts()
    {
        $result = $this->search("SELECT * FROM `district`");
        return $result->num_rows  > 0 ? $result : null;
    }

    private function loadGender()
    {
        $result = $this->search("SELECT * FROM `gender`");
        return $result->num_rows  > 0 ? $result : null;
    }

    private function loadProvinces()
    {
        $result = $this->search("SELECT * FROM `province`");
        return $result->num_rows  > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }
}
