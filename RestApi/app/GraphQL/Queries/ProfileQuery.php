<?php

namespace App\GraphQL\Queries;

use App\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProfileQuery extends Query
{
    protected $attributes = [
        'name' => 'Profile',
    ];

    public function type(): Type
    {
        return GraphQL::type('Profile');
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
        return Profile::findOrFail($args['id']);
    }
}