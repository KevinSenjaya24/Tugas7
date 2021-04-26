<?php

namespace App\graphql\Mutations;

use App\Family;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateFamilyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createFamily'
    ];

    public function type(): Type
    {
        return GraphQL::type('Family');
    }

    public function args(): array
    {
        return [
            'nkk' => [
                'name' => 'nkk',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'kepala_keluarga' => [
                'name' => 'kepala_keluarga',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $Family = new Family();
        $Family->fill($args);
        $Family->save();

        return $Family;
    }
}