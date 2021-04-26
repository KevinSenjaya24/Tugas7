<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rss;

class RssController extends Controller
{

    public function news(Request $request)
    {
        $berita = [];
        $sindonews = simplexml_load_file("https://www.sindonews.com/feed");
        foreach ($sindonews->channel->item as $value) {
            array_push($berita, [
                'sumber' =>'sindonews',
                'title' => $value->title,
                'published_date' => $value->pubDate,
                'link' => $value->link
            ]);
        } 
        


        $antara = simplexml_load_file("https://www.antaranews.com/rss/terkini.xml");
        foreach ($antara->channel->item as $value) {
            array_push($berita, [
                'sumber' =>'antara',
                'title' => $value->title,
                'published_date' => $value->pubDate,
                'link' => $value->link
            ]);
        } 

        $tribun = simplexml_load_file("https://www.tribunnews.com/rss");
        foreach ($tribun->channel->item as $value) {
            array_push($berita, [
                'sumber' =>'antara',
                'title' => $value->title,
                'published_date' => $value->pubDate,
                'link' => $value->link
            ]);
        } 

        
        // $viva = simplexml_load_file("https://rss.viva.co.id");
        return response()->json(compact('berita'));
    }

    public function tribun() {
        return view('admin.rss.tribun');
    }


    public function rssData(Request $request)
    {
        $news = [];

        $news = array_merge($news, $this->parsingRSS('antara', 'https://www.antaranews.com/rss/terkini.xml', $request));
        $news = array_merge($news, $this->parsingRSS('sindonews', 'https://www.sindonews.com/feed', $request));
        $news = array_merge($news, $this->parsingRSS('tribunnews', 'https://www.tribunnews.com/rss', $request));

        return response()->json(compact('news'));
    }

    public function parsingRSS($source, $link, Request $request)
    {
        $news = [];
        $xmlString = file_get_contents($link);
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $array = json_decode($json);

        foreach ($array->channel->item as $value) {
          if ($request->has('search') && $request->search != '') {
            if (strpos($value->title, $request->search) !== false) {
              array_push($news, [
                'sumber' => $source,
                'title' => $value->title,
                'published_date' => $value->pubDate,
                'link' => $value->link
              ]);
            }
          }else {
            array_push($news, [
              'sumber' => $source,
              'title' => $value->title,
              'published_date' => $value->pubDate,
              'link' => $value->link
            ]);
          }
        }

        return $news;
    }

    // public function parsing($source, $link, Request $request) {
    //     $news = [];
    //     $xmlString = file_get_contents($link);
    //     $xmlObject = simplexml_load_string($xmlString);
    //     $json = json_encode($xmlObject);
    //     $array = json_encode($json);

        // foreach ($array->channel->item as $value) {
        //     array_push($news, [
        //         'sumber' =>$source,
        //         'title' => $value->title,
        //         'published_date' => $value->pubDate,
        //         'link' => $value->link
        //     ]);
        // } 

    //     return $news;
    // }

    public function sindonews()
    {
        $sindonews = simplexml_load_file("https://www.sindonews.com/feed");
        return view('admin.rss.sindonews',["sindonews"=>$sindonews]);
    }

    public function index()
    {
        $channel = [
            'title' => 'title',
            'link'  => 'http://moell.cn',
            'description' => 'description',
            'category' => [
                'value' => 'html',
                'attr' => [
                    'domain' => 'http://www.moell.cn'
                ]
            ]
        ];

        $rss = Rss::channel($channel);

        $items = [];
        for($i = 0; $i < 2; $i++) {
            $item = [
                'title' => "title".$i,
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
}
