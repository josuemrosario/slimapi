<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Usuario;

// Rotas Geracao de token
$app->post('/api/token',function($request,$response){

	$dados = $request->getParsedBody();
	
	$email = $dados['email'] ?? null;
	$senha = $dados['senha'] ?? null;

	$usuario = Usuario::where('email',$email)->first();

	if( (!is_null($usuario)) && (md5($senha) === $usuario->senha)){

		$secret_key = $this->get('settings')['secretkey'];
		$chaveacesso = JWT::encode($usuario, $secret_key, 'HS256');

		return $response->withJson(['chave' => $chaveacesso]);

	}

	return $response->withJson(['status' => 'erro']);

});