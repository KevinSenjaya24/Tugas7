<?php

namespace App\graphql\Mutations;

use App\Family;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteFamilyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteFamily',
        'description' => 'Delete a Family'
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
        $Family = Family::findOrFail($args['id']);

        return  $Family->delete() ? true : false;
    }
}