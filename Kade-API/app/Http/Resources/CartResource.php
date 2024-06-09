<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "itemName"=> Product::findOrFail($this->product_id)->name,
            "qty"=> $this->quantity,
            "subTotal"=> $this->sub_total,
        ];
    }
}
