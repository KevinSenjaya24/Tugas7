<?php

namespace App\GraphQL\Types;

use App\Family;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class FamilyType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Family',
        'description' => 'Collection of Familys and details of Author',
        'model' => Family::class
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular book',
            ],
            'nkk' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the book',
            ],
            'kepala_keluarga' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the author of the book',
            ]
        ];
    }
}