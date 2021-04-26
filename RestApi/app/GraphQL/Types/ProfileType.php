<?php

namespace App\GraphQL\Types;

use App\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Profile',
        'description' => 'Collection of Profiles and details of Author',
        'model' => Profile::class
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular book',
            ],
            'nrp' => [
                'name' => 'nrp',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'nama' => [
                'name' => 'nama',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'foto' => [
                'name' => 'foto',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'prodi' => [
                'name' => 'prodi',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'fakultas' => [
                'name' => 'fakultas',
                'type' =>  Type::nonNull(Type::string()),
            ],
            'universitas' => [
                'name' => 'universitas',
                'type' =>  Type::nonNull(Type::string()),
            ],
        ];
    }
}