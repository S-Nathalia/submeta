<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Evento;


// Route::get('/', function () {
//     if(Auth::check()){
//       return redirect()->route('home');
//     }

//     $eventos = Evento::all();
//     return view('index',['eventos'=>$eventos]);
// });

Route::get('/', 'UserController@index')->name('home-user');
//Route::get('/visualizarEvento', 'UserController@index')->name('visualizarEvento');
// Route::get('/#', function () {
//     if(Auth::check()){
//       return redirect()->route('home');
//     }

//     $eventos = Evento::all();
//     return view('index',['eventos'=>$eventos]);
// })->name('cancelarCadastro');

Route::get('/evento/visualizar/naologado/{id}','EventoController@showNaoLogado')->name('evento.visualizarNaoLogado');

Auth::routes(['verify' => true]);

Route::get('/perfil','UserController@perfil')->name('perfil')->middleware(['auth', 'verified']);
Route::post('/perfil','UserController@editarPerfil')->name('perfil')->middleware(['auth', 'verified']);

// Rotas Administrador
Route::get('/home-admin', 'AdministradorController@index')->middleware('checkAdministrador')->name('admin.index');
Route::get('/usuarios', 'AdministradorController@usuarios')->middleware('checkAdministrador')->name('admin.usuarios');
Route::get('/perfil-usuario', 'UserController@minhaConta')->middleware('auth')->name('user.perfil');
  //Rotas da administração dos usuários
Route::get('/usuarios/novo', 'AdministradorController@create')->middleware('checkAdministrador')->name('admin.user.create');
Route::post('/usuarios/salvar-novo', 'AdministradorController@salvar')->middleware('checkAdministrador')->name('admin.user.store');
Route::get('/usuarios/editar/{id}', 'AdministradorController@edit')->middleware('checkAdministrador')->name('admin.user.edit');
Route::post('/usuarios/editar/atualizar/{id}', 'AdministradorController@update')->middleware('checkAdministrador')->name('admin.user.update');
Route::post('/usuarios/editar/deletar/{id}', 'AdministradorController@destroy')->middleware('checkAdministrador')->name('admin.user.destroy');
Route::get('admin/editais', 'AdministradorController@editais')->middleware('checkAdministrador')->name('admin.editais');

// Rotas de administrador responsavel (Reitor ou pro-reitor)
Route::get('adminResp/index', 'AdministradorResponsavelController@index')->name('adminResp.index');
Route::get('adminResp/editais', 'AdministradorResponsavelController@editais')->name('adminResp.editais');
Route::get('adminResp/usuarios', 'AdministradorResponsavelController@usuarios')->name('adminResp.usuarios');
Route::get('adminResp/atribuir', 'AdministradorResponsavelController@atribuirPermissao')->name('adminResp.atribuir');
Route::post('adminResp/atribuir', 'AdministradorResponsavelController@atribuirPermissao')->name('adminResp.atribuir');
Route::post('adminResp/verPermissao', 'AdministradorResponsavelController@verPermissao')->name('adminResp.verPermissao');

  //Rotas das naturezas
    //Rotas das grandes areas
Route::get('/naturezas', 'AdministradorController@naturezas')->middleware('checkAdministrador')->name('admin.naturezas');
Route::get('/naturezas/grande-area', 'GrandeAreaController@index')->middleware('checkAdministrador')->name('grandearea.index');
Route::get('/naturezas/grande-area/nova', 'GrandeAreaController@create')->middleware('checkAdministrador')->name('grandearea.criar');
Route::post('/naturezas/grande-area/salvar', 'GrandeAreaController@store')->middleware('checkAdministrador')->name('grandearea.salvar');
Route::get('/naturezas/grande-area/detalhes/{id}', 'GrandeAreaController@show')->middleware('checkAdministrador')->name('grandearea.show');
Route::get('/naturezas/grande-area/editar/{id}', 'GrandeAreaController@edit')->middleware('checkAdministrador')->name('grandearea.editar');
Route::post('/naturezas/grande-area/atualizar/{id}', 'GrandeAreaController@update')->middleware('checkAdministrador')->name('grandearea.atualizar');
Route::post('/naturezas/grande-area/excluir/{id}', 'GrandeAreaController@destroy')->middleware('checkAdministrador')->name('grandearea.deletar');
    //Rotas das areas, id's de nova e salvar são os ids da grande área a qual a nova área pertence
