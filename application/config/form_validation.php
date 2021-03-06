<?php

$config = array(
	'cadastro_usuarios' => array(
		array(
                        'field' => 'nome',
                        'label' => 'Nome',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email|is_unique[usuarios.email]'
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
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'required|valid_email|is_unique[professores.email]'
                ),
                array(
                        'field' => 'fone_1',
                        'label' => 'Telefone 1',
                        'rules' => 'required'
                )
        ),
        'atualizacao_professores' => array(
                array(
                        'field' => 'nome',
                        'label' => 'Nome',
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
                ),
                array(
                        'field' => 'vagas',
                        'label' => 'Vagas',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'data_limite_inscricao',
                        'label' => 'Inscrições até',
                        'rules' => 'required'
                )
        ),
        'investimento_1' => array(
                array(
                        'field' => 'forma',
                        'label' => 'Forma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'total',
                        'label' => 'Total',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'data_vencimento',
                        'label' => 'Vencimento',
                        'rules' => 'required'
                )
        ),
        'investimento_2' => array(
                array(
                        'field' => 'forma',
                        'label' => 'Forma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'total',
                        'label' => 'Total',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'parcelas',
                        'label' => 'Parcelas',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'valor_parcela',
                        'label' => 'Valor das Parcelas',
                        'rules' => 'required'
                )
        ),
        'investimento_3' => array(
                array(
                        'field' => 'forma',
                        'label' => 'Forma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'total',
                        'label' => 'Total',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'parcelas',
                        'label' => 'Parcelas',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'valor_parcela',
                        'label' => 'Valor das Parcelas',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'dia_vencimento',
                        'label' => 'Dia de Vencimento',
                        'rules' => 'required'
                )
        ),
        'investimento_4' => array(
                array(
                        'field' => 'forma',
                        'label' => 'Forma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'total',
                        'label' => 'Total',
                        'rules' => 'required'
                )
        ),
        'cadastro_aulas' => array(
                array(
                        'field' => 'idturma',
                        'label' => 'Turma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'idprofessor',
                        'label' => 'Professor',
                        'rules' => 'required'
                )
        ),
        'dias_aulas' => array(
                array(
                        'field' => 'inicio',
                        'label' => 'Data/Hora do início',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'fim',
                        'label' => 'Hora do fim',
                        'rules' => 'required'
                ),
        ),
        'cadastro_inscricoes' => array(
                array(
                        'field' => 'idturma',
                        'label' => 'Turma',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'idusuario',
                        'label' => 'Aluno',
                        'rules' => 'required'
                )
        ),
        'upload_material' => array(
                array(
                        'field' => 'titulo',
                        'label' => 'Título',
                        'rules' => 'required'
                )
        ),
        'atualizacao_material' => array(
                array(
                        'field' => 'titulo',
                        'label' => 'Título',
                        'rules' => 'required'
                )
        ),
        'inscricoes_site' => array(
                array(
                        'field' => 'idturma',
                        'label' => 'Turma',
                        'rules' => 'required'
                )
        )
);