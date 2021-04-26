<?php

namespace App\graphql\Mutations;

use App\Profile;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class UpdateProfileMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateProfile'
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
        $Profile = Profile::findOrFail($args['id']);
        $Profile->fill($args);
        $Profile->save();

        return $Profile;
    }
}