Route::get('/naturezas/areas', 'AreaController@index')->middleware('checkAdministrador')->name('area.index');
Route::get('/naturezas/{id}/area/nova', 'AreaController@create')->middleware('checkAdministrador')->name('area.criar');
Route::post('/naturezas/{id}/area/salvar', 'AreaController@store')->middleware('checkAdministrador')->name('area.salvar');
Route::get('/naturezas/area/detalhes/{id}', 'AreaController@show')->middleware('checkAdministrador')->name('area.show');
Route::get('/naturezas/area/editar/{id}', 'AreaController@edit')->middleware('checkAdministrador')->name('area.editar');
Route::post('/naturezas/area/atualizar/{id}', 'AreaController@update')->middleware('checkAdministrador')->name('area.atualizar');
Route::post('/naturezas/area/excluir/{id}', 'AreaController@destroy')->middleware('checkAdministrador')->name('area.deletar');
    //Rotas das subareas, id's de nova e salvar são os ids da área a qual a nova subárea pertence
Route::get('/naturezas/subareas', 'SubAreaController@index')->middleware('checkAdministrador')->name('subarea.index');
Route::get('/naturezas/{id}/subarea/nova', 'SubAreaController@create')->middleware('checkAdministrador')->name('subarea.criar');
Route::post('/naturezas/{id}/subarea/salvar', 'SubAreaController@store')->middleware('checkAdministrador')->name('subarea.salvar');
Route::get('/naturezas/subarea/detalhes/{id}', 'SubAreaController@show')->middleware('checkAdministrador')->name('subarea.show');
Route::get('/naturezas/subarea/editar/{id}', 'SubAreaController@edit')->middleware('checkAdministrador')->name('subarea.editar');
Route::post('/naturezas/subarea/atualizar/{id}', 'SubAreaController@update')->middleware('checkAdministrador')->name('subarea.atualizar');
Route::post('/naturezas/subarea/excluir/{id}', 'SubAreaController@destroy')->middleware('checkAdministrador')->name('subarea.deletar');

// Rotas Coordenador

Route::get('/coordenador/index', 'CoordenadorComissaoController@index')->name('coordenador.index');
Route::get('/coordenador/editais', 'CoordenadorComissaoController@editais')->name('coordenador.editais');
Route::get('/coordenador/usuarios', 'CoordenadorComissaoController@usuarios')->name('coordenador.usuarios');
Route::get('/coordenador/listarCoord', 'CoordenadorComissaoController@coordenadorComite')->name('coordenador.coord');
Route::get('/coordenador/listarAvaliador', 'CoordenadorComissaoController@avaliador')->name('coordenador.avaliador');
Route::get('/coordenador/listarProponente', 'CoordenadorComissaoController@proponente')->name('coordenador.proponente');
Route::get('/coordenador/listarParticipante', 'CoordenadorComissaoController@participante')->name('coordenador.participante');
Route::get('/coordenador/listarTrabalhos', 'CoordenadorComissaoController@listarTrabalhos')->name('coordenador.listarTrabalhos');
Route::get('/coordenador/detalhesEdital', 'CoordenadorComissaoController@detalhesEdital')->name('coordenador.detalhesEdital');
Route::post('/coordenador/retornoDetalhes', 'CoordenadorComissaoController@retornoDetalhes')->name('coordenador.retornoDetalhes');
Route::post('/coordenador/atribuirAvaliadorTrabalho', 'TrabalhoController@atribuirAvaliadorTrabalho')->name('coordenador.atribuirAvaliadorTrabalho');
Route::post('/coordenador/atribuir', 'TrabalhoController@atribuir')->name('coordenador.atribuir');

// Rotas Avaliador
Route::get('/avaliador/index', 'AvaliadorController@index')->name('avaliador.index');
Route::get('/avaliador/trabalhos', 'AvaliadorController@visualizarTrabalhos')->name('visualizarTrabalho');

//Proponente
Route::get('/proponente/index', 'ProponenteController@index')->name('proponente.index');

//Participante
Route::get('/participante/index', 'ParticipanteController@index')->name('participante.index');


