<?php
if (empty($_SESSION['cart'])) {
        echo 'panier vide';
} else {
        var_dump($_SESSION['cart']);
}
