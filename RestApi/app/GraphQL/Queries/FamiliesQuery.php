<?php

namespace App\graphql\Queries;

use App\Family;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class FamiliesQuery extends Query
{
    protected $attributes = [
        'name' => 'families',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Family'));
    }

    public function resolve($root, $args)
    {
        return Family::all();
    }
}