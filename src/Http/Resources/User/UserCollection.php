<?php

namespace Akkurate\LaravelAccountSubmodule\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'includes' => ['permissions','roles','account','phones','addresses','emails'],
        ];
    }
}
