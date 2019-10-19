<?php

trait variants {
    
    //Variants are similar to options.
    //Difference being that you can only add one at a time. 
    //Options work in groups, variants work as rows.
    
    private function get_single_variant(int $variant_id){
        
        $sql = "select * from option_variants where id = :variant_id limit 0,1";
        $variant = $this->db->prepare($sql);
        $variant->bindParam(':variant_id', $variant_id);
        $variant->execute();
        return $variant->fetch(\PDO::FETCH_ASSOC);
        
    }

    private function get_variant_data(int $product_id, float $base_price) {
        
        $sql = "select * from option_variants where product_id = :product_id order by display_order";
        $variant = $this->db->prepare($sql);
        $variant->bindParam(':product_id', $product_id);

        $variant->execute();
        $results = $variant->fetchAll(\PDO::FETCH_ASSOC);

        $out = [];

        foreach ($results as $key => $row) {

            if ($row['variant_price'] == 0.00) {
                $row['variant_price'] = $base_price;
            }
            $out[] = $row;
        }

        if (count($out)) {
           // $this->pretty($out);
            return $out;
        }
        return [false];
    }

}
