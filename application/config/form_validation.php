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
                        'rules' => 'required|valid_email|is_unique[usuarios.email]'
                ),
                array(
                        'field' => 'login',
                        'label' => 'Login',
                        'rules' => 'required|is_unique[usuarios.login]'
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
        ),
        'cadastro_professores' => array(
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
                        'field' => 'atividade',
                        'label' => 'Atividade',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email|is_unique[professores.email]'
                )
        ),
        'atualizacao_professores' => array(
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
                        'field' => 'atividade',
                        'label' => 'Atividade',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email'
                )
        ),
        'cadastro_cursos' => array(
                array(
                        'field' => 'nome',
                        'label' => 'Nome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required'
                )
        ),
        'cadastro_turmas' => array(
                array(
                        'field' => 'identificacao',
                        'label' => 'Turma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'idcurso',
                        'label' => 'Curso',
                        'rules' => 'required'
                )
        )
);