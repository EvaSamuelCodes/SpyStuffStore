<?php

class listings extends _database {

    use helpers;
    use file_system;

    public function __construct() {
        parent::__construct();
    }

    public function main() {

        $view = $this->views_root . '/listings.php';
        $content = $this->product_images($this->listing_records()); //fs trait
        
        include($view);
    }
    public function listing_records(): array {

        //Pull the list of products.

        $sql = "select `id`, `product_name`, `product_sku`, `base_price`,`use_options` from products order by product_name";
        $product_list = $this->db->prepare($sql);
        $product_list->execute();
        $results = $product_list->fetchAll(\PDO::FETCH_ASSOC);
        if (count($results)) {
            return $results;
        }
        return [false];
    }

}
