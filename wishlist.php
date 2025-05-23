

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
        $email = $_SESSION["user"]["email"];
        $user = $this->getUserByEmail($email);
        if ($user) {
            $wishlistItems = $this->getProductsFromWishlist($email);
            $address = $this->getUserAddress($email);
            if ($wishlistItems) {
                if ($address) {
                    include "App/views/userWithWishlistItems_templete.php";
                    wishListTemplete::generate($wishlistItems, $address["district_name"]);
                } else {
                    include "App/views/userWithWishlistItems_templete.php";
                    wishListTemplete::emptyWishlist("Please update your profile.");
                }
            } else {
                include "App/views/userWithWishlistItems_templete.php";
                wishListTemplete::emptyWishlist("Your wishlist is empty.");
            }
        } else {
            include "App/views/404.php";
        }
    }

    private function notLoggedUser()
    {
        include "App/views/notLogged_user_templete.php";
    }

    private function getUserByEmail($email)
    {
        $result = $this->search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getUserAddress($email)
    {
        $result = $this->search("SELECT `district_name` FROM `user_has_address` INNER JOIN `city` ON `city`.`id`=`user_has_address`.`city_id` 
        INNER JOIN `district` ON `district`.`id`=`city`.`district_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function getProductsFromWishlist($email)
    {
        $result = $this->search("SELECT * FROM `wishlist` INNER JOIN `product` ON `product`.`id`=`wishlist`.`product_id` INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` WHERE `user_email`='" . $email . "'");
        return $result->num_rows > 0 ? $result : null;
    }

    private function search($q)
    {
        return Database::search($q);
    }

    private function iud($q)
    {
        Database::iud($q);
    }
}
?>

