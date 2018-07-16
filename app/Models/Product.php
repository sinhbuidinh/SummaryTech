<?php

namespace App\Models;

use App\Models\BaseModel;

class Product extends BaseModel
{
    const PRODUCT_TYPE_PRESS_BOARD_NAME = 'Ván ép';
    const SEPARATE_SIZE_PRODUCT = 'x ';
    
    public function product_type()
    {
        return $this->hasOne('App\Models\ProductType', 'id', 'deck_type');
    }

    public function getDisplayNameAttribute()
    {
        $disp_name = self::PRODUCT_TYPE_PRESS_BOARD_NAME;

        //phủ gì
        $product_type = $this->product_type()->select('*')->get()->first();
        $deck_type = $product_type->name;

        if (!empty($deck_type)) {
            $disp_name .= ' '.$deck_type;
        }

        //code name
        $code_name = $this->code_name;
        if (!empty($code_name)) {
            $disp_name .= ' '.$code_name;
        }

        //color
        $product_color_name = $this->getDisplayColor();
        if (!empty($product_color_name)) {
            $disp_name .= ' '.$product_color_name;
        }

        //heightxwidthxlength(unit_size)
        $size = $this->getDisplaySizeProduct();
        $disp_name .= ' '.$size;

        return $disp_name;
    }
    
    private function getDisplayColor()
    {
        $key1 = CONFIG_ARR_BY_KEY;
        $val1 = CONFIG_ARR_BY_CODE;
        $product_key_code = getKubunCustom('division.product', 'product_color', $key1, $val1);
        $product_no_color = $product_key_code['no_color'];
        
        if ($this->color == $product_no_color) {
            return '';
        }
        
        $key = CONFIG_ARR_BY_CODE;
        $val = CONFIG_ARR_BY_NAME;
        
        $product_color_list = getKubunCustom('division.product', 'product_color', $key, $val);
        $product_color_name = $product_color_list[$this->color];
        
        return $product_color_name;
    }
    
    private function getDisplaySizeProduct()
    {
        $height = $this->height;
        $width = $this->width;
        $length = $this->length;
        $unit_size = $this->unit_size;
        
        return '<br/>('. $height. self::SEPARATE_SIZE_PRODUCT
                . $width . self::SEPARATE_SIZE_PRODUCT
                . $length . ' '
                . $unit_size. ')';
    }
}
