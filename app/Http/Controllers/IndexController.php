<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Elasticsearch\ClientBuilder;

class IndexController extends Controller
{
    public function index() {
    	$posts = Post::orderBy('id', 'desc')->simplePaginate(10);
    	return view('welcome', compact('posts'));
    }

    public function create(Request $request) {
    	
    	$post = new Post;
    	$post->title = $request->title;
    	$post->description = $request->description;
    	$post->save();

    	$client = ClientBuilder::create()->setHosts(['elasticsearch'])->build();

    	$params = [
		    'index' => 'test1',
		    'body' => [
		        'title' => $request->title,
		        'description' => $request->description
		    ]
		];

		$response = $client->index($params);

    	return redirect()->back();

    }

    public function search(Request $request) {

    	$client = ClientBuilder::create()->setHosts(['elasticsearch'])->build();

    	$params = [
		    'index' => 'test1',
		    'body'  => [
		        'query' => [
		            'match' => [
		                'title' => $request->search
		            ]
		        ]
		    ]
		];

		$results = $client->search($params);
		dd($results);

    }

    public function createIndex() {

    	$client = ClientBuilder::create()->setHosts(['elasticsearch'])->build();

    	$params = [
		    'index' => 'test1', //Создание индекса, набор документов, по которому вы хотите искать, в индексе может быть несколько типов документов
		    'body' => [ 
		        'settings' => [ 
		            'number_of_shards' => 1, //чаcть индекса. Индексы делятся на части, чтобы распределить индекс и запросы к нему между серверами
		            'number_of_replicas' => 0, //копия шарда. Каждый кусок индекса хранится в нескольких копиях на разных серверах для отказоусточивости.
		            'analysis' => [ 
		                'filter' => [
		                    'ru_stop' => [
		                    	'type' => 'stop',
		                    	'stopwords' => '_russian_'
		                    ],
		                    'ru_stemmer' => [
		                    	'type' => 'stemmer',
		                    	'language' => 'russian'
		                    ]
		                ],
		                'analyzer' => [
		                    'default' => [
		                        'char_filter' => ['html_strip'],
		                        'tokenizer' => 'standard',
		                        'filter' => ['lowercase', 'ru_stop', 'ru_stemmer']
		                    ]
		                ]
		            ]
		        ],
		        'mappings' => [ 
		            'properties' => [
		                'title' => [
		                    'type' => 'text',
		                    'analyzer' => 'default', //Можно не использовать
		                ],
		                'description' => [
		                    'type' => 'text',
		                    'analyzer' => 'default', //Можно не использовать
		                ]
		            ]
		        ]
		    ]
		];

		$results = $client->indices()->create($params);
		dd($results);

    }
}


