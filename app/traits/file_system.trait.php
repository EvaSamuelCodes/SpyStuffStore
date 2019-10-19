<?php

trait file_system {

    //Appends product images to the product array based on sku.
    //We'll use this a few times in a couple of different classes, so it
    //makes sense to share it.

    public $accetable_image_types = [
        'png', 'jpg'
    ];
    
    //These two should probably be in the configuration file.
    //But they're here. Yay!
    
    public $views_root = FILE_ROOT . '/app/views';
    public $listing_pics = FILE_ROOT . '/product_images';

    public function product_images(array $products): array {

        $out = [];
        foreach ($products as $key => $product) {
            $out[$key] = $product;

            $directory = $this->listing_pics . '/' . $product['product_sku'];

            if (file_exists($directory)) {
                $images_list = (scandir($directory));

                //  $this->pretty($images_list);

                if (count($images_list) > 2) {
                    foreach ($images_list as $image) {

                        // $this->pretty($image);

                        if (strlen($image) > 4) {
                            $image_parts = explode('.', $image); //Strict warnings
                            $image_parts = end($image_parts);

                            if (in_array($image_parts, $this->accetable_image_types)) {  //really simple extension verification.
                                $out[$key]['images'][] = $product['product_sku'] . '/' . $image;
                            }
                        }
                    }
                }
            } else {
                $out[$key]['images'][] = 'no-image.jpg';
            }
        }
        if (count($out)) {
            return $out;
        }

        return [false];
    }

}
