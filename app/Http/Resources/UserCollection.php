<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'author' => [
                'name' => 'Bourelle',
                'firstname' => 'Frédéric',
                'email' => 'frederic.bourelle@gmail.com',
                'phone' => '0631843820'
            ],
        ];
    }
}