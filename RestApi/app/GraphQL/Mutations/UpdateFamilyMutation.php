<?php

namespace App\graphql\Mutations;

use App\Family;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateFamilyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateFamily'
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
        $Family = Family::findOrFail($args['id']);
        $Family->fill($args);
        $Family->save();

        return $Family;
    }
}