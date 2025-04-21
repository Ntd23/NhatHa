<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
	static public function getSingle($id) {
		return self::find($id);
	}
	static public function DeleteRecord($product_id)
	{
		return self::where('product_id', '=', $product_id)->delete();
	}
	static public function getRecord()
	{
		return self::select(
			'product_sizes.name',
			\DB::raw('MIN(product_sizes.id) as id'),
			\DB::raw('MIN(product_sizes.product_id) as product_id'),
			// Thêm các cột khác nếu cần
		)
			->groupBy('product_sizes.name')
			->orderBy('product_sizes.name', 'asc')
			->get();
	}
}
