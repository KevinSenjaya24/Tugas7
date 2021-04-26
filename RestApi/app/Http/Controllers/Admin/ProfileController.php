<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Profile;
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
            'title' => 'Tugas 7',
            'link'  => 'http://websemantik.com',
            'description' => 'ini adalah rss',
            'category' => [
                'value' => 'Tugas 7',
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
        $data = Profile::get();
        return view('admin.profile.index',["profiles"=>$data]);
    }

    public function indexJSON(Request $request)
    {
        $profile = Profile::all();
        return response()->json($profile);
    }

    

    public function details(Request $request)
    {
        $data = Profile::find($request->id);
        return view('admin.profile.detail',["profile"=>$data]);
    }


    public function update(Request $request)
    {
        if($request->id){
            $data = Profile::find($request->id);
        }else{
            $data = new Profile;
        }


        if($request->foto){
            $path = $request->file('foto')->store('profile');
            $data->foto = $path;
        }

        $data->nrp = $request->nrp;
        $data->nama = $request->nama;
        $data->prodi = $request->prodi;
        $data->fakultas = $request->fakultas;
        $data->universitas = $request->universitas;
        
        $status = $data->save();

       
        if($status){
            return redirect('/profile')->with('success', 'Congrats profile Saved Successfully!');
        }
        return redirect('/profile')->with('error', 'profile Fail to Create!');
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        $profile->delete();

        return redirect('/profile')->with('success', 'Congrats profile Deleted Successfully');
    }
}
