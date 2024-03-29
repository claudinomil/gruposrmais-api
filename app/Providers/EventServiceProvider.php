<?php

namespace App\Providers;

use App\Models\Banco;
use App\Models\Brigada;
use App\Models\ClienteServico;
use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Fornecedor;
use App\Models\Funcionario;
use App\Models\Cliente;
use App\Models\Genero;
use App\Models\Grupo;
use App\Models\IdentidadeOrgao;
use App\Models\EstadoCivil;
use App\Models\Nacionalidade;
use App\Models\Naturalidade;
use App\Models\Notificacao;
use App\Models\Operacao;
use App\Models\Funcao;
use App\Models\Escolaridade;
use App\Models\Proposta;
use App\Models\Servico;
use App\Models\ServicoTipo;
use App\Models\Situacao;
use App\Models\Ferramenta;
use App\Models\User;
use App\Models\VisitaTecnica;
use App\Observers\BancoObserver;
use App\Observers\BrigadaObserver;
use App\Observers\ClienteServicoObserver;
use App\Observers\DepartamentoObserver;
use App\Observers\EmpresaObserver;
use App\Observers\FornecedorObserver;
use App\Observers\FuncionarioObserver;
use App\Observers\ClienteObserver;
use App\Observers\GeneroObserver;
use App\Observers\GrupoObserver;
use App\Observers\IdentidadeOrgaoObserver;
use App\Observers\EstadoCivilObserver;
use App\Observers\NacionalidadeObserver;
use App\Observers\NaturalidadeObserver;
use App\Observers\NotificacaoObserver;
use App\Observers\OperacaoObserver;
use App\Observers\FuncaoObserver;
use App\Observers\EscolaridadeObserver;
use App\Observers\PropostaObserver;
use App\Observers\ServicoObserver;
use App\Observers\SituacaoObserver;
use App\Observers\FerramentaObserver;
use App\Observers\UserObserver;

use App\Observers\VisitaTecnicaObserver;
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
        Brigada::observe(BrigadaObserver::class);
        Cliente::observe(ClienteObserver::class);
        ClienteServico::observe(ClienteServicoObserver::class);
        Departamento::observe(DepartamentoObserver::class);
        Empresa::observe(EmpresaObserver::class);
        Escolaridade::observe(EscolaridadeObserver::class);
        EstadoCivil::observe(EstadoCivilObserver::class);
        Ferramenta::observe(FerramentaObserver::class);
        Fornecedor::observe(FornecedorObserver::class);
        Funcao::observe(FuncaoObserver::class);
        Funcionario::observe(FuncionarioObserver::class);
        Genero::observe(GeneroObserver::class);
        Grupo::observe(GrupoObserver::class);
        IdentidadeOrgao::observe(IdentidadeOrgaoObserver::class);
        Nacionalidade::observe(NacionalidadeObserver::class);
        Naturalidade::observe(NaturalidadeObserver::class);
        Notificacao::observe(NotificacaoObserver::class);
        Operacao::observe(OperacaoObserver::class);
        Proposta::observe(PropostaObserver::class);
        Servico::observe(ServicoObserver::class);
        Situacao::observe(SituacaoObserver::class);
        User::observe(UserObserver::class);
        VisitaTecnica::observe(VisitaTecnicaObserver::class);
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
