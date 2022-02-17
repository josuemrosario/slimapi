<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes

$app->group('/api/v1',function(){


	//Lista todos os produtos
	$this->get('/produtos/lista',function($request,$response){
		$produtos = Produto::get();
		return $response->withJson($produtos);

	});

	//Insere produto
	$this->post('/produtos/adiciona',function($request,$response){
		$dados = $request->getParsedBody();
		$produto = Produto::create($dados);
		return $response->withJson($produto);

	});


	//Retorna produto por id
	$this->get('/produtos/lista/{id}',function($request,$response, $args){
		
		$produto = Produto::findOrFail($args['id']);
		return $response->withJson($produto);

	});


	//Atualiza produto por id
	$this->put('/produtos/atualiza/{id}',function($request,$response, $args){
		
		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);
		return $response->withJson($produto);

	});


	//remove produto
	$this->get('/produtos/remove/{id}',function($request,$response, $args){
		
		$produto = Produto::findOrFail($args['id']);
		$produto->delete();
		return $response->withJson($produto);

	});

});