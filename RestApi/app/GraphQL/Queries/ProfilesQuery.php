<?php

namespace App\graphql\Queries;

use App\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProfilesQuery extends Query
{
    protected $attributes = [
        'name' => 'profiles',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Profile'));
    }

    public function resolve($root, $args)
    {
        return Profile::all();
    }
}