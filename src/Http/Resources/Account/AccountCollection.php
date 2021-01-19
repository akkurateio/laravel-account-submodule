<?php

namespace Akkurate\LaravelAccountSubmodule\Http\Resources\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountCollection extends ResourceCollection
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
            'includes' => ['permissions','children','users','country','phones','addresses','emails'],
        ];
    }
}
