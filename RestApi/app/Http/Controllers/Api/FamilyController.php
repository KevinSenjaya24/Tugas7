<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Family;
use App\Jemaat;
use Storage;
use Rss;
class FamilyController extends Controller
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
        $family = Family::get();
        $items = [];
        foreach($family as $families){
            $item = [
                'id' => $families->id,
                'nkk' => $families->nkk,
                'kepala_keluarga' => $families->kepala_keluarga,
                'created_at' => $families->created_at,
                'updated_at' => $families->updated_at,
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
        $family = Family::get();
        return response($family, 200, ['Content-Type' => 'text/xml']);
    }

    public function details($id)
    {
        $family = Family::find($id);

        return $family;
    }

    public function show($id)
    {
        $jemaat = Jemaat::where('family_id', $id)->get();
        return $jemaat;
    }


    public function create(Request $request)
    {
        $data = new Family;

        $data->nkk = $request->nkk;
        $data->kepala_keluarga = $request->kepala_keluarga;
        
        $status = $data->save();

       
        return "Data Tersimpan";
    }

    public function update(Request $request, $id) 
    {
        $data = Family::find($id);

        $data->nkk = $request->nkk;
        $data->kepala_keluarga = $request->kepala_keluarga;
        
        $status = $data->save();

       
        return "Data Terupdate";
    }

    public function delete($id)
    {
        $family = Family::find($id);
        $family->delete();

        return "Data Terhapus";
    }

}
