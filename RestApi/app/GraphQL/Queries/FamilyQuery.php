<?php

namespace App\GraphQL\Queries;

use App\Family;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class FamilyQuery extends Query
{
    protected $attributes = [
        'name' => 'Family',
    ];

    public function type(): Type
    {
        return GraphQL::type('Family');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Family::findOrFail($args['id']);
    }
}