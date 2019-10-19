<?php

class checkout extends _database {

    use helpers;
    use file_system;

    public function __construct() {
        parent::__construct();
    }

    public function main(fish_bowl $routing) {
        $view = $this->views_root . '/checkout.php';

        $this->pretty($_SESSION);
        exit();

        $content = $this->product_images($this->listing_record($routing->address['id']))[0]; //fs trait
        $this->most_recent_product($content);

        include($view);
    }

}
