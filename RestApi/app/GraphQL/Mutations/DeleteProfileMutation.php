<?php

namespace App\graphql\Mutations;

use App\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteProfileMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProfile',
        'description' => 'Delete a Profile'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }


    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $Profile = Profile::findOrFail($args['id']);

        return  $Profile->delete() ? true : false;
    }
}