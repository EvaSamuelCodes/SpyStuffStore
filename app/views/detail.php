<!DOCTYPE html>
<html>
    <head>
        <title><?= $content['product_name'] ?> | SpyStuff.com</title>
        <?php include('meta.php'); ?>
    </head>
    <body>
        <div class="main ">
            <?php include('header.php'); ?>
            <div class="detail clearfix">
                <div class='boxy '>
                    <div class="image clearfix" style="background-image: url('/product_images/<?= $content['images'][0] ?>')"></div>
                    <?php
                    if (count($content['images']) > 1):
                        ?>
                        <div class ="thumbs">
                            <?php
                            for ($i = 0; $i < 6; ++$i):
                                if (isset($content['images'][$i])):
                                    ?>
                                    <div style="background-image: url('/product_images/<?= $content['images'][$i] ?>')"></div>

                                    <?php
                                endif;

                            endfor;
                            ?>

                        </div>

                        <?php
                    endif;
                    ?>

                </div>

                <div class='descriptives clearfix'>
                    <div class='product_name'><h2><?= $content['product_name'] ?></h2></div>
                    <div class='product_description'><p><?= $content['product_description'] ?></p></div>
                </div>     

                <?php
                if ($content['use_options'] == 'none'):
                    ?>
                    <div class="add_to_cart_form clearfix">
                        <form method="post" action="/ecart/add">
                            <div >Price:</div><div> <strong id="price">$<?= $content['base_price'] ?></strong></div>

                            <?php
                            //Variants
                            if (count($content['variants']) > 1):
                                ?>
                                <div>Variant: </div>
                                <div>
                                    <select name="variants" id="variants">
                                        <?php
                                        foreach ($content['variants'] as $variant):
                                            ?>
                                            <option value="<?= base64_encode(json_encode($variant)) ?>"<?php
                                            if ($variant['default_selected'] == 'yes') {
                                                print 'selected="selected"';
                                            }
                                            ?>><?= $variant['variant_name'] ?></option>
                                                    <?php
                                                endforeach;
                                                ?>
                                    </select>
                                </div>
                                <?php
                            endif;
                            ?>

                            <div>Quantity:</div>
                            <div><input type="text" class="qty" name="qty" value="1"/></div>
                            <div><input type="submit" class="button" value="Add to Cart"></div>
                        </form>
                    </div>
                    <?php
                else:
                    //options
                    ?>
                    <div class="options">
                        <form method="post" action="/ecart/option_add">
                            <table border="1">
                                <?php
                                $current_id = 0;
                                if (count($content['options'])):
                                    ?>
                                    <?php
                                    foreach ($content['options'] as $key => $row):
                                        if ($key != $current_id):
                                            ?>
                                            <tr>
                                                <th><?= $row['option_group_name'] ?></th>
                                                <?php
                                                //Group enums are for things like quantity of an item.
                                                if (strlen($row['group_enum'])):
                                                    print "<th></th>";
                                                    $values = explode('|', $row['group_enum']);
                                                    foreach ($values as $value):
                                                        ?>
                                                        <th><?= $value ?></th>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tr>
                                            <?php
                                        endif;
                                        $box_type = 'checkbox';

                                        //Limit per item makes the entire group variable.
                                        //So it would make everything in the group a radio.

                                        if ($row['limit_per_item'] == 1):
                                            $box_type = 'radio';
                                        endif;


                                        //Loop the items under this group id.

                                        foreach ($row['items'] as $option):

                                            $field_name = 'option[' . $option['option_id'] . ']';

                                            if ($option['limit_per_item'] == 1):
                                                $field_name = 'option[' . $option['option_group_id'] . ']';
                                            endif;
                                            ?>
                                            <tr>
                                                <?php
                                                if (!strlen($row['group_enum'])):
                                                    $selected = '';

                                                    if ($option['is_default'] == 'yes'):
                                                        $selected = 'checked="true"';
                                                    endif;
                                                    ?>
                                                    <td>
                                                        <input <?= $selected ?> name="<?= $field_name ?>" type="<?= $box_type ?>" value="<?= $option['option_id'] ?>" />
                                                    </td>
                                                    <?php
                                                else:
                                                    ?>
                                                    <td></td>
                                                <?php
                                                endif;
                                                ?>
                                                <td>
                                                    <?= $option['option_name'] ?>
                                                </td>
                                                <?php
                                                
                                                //Rewrite for my own sanity.
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                if (strlen($row['group_enum'])):
                                                    $values = explode('|', $row['group_enum']);
                                                    foreach ($values as $key => $value):
                                                        $selected = '';
                                                        if (strpos($option['group_enum_selected'], '|')):


                                                            $enum_group_selected = explode('|', $option['group_enum_selected']);

                                                            //The solution to the multiple select problem is in defining the enum group selection as two pieces in this case.
                                                            //Not to be confused with the way we do this on a per option for things not enumerated out.
                                                            //Maybe that should be revisited.

                                                            if ($value == $enum_group_selected[1] && $option['option_id'] == $enum_group_selected[0]):
                                                                $selected = 'checked="true"';
                                                            endif;
                                                        endif;
                                                        ?>
                                                        <td align="center"><input <?= $selected ?> name="<?= $field_name ?>" type="radio" value="<?= $option['option_id'] ?>|<?= $key ?>"/></td>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endforeach;
                                    ?>

                                    <?php
                                endif;
                                ?>

                            </table>
                            <input type="submit" value="add to cart"/>
                        </form>
                    </div>

                <?php
                endif;
                /*
                  Notes:
                  Figure out how to set the default in situations where there is both a limited option
                  and a set of keys.
                 */
              //  $this->pretty($content);
                ?>
            </div>       
            <?php include('footer.php'); ?>

        </div>
        <?php include('scripts.php'); ?>

    </body>
</html>
