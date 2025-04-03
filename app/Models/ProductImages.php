<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImages extends Model
{
	use HasFactory;
  protected $table = 'product_images';
    static public function getSingle($id) {
			return self::find($id);
		}
		public function getLogo()
		{
				if (!empty($this->image_name) && file_exists('storage/product/' . $this->image_name)) {
				return url('storage/product/' . $this->image_name);
			} else {
				return '';
			}
		}
}