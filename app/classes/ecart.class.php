<?php

class ecart extends _database {

    use helpers;
    use file_system;
    use variants;

    public function __construct() {
        parent::__construct();
    }

    private function reset_cart_count($items) {
        $items_in_cart = 0; //Going with qty instead of unique items.
        if (count($items)) {
            foreach ($items as $row) {
                $items_in_cart = ($items_in_cart + $row['qty']);
            }
        }
        $_SESSION['total_items'] = $items_in_cart;
    }

    public function clear() {
        $_SESSION['cart']['items'] = [];
        $this->reset_cart_count([]);
        $_SESSION['messages'][] = "Your cart has been cleared";
        $this->safe_redirect('/');
    }

    public function remove(fish_bowl $routing) {
        $_SESSION['messages'][] = "{$_SESSION['cart']['items'][$routing->address['id']]['product_name']} has been removed from your cart.";
        unset($_SESSION['cart']['items'][$routing->address['id']]);
        $this->reset_cart_count($_SESSION['cart']['items']);
        $this->safe_redirect('/ecart/display');
    }
    public function option_add(fish_bowl $routing){
        $this->pretty($_REQUEST);
    }

    public function add(fish_bowl $routing) {

        $has_variant = false; //Assume there's no variant until we check for it.
        $first_add = true;
        //Please see my comments on line 20 of listing_detail.class.php

        if ($routing->method !== 'post') {
            exit('Not enough information. Please use the form.');
        }

        //$this->pretty($_REQUEST);
        if (isset($_REQUEST['variants'])) {

            //This is potentially explosively dangerous if trust the browser here.
            //So all we're doing to do is take the id, and ask the system for variant details.

            $variant = json_decode(base64_decode($_REQUEST['variants']));

            ////If our id is both present, and not numeric, someone is going to a lot of trouble at
            //an injection attempt. Let's catch that and rick roll them again.

            if (!is_numeric($variant->id)) {
                $this->rick_roll();
                exit;
            }
            //Otherwise, we're legit. Let's look up that variant.
            //If this were a real product, I would do some error checking on the return values.
            //But for the purposes of this demo, we're just going to assume that if a variant is submitted...
            //it's there.

            $my_variant = $this->get_single_variant($variant->id);

            //We have to change the sku, so that you could order both a red and green version of whatever item.
            $_SESSION['most_recent']['product_sku'] = $my_variant['variant_sku'];

            //check variant pricing.
            if (($_SESSION['most_recent']['base_price'] != $my_variant['variant_price']) && $my_variant['variant_price'] > 0) {
                $_SESSION['most_recent']['base_price'] = $my_variant['variant_price'];
            }

            $has_variant = true;
        }


        // print "<h1>method is... {$routing->method}</h1>";
        $item_key = hash('md5', $_SESSION['most_recent']['id'] . $_SESSION['most_recent']['product_sku']);

        //If this quantity is not numeric, someone's injecting or abusing the form for other nafarious purposes.
        //Let's rick roll them.

        if (!is_numeric($_REQUEST['qty'])) {
            $this->rick_roll();
            exit;
        }


        if (isset($_SESSION['cart']['items'][$item_key])) {
            $first_add = false;
            $_SESSION['cart']['items'][$item_key]['qty'] = ($_SESSION['cart']['items'][$item_key]['qty'] + $_REQUEST['qty']);
        } else {

            $_SESSION['cart']['items'][$item_key]['id'] = $_SESSION['most_recent']['id'];
            $_SESSION['cart']['items'][$item_key]['thumb'] = $_SESSION['most_recent']['images'][0];
            $_SESSION['cart']['items'][$item_key]['product_name'] = $_SESSION['most_recent']['product_name'];

            if ($has_variant) {

                //add variant to the cart. we'll use this later in the views layer.
                $_SESSION['cart']['items'][$item_key]['variant'] = $my_variant;
            }

            $_SESSION['cart']['items'][$item_key]['base_price'] = $_SESSION['most_recent']['base_price'];
            $_SESSION['cart']['items'][$item_key]['sku'] = $_SESSION['most_recent']['product_sku'];
            $_SESSION['cart']['items'][$item_key]['original_sku'] = $_SESSION['most_recent']['original_sku'];
            $_SESSION['cart']['items'][$item_key]['qty'] = intval($_REQUEST['qty']);
            //$_SESSION['cart']['items'][$item_key]['item_subtotal'] = ($_REQUEST['qty']) * $_SESSION['most_recent']['base_price'];
        }

        $this->reset_cart_count($_SESSION['cart']['items']);

        $variant_message = "";

        if ($has_variant) {

            $add_context = 'in';

            if ($my_variant['item_type'] == 'AC') {
                $add_context = 'with';
            }

            $variant_message = " {$add_context} <strong>{$my_variant['variant_name']}</strong> ";
        }

        if ($first_add) {
            $_SESSION['messages'][] = "<strong>{$_SESSION['cart']['items'][$item_key]['product_name']}</strong> {$variant_message} has been added to your cart.";
        } else {
            $_SESSION['messages'][] = "Another <strong>{$_SESSION['cart']['items'][$item_key]['product_name']}</strong> {$variant_message} has been added to your cart.";
        }

        $_SESSION['most_recent'] = [];
        $this->safe_redirect('/ecart/display');
    }

    public function display() {

        $view = $this->views_root . '/cart.php';
        //$content = $this->product_images($this->listing_record($routing->address['id']))[0]; //fs trait
        include($view);
    }

}
