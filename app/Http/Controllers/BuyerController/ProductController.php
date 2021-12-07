<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request, Session, DB;

class ProductController extends Controller
{
    public function all_product(){
        $all_product = DB::table('branch_category')
        ->get();
        $post_data = array(
            'item' => array(
                'item_type_id' => $all_product[0]->id_branch_category,
                'string_key' => 2,
                'string_value' => 3,
                'string_extra' => 4,
                'is_public' => 5,
                'is_public_for_contacts' => [6,7,8]
            ),'item2' => array(
                'item_type_id' => 1,
                'string_key' => 2,
                'string_value' => 3,
                'string_extra' => 4,
                'is_public' => 5,
                'is_public_for_contacts' => [6,7,8]
            ),
        );
        return response()->json($post_data);
    }
}
