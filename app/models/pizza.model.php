<?php

//For the sake of argument, a pizza is any complex configurable product.

trait pizza {

    public function proccess_pizza(array $content) {

        $display = [];

        foreach ($content['options'] as $group_id => $group) {
            $group_enum = '';
            $group_enum_selected = '';
            $is_enumerated = false;

            //Check for an enumerated value.

            if (strpos($group['group_enum'], '|')) {

                $is_enumerated = true;

                //Simple enumerated values for the item options
                $group_enum = explode('|', $group['group_enum']);

                //For the complex group level select
                if (strpos($group['group_enum_selected'], '|') && $group['limit_per_item'] == 1) {
                    $raw_selected = explode('|', $group['group_enum_selected']);
                    $group_enum_selected = [
                        'row' => $group ['option_group_name'],
                        'column' => $raw_selected[1]
                    ];
                }


                //Selected index for the enumerated fields.
            }
            foreach ($group['items'] as $key => $item) {
                $variable_options = [];
                if ($is_enumerated) {

                    $i = 0;


                    foreach ($group_enum as $column => $variable_option) {
                        $variable_options['items'][] = $variable_option;
                        if ($group['limit_per_item'] == 1) {
                            if ($item['option_id'] == $raw_selected[0]) {
                                $variable_options['selected'] = $raw_selected[1];
                            } else {
                               
                            }
                        } else {
                             if (is_numeric($group['group_enum_selected'])) {
                                    $variable_options['selected'] = $group['group_enum_selected'];
                                }
                        }
                    }

                    //  $key == $group_enum_selected['row'];
                    //  $item['is_default'] = 'yes';
                }

                $display[$group_id][] = [
                    'option_id' => $item['option_id'],
                    'option_name' => $item['option_name'],
                    'is_default' => $item['is_default'],
                    'options' => $variable_options,
                ];
            }
        }

        print "<h1>Processed Data</h1>";
        $this->pretty($display);

        print "<h2>raw data.</h2>";
        $this->pretty($content);
    }

}
