<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;
use Storage;
use Rss;
class ProfileController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function indexRss()
    {
        $channel = [
            'title' => 'Kevin Senjaya',
            'link'  => 'http://kevin.com',
            'description' => 'ini adalah rssku',
            'category' => [
                'value' => 'html',
                'attr' => [
                    'domain' => 'http://www.kevin.com'
                ]
            ]
        ];

        $rss = Rss::channel($channel);
        $profiles = Profile::get();
        $items = [];
        foreach($profiles as $profile){
            $item = [
                'id' => $profile->id,
                'nkk' => $profile->nrp,
                'nama' => $profile->nama,
                'foto' => $profile->foto,
                'prodi' => $profile->prodi,
                'fakultas' => $profile->fakultas,
                'universitas' => $profile->universitas,
                'created_at' => $profile->created_at,
                'updated_at' => $profile->updated_at,
                'description' => 'description',
                'source' => [
                    'value' => 'moell.cn',
                    'attr' => [
                        'url' => 'http://www.moell.cn'
                    ]
                ]
            ];
            $items[] = $item;
            $rss->item($item);
        }

        return response($rss, 200, ['Content-Type' => 'text/xml']);

        //Other acquisition methods
        //return response($rss->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->fastBuild($channel, $items)->asXML(), 200, ['Content-Type' => 'text/xml']);

        //return response($rss->channel($channel)->items($items)->build()->asXML(), 200, ['Content-Type' => 'text/xml']);

    }
    public function index()
    {
        $profile = Profile::get();
        return response($profile, 200, ['Content-Type' => 'text/xml']);
    }

    public function details($id)
    {
        $profile = Profile::find($id);

        return $profile;
    }


    public function create(Request $request)
    {
        $data = new Family;

        $data->nrp = $request->nrp;
        $data->nama = $request->nama;
        $data->foto = $request->foto;
        $data->prodi = $request->prodi;
        $data->fakultas = $request->fakultas;
        $data->universitas = $request->universitas;
        
        $status = $data->save();

       
        return "Data Tersimpan";
    }

    public function update(Request $request, $id) 
    {
        $data = Family::find($id);

        $data->nrp = $request->nrp;
        $data->nama = $request->nama;
        $data->foto = $request->foto;
        $data->prodi = $request->prodi;
        $data->fakultas = $request->fakultas;
        $data->universitas = $request->universitas;
        
        $status = $data->save();

       
        return "Data Terupdate";
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        $profile->delete();

        return "Data Terhapus";
    }

}
