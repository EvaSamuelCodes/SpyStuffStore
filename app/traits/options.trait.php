<?php

trait options {

    private function get_option_data(int $product_id) {
        $sql = "SELECT
                    `products`.`id` AS `product_id`
                    , `option_groups`.`id` as `option_group_id`
                    , `options`.`id` as option_id
                    , `option_groups`.`option_group_name`
                    , `options`.`option_name`
                    , `options`.`is_default`
                    , `options`.`price_addon`
                    , `options`.`addon_type`
                    , `options`.`option_sku`
                    , `option_groups`.`option_required`
                    , `option_groups`.`group_enum`
                    , `option_groups`.`group_enum_selected`
                    , `option_groups`.`group_display_order`
                    , `options`.`option_display_order`
                    , `option_groups`.`limit_per_item`
                FROM
                    `products`
                    INNER JOIN `product_options` 
                        ON (`products`.`id` = `product_options`.`product_id`)
                    INNER JOIN `option_groups` 
                        ON (`product_options`.`option_group_id` = `option_groups`.`id`)
                    INNER JOIN `options` 
                        ON (`product_options`.`option_group_id` = `options`.`option_group_id`)
                    WHERE `products`.`id` = :product_id
                ORDER BY `option_groups`.`group_display_order` ASC, `options`.`option_display_order` ASC;";
        
        $options = $this->db->prepare($sql);
        $options->bindParam(':product_id', $product_id);

        $options->execute();
        $raw =  $options->fetchAll(\PDO::FETCH_ASSOC);
        
        $out = [];
        
        $current_id = 0;
        foreach($raw as $row){
            //Set the array up.
            if($row['option_group_id'] !=$current_id){
                $current_id = $row['option_group_id'];
                $out[$current_id]['limit_per_item'] = $row['limit_per_item'];
                $out[$current_id]['option_group_name'] = $row['option_group_name'];
                $out[$current_id]['option_required'] = $row['option_required'];
                $out[$current_id]['group_enum'] = $row['group_enum'];
                $out[$current_id]['group_enum_selected'] = $row['group_enum_selected'];
            }
            
            $out[$current_id]['items'][] = $row;
            
        }
        return $out;
        
    }

}
