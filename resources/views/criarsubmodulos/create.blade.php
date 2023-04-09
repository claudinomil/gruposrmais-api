<html>
    <head>
        <meta charset="utf-8" />
        <title>Criar Submodulos Desenvolvedor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container py-5 px-5">

            <!-- Mensagem -->
            @if (isset($success))
                @if ($success != '')
                    <div class="alert alert-success mt-1">{{ $success }}</div>
                @endif
            @endif

            <!-- Erros -->
            @if (isset($errors))
                @if ($errors != '')
                    <div class="alert alert-danger mt-1">{{ $errors }}</div>
                @endif
            @endif


            <form id="frm-claudino-desenvolvedor" method="post" action="{{ route('criarsubmodulos.store') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <button type="submit">Confirmar</button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-12 col-md-4 pb-3">
                        <label class="form-label">Nome Referência - Plural</label>
                        <select class="form-control select2" name="referencia_name_plural" id="referencia_name_plural" required="required">
                            <option value="">Selecione...</option>
                            <option value="Departamentos">Departamentos</option>
                            <option value="Funcionarios">Funcionarios</option>
                            <option value="Clientes">Clientes</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-4 pb-3">
                        <label class="form-label">Nome Referência - Singular</label>
                        <select class="form-control select2" name="referencia_name_singular" id="referencia_name_singular" required="required">
                            <option value="">Selecione...</option>
                            <option value="Departamento">Departamento</option>
                            <option value="Funcionario">Funcionario</option>
                            <option value="Cliente">Cliente</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-12 col-md-4 pb-3">
                        <label class="form-label">Nome Submódulo - Plural</label>
                        <input type="text" class="form-control" id="submodulo_name_plural" name="submodulo_name_plural" required="required">
                    </div>
                    <div class="form-group col-12 col-md-4 pb-3">
                        <label class="form-label">Nome Submódulo - Singular</label>
                        <input type="text" class="form-control" id="submodulo_name_singular" name="submodulo_name_singular" required="required">
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="text-success">
                    <p><b>1. Será criado: Model/Controller/Request/Migrate/Observer/Routes.</b></p>
                    <p><b>2. É preciso alterar o Código nos arquivos:</b></p>
                    <p>&nbsp;&nbsp;&nbsp;a. Model - Campos no " protected $fillable = [] ";</p>
                    <p>&nbsp;&nbsp;&nbsp;b. Controller - Campos no " $validator = Validator ";</p>
                    <p>&nbsp;&nbsp;&nbsp;c. Migration - Campos da Tabela;</p>
                    <p>&nbsp;&nbsp;&nbsp;d. Providers/EventServiceProvider.php - Colocar Observer;</p>
                    <p><b>3. É preciso criar Código para os arquivos:</b></p>
                    <p>&nbsp;&nbsp;&nbsp;a. Transacoes.php Service - Campos que vão se gravados nas transações;</p>
                    <p>&nbsp;&nbsp;&nbsp;b. Api.php Route - Require para as rotas;</p>
                    <p>&nbsp;&nbsp;&nbsp;c. GrupoPermissoesSeeder.php Seeder - Inserir na tabela grupos_permissoes;</p>
                    <p>&nbsp;&nbsp;&nbsp;c. PermissoesSeeder.php Seeder - Inserir na tabela permissoes;</p>
                    <p>&nbsp;&nbsp;&nbsp;c. SubmodulosSeeder.php Seeder - Inserir na tabela submodulos;</p>
                </div>
            </div>

        </div>
    </body>
</html>
