<?php

class listing_detail extends _database {

    use helpers;
    use file_system;
    use variants;
    use options;
    use pizza;

    public function __construct() {
        parent::__construct();
    }

    public function main(fish_bowl $routing) {
        $view = $this->views_root . '/detail.php';
        $content = $this->product_images($this->listing_record($routing->address['id']))[0]; //fs trait
        $this->most_recent_product($content);

        if ($content['use_options'] == 'none') {
            include($view);
        } else {
            $this->proccess_pizza($content);
        }
    }

    private function most_recent_product(array $product_details) {

        //For regular use cases, where you're viewing the site in one browser window at a time,
        //this should work. This would probably break the cart in a multi-window scenario, though.
        //Alternatively, you could avoid the multi-window problem by submitting the id and qty,
        //then hitting the database again when you add an item to the cart. 
        //This is lighter, and that's why I'm going with it.

        $_SESSION['most_recent'] = $product_details;
    }

    public function listing_record(int $id): array {

        //Pull the particular product from the list.

        $sql = "select  `id`, `product_name`, `product_description`, `product_sku`,`product_sku` as `original_sku`, `base_price`,`use_options` from products where id=:id";
        $listing = $this->db->prepare($sql);
        $listing->bindParam(':id', $id);

        $listing->execute();
        $result = $listing->fetch(\PDO::FETCH_ASSOC);

        if ($result['use_options'] != 'none') {
            $result['options'] = $this->get_option_data($id);
        }

        if (isset($result['id'])) {
            $variants = $this->get_variant_data($result['id'], $result['base_price']);
            if (count($variants))
                $result['variants'] = $variants;
        }

        return [$result];
    }

}
