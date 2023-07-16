<?php

namespace App\Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * @var array
     */
    private $pagination = [];

    public function __construct($resource)
    {
        parent::__construct($this->withPaginate($resource));
    }


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image_url' => $item['image_url'],
                    'quantity' => $item['quantity'],
                    'quantityLeftPerUser' => $item['quantityLeftPerUser'],
                ];
            }),
            'pagination' => $this->pagination,
            'message' => 'Success'


        ];
    }

    /**
     * @param $resource
     * @return mixed
     */
    protected function withPaginate($resource)
    {
        if($resource->get('current_page')) {
            $this->pagination = [
                'total' => $resource->get('total'),
                'per_page' => $resource->get('per_page'),
                'current_page' => $resource->get('current_page'),
                'total_pages' => $resource->get('last_page'),
            ];

            $resource = $resource->get('data');
        }else {
            $resource = $resource->toArray();
        }

        return $resource;
    }

}
