<?php
/*
 * Copyright (c) 2011-2012, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


/**
 * Arquivo de configuração
 * 
 */

/**
 * Define o tipo do debug
 */
Config::set('debug', array(
	'type'	=> 'off', //pode assumir os seguintes valores: off, local, network e all
	'query'	=> false //pode assumir false, para desativar, ou um valor para a query ?debug=seu-valor-seguro
));

/**
 * Tipo do drive do banco de dados, pode assumir os seguintes valores: mysql
 */
Config::set('database', array(
	'default' => array(
		'type' => 'mysql',
		'host' => 'localhost',
		'name' => 'ci',
		'user' => 'root',
		'pass' => '',
		'validate' => true
	)
));

/**
 * Master Page padrão
 */
Config::set('default_master', 'template');

/**
 * Controller padrão
 */
Config::set('default_controller', 'Inicio');

/**
 * Action padrão
 */
Config::set('default_action', 'index');

/**
 * Página de login
 */
Config::set('default_login', '~/admin/login');

/**
 * Charset padrão
 */
Config::set('charset', 'UTF-8');

/**
 * Linguagem padrão
 */
Config::set('default_lang', 'pt-br');

/**
 * Chave de segurança (deve ser alterada)
 */
Config::set('salt', 'ad$sfGFH33F132sAasds!@xcz!z\x*(f^`{`lda\\A|zahkl.m,kH2?Ed');

/**
 * Define se as requisições via dispositivo móvel irão carregar os templates específicos, se existirem, para versão móvel
 */
Config::set('auto_mobile', true);

/**
 * Define se as requisições via tablet irão carregar os templates  específicos, se existirem, para versão tablet
 */
Config::set('auto_tablet', false);

/**
 * Define se as requisições AJAX devem retornar automaticamente conteúdo em JSON
 */
Config::set('auto_ajax', true);

/**
 * Define se actions acessadas com .xml devem retorna automaticamente conteúdo em XML
 */
Config::set('auto_dotxml', true);

/**
 * Define se actions acessadas com .json devem retorna automaticamente conteúdo em JSON
 */
Config::set('auto_dotjson', true);

/**
 * Define as configurações de cache
 */
Config::set('cache', array(
	'type'		=> 'file',
	'host'		=> 'localhost',
	'port'		=> '',
	'page'		=> false,
	'time'		=> -1
));

//Import::register($dir); //Registrar diretórios de arquivos de código fonte, para autoload.