Route::group(['middleware' => ['isTemp', 'auth', 'verified']], function(){

  Route::get('/home/evento', 'EventoController@index')->name('visualizarEvento');

  // rotas de teste
  Route::get('/coordenador/home','EventoController@index')->name('coord.home');

  Route::get('/coordenador/evento/detalhes', 'EventoController@detalhes')->name('coord.detalhesEvento');

  // Visualizar trabalhos do usuário
  Route::get('/user/trabalhos', 'UserController@meusTrabalhos')->name('user.meusTrabalhos');

  // Cadastrar Comissão
  Route::post('/evento/cadastrarComissao','ComissaoController@store'                   )->name('cadastrar.comissao');
  Route::post('/evento/cadastrarCoordComissao','ComissaoController@coordenadorComissao')->name('cadastrar.coordComissao');
  // Deletar Comissão
  Route::delete('/evento/apagar-comissao/','ComissaoController@destroy')->name('delete.comissao');
  //Evento
  Route::get(   '/evento/criar',          'EventoController@create'                    )->name('evento.criar');
  Route::post(  '/evento/criar',          'EventoController@store'                     )->name('evento.criar');
  Route::get(   '/evento/visualizar/{id}','EventoController@show'                      )->name('evento.visualizar');
  Route::get(   '/evento/listar',          'EventoController@listar'                      )->name('evento.listar');
  Route::delete('/evento/excluir/{id}',   'EventoController@destroy'                   )->name('evento.deletar');
  Route::get(   '/evento/editar/{id}',    'EventoController@edit'                      )->name('evento.editar');
  Route::post(   '/evento/editar/{id}',    'EventoController@update'                      )->name('evento.update');
  Route::post(  '/evento/setResumo',      'EventoController@setResumo'                 )->name('evento.setResumo');
  Route::post(  '/evento/setFoto',        'EventoController@setFotoEvento'             )->name('evento.setFotoEvento');
  Route::post(  '/evento/numTrabalhos',    'EventoController@numTrabalhos'             )->name('trabalho.numTrabalhos');
  //Modalidade
  Route::post(  '/modalidade/criar',      'ModalidadeController@store'                 )->name('modalidade.store');
  //Area
  Route::post(  '/area/criar',            'AreaController@store'                       )->name('area.store');
  //Deletar Area
  Route::delete('/area/deletar/{id}',          'AreaController@destroy'                     )->name('area.delete');
  //Revisores
  Route::post(  '/revisor/criar',         'RevisorController@store'                    )->name('revisor.store');
  Route::get(   '/revisor/listarTrabalhos','RevisorController@indexListarTrabalhos'    )->name('revisor.listarTrabalhos');
  Route::post(  '/revisor/email',         'RevisorController@enviarEmailRevisor'       )->name('revisor.email');
  Route::post(  '/revisor/emailTodos',    'RevisorController@enviarEmailTodosRevisores')->name('revisor.emailTodos');
  //Deletar Revisores
  Route::delete(  '/revisor/apagar',      'RevisorController@destroy'                  )->name('revisor.delete');
  //AreaModalidade
  Route::post(  '/areaModalidade/criar',  'AreaModalidadeController@store'             )->name('areaModalidade.store');
  //Trabalho
  Route::get(   '/trabalho/submeter/{id}','TrabalhoController@index'                   )->name('trabalho.index');
  Route::post(  '/trabalho/novaVersao',   'TrabalhoController@novaVersao'              )->name('trabalho.novaVersao');
  Route::post(  '/trabalho/criar',        'TrabalhoController@store'                   )->name('trabalho.store');
  //Atribuição
  Route::get(   '/atribuir',              'AtribuicaoController@distribuicaoAutomatica')->name('distribuicao');
  Route::get(   '/atribuirPorArea',       'AtribuicaoController@distribuicaoPorArea'   )->name('distribuicaoAutomaticaPorArea');
  Route::post(  '/distribuicaoManual',    'AtribuicaoController@distribuicaoManual'    )->name('distribuicaoManual');
  Route::post(  '/removerAtribuicao',     'AtribuicaoController@deletePorRevisores'    )->name('atribuicao.delete');
  // rota downloadArquivo
  Route::get(   '/downloadArquivo',       'HomeController@downloadArquivo'             )->name('download');
  // Area do participante
  Route::get(   '/participante',          'EventoController@areaParticipante'          )->name('area.participante');
  // Area da comissao
  Route::get(   '/comissoes',             'EventoController@listComissao'              )->name('comissoes');
  Route::get(   '/area/comissao',         'EventoController@listComissaoTrabalhos'     )->name('area.comissao');

});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
