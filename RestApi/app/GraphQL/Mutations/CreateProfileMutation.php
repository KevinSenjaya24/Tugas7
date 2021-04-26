<?php

namespace App\graphql\Mutations;

use App\Profile;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateProfileMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProfile'
    ];

    public function type(): Type
    {
        return GraphQL::type('Profile');
    }

    public function args(): array
    {
        return [
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

    public function resolve($root, $args)
    {
        $profile = new Profile();
        $profile->fill($args);
        $profile->save();

        return $profile;
    }
}