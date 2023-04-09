<?php

namespace App\Providers;

use App\Models\Banco;
use App\Models\Departamento;
use App\Models\Fornecedor;
use App\Models\Funcionario;
use App\Models\Cliente;
use App\Models\Genero;
use App\Models\Grupo;
use App\Models\IdentidadeOrgao;
use App\Models\EstadoCivil;
use App\Models\Modulo;
use App\Models\Nacionalidade;
use App\Models\Naturalidade;
use App\Models\Notificacao;
use App\Models\Operacao;
use App\Models\Funcao;
use App\Models\Escolaridade;
use App\Models\Situacao;
use App\Models\Submodulo;
use App\Models\Ferramenta;
use App\Models\User;
use App\Observers\BancoObserver;
use App\Observers\DepartamentoObserver;
use App\Observers\FornecedorObserver;
use App\Observers\FuncionarioObserver;
use App\Observers\ClienteObserver;
use App\Observers\GeneroObserver;
use App\Observers\GrupoObserver;
use App\Observers\IdentidadeOrgaoObserver;
use App\Observers\EstadoCivilObserver;
use App\Observers\ModuloObserver;
use App\Observers\NacionalidadeObserver;
use App\Observers\NaturalidadeObserver;
use App\Observers\NotificacaoObserver;
use App\Observers\OperacaoObserver;
use App\Observers\FuncaoObserver;
use App\Observers\EscolaridadeObserver;
use App\Observers\SituacaoObserver;
use App\Observers\SubmoduloObserver;
use App\Observers\FerramentaObserver;
use App\Observers\UserObserver;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        Banco::observe(BancoObserver::class);
        Departamento::observe(DepartamentoObserver::class);
        Funcionario::observe(FuncionarioObserver::class);
        Cliente::observe(ClienteObserver::class);
        Fornecedor::observe(FornecedorObserver::class);
        Genero::observe(GeneroObserver::class);
        Grupo::observe(GrupoObserver::class);
        IdentidadeOrgao::observe(IdentidadeOrgaoObserver::class);
        EstadoCivil::observe(EstadoCivilObserver::class);
        Modulo::observe(ModuloObserver::class);
        Nacionalidade::observe(NacionalidadeObserver::class);
        Naturalidade::observe(NaturalidadeObserver::class);
        Notificacao::observe(NotificacaoObserver::class);
        Operacao::observe(OperacaoObserver::class);
        Funcao::observe(FuncaoObserver::class);
        Escolaridade::observe(EscolaridadeObserver::class);
        Situacao::observe(SituacaoObserver::class);
        Submodulo::observe(SubmoduloObserver::class);
        Ferramenta::observe(FerramentaObserver::class);
        User::observe(UserObserver::class);
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
