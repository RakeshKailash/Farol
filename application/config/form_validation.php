<?php

$config = array(
	'cadastro_usuarios' => array(
		array(
                        'field' => 'nome',
                        'label' => 'Nome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'sobrenome',
                        'label' => 'Sobrenome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email|is_unique[usuarios_farol.email]'
                ),
                array(
                        'field' => 'senha',
                        'label' => 'Senha',
                        'rules' => 'required|matches[confirma_senha]'
                ),
                array(
                        'field' => 'confirma_senha',
                        'label' => 'Repita a senha',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'fone_1',
                        'label' => 'Telefone 1',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'acesso',
                        'label' => 'Função',
                        'rules' => 'required'
                )
        ),
        'atualizacao_usuarios' => array(
                array(
                        'field' => 'nome',
                        'label' => 'Nome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'sobrenome',
                        'label' => 'Sobrenome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'fone_1',
                        'label' => 'Telefone 1',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'acesso',
                        'label' => 'Função',
                        'rules' => 'required'
                )
        ),
        'senha_edicao' => array(
                array(
                        'field' => 'senha',
                        'label' => 'Senha',
                        'rules' => 'matches[confirma_senha]'
                ),
                array(
                        'field' => 'confirma_senha',
                        'label' => 'Repita a senha',
                        'rules' => 'required'
                ),
        )
);