<?php

namespace Database\Seeders;

use App\Models\EdificacaoClassificacao;
use Illuminate\Database\Seeder;

class EdificacaoClassificacoesSeeder extends Seeder
{
    public function run()
    {
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-1', 'descricao' => 'Residencial privativa unifamiliar', 'definicao' => 'Casas térreas ou assobradadas (isoladas e não isoladas)']);
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-2', 'descricao' => 'Residencial privativa multifamiliar', 'definicao' => 'Edifícios de apartamento em geral']);
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-3', 'descricao' => 'Residencial coletiva', 'definicao' => 'Pensionatos, internatos, orfanatos, alojamentos, mosteiros, conventos.']);
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-4', 'descricao' => 'Agrupamento residencial privativo unifamilia', 'definicao' => 'Conjunto de duas ou mais edificações residenciais privativas unifamiliares dentro de um lote.']);
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-5', 'descricao' => 'Agrupamento residencial privativo multifamiliar', 'definicao' => 'Conjunto de duas ou mais edificações residenciais privativas multifamiliares dentro de um lote.']);
        EdificacaoClassificacao::create(['grupo' => 'A', 'ocupacao_uso' => 'Residencial', 'divisao' => 'A-6', 'descricao' => 'Mista', 'definicao' => 'Edificação composta de unidades residenciais privativas (apartamentos) e unidades autônomas destinadas a espaços comerciais (lojas ou salas).']);


        EdificacaoClassificacao::create(['grupo' => 'B', 'ocupacao_uso' => 'Serviço de hospedagem', 'divisao' => 'B-1', 'descricao' => 'Hotel e assemelhados', 'definicao' => 'Hotéis, motéis, pensões, hospedarias, pousadas, albergues, casas de cômodos, camping.']);
        EdificacaoClassificacao::create(['grupo' => 'B', 'ocupacao_uso' => 'Serviço de hospedagem', 'divisao' => 'B-2', 'descricao' => 'Hotel residencial', 'definicao' => 'Hotéis e assemelhados com cozinha própria nos apartamentos (incluem-se, flats, apart-hotel, hotel residência, e similares destinados a ocupação transitória)']);

        EdificacaoClassificacao::create(['grupo' => 'C', 'ocupacao_uso' => 'Comercial', 'divisao' => 'C-1', 'descricao' => 'Comercial 1', 'definicao' => 'Edificações comerciais, que em função da atividade desenvolvida, ficam enquadradas no Risco Médio 1 conforme Nota Técnica específica, tais como: artigos de metal, louças, artigos hospitalares, edifícios de lojas de departamentos, magazines, armarinhos, galerias comerciais, supermercados em geral, mercados e outros.']);
        EdificacaoClassificacao::create(['grupo' => 'C', 'ocupacao_uso' => 'Comercial', 'divisao' => 'C-2', 'descricao' => 'Comercial 2', 'definicao' => 'Edificações comerciais, que em função da atividade desenvolvida, ficam enquadradas no Risco Médio 2 conforme Nota Técnica específica, tais como: comércio atacadista de produtos químicos e petroquímicos, de resíduos de papel e papelão, espuma e iso-por, etc.']);
        EdificacaoClassificacao::create(['grupo' => 'C', 'ocupacao_uso' => 'Comercial', 'divisao' => 'C-3', 'descricao' => 'Shopping centers', 'definicao' => 'Centro de compras em geral (shopping centers)']);
        EdificacaoClassificacao::create(['grupo' => 'C', 'ocupacao_uso' => 'Comercial', 'divisao' => 'C-4', 'descricao' => 'Quiosque', 'definicao' => 'Ponto de venda localizado no mall de centro comercial e de centro de compras em geral (shopping centers)']);

        EdificacaoClassificacao::create(['grupo' => 'D', 'ocupacao_uso' => 'Serviço profissional e institucional', 'divisao' => 'D-1', 'descricao' => 'Local para prestação de serviço profissional ou condução de negócios', 'definicao' => 'Escritórios administrativos ou técnicos, instituições financeiras (exceto as classificadas em D-2), cabeleireiros, centros profissionais e assemelhados, repartições públicas (exceto as classificadas em D-5).']);
        EdificacaoClassificacao::create(['grupo' => 'D', 'ocupacao_uso' => 'Serviço profissional e institucional', 'divisao' => 'D-2', 'descricao' => 'Agências bancárias', 'definicao' => 'Agências bancárias e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'D', 'ocupacao_uso' => 'Serviço profissional e institucional', 'divisao' => 'D-3', 'descricao' => 'Serviços de manutenção e reparação (exceto os classificados em G-4)', 'definicao' => 'Lavanderias, assistência técnica, reparação e manutenção de aparelhos eletrodomésticos, chaveiros, serviços de pintura, pintura de letreiros, serviços de limpeza e outros.']);
        EdificacaoClassificacao::create(['grupo' => 'D', 'ocupacao_uso' => 'Serviço profissional e institucional', 'divisao' => 'D-4', 'descricao' => 'Laboratórios de análises clínicas e assemelhados', 'definicao' => 'Laboratórios de análises clínicas sem internação e assemelhados. Laboratórios ambientais, fotográficos e assemelhados.']);
        EdificacaoClassificacao::create(['grupo' => 'D', 'ocupacao_uso' => 'Serviço profissional e institucional', 'divisao' => 'D-5', 'descricao' => 'Edificação pública das forças armadas, policiais e militares estaduais', 'definicao' => 'Quartéis, delegacias, postos policiais, grupamentos e assemelhados']);

        EdificacaoClassificacao::create(['grupo' => 'E', 'ocupacao_uso' => 'Escolar e cultura física', 'divisao' => 'E-1', 'descricao' => 'Escolar em geral', 'definicao' => 'Pré-escola (creches, escolas maternais, jardins de infância). Escolas de educação básica, ensino fundamental e médio, educação de jovens e adultos, ensino superior, ensino técnico e assemelhados. Escolas profissionais em geral.']);
        EdificacaoClassificacao::create(['grupo' => 'E', 'ocupacao_uso' => 'Escolar e cultura física', 'divisao' => 'E-2', 'descricao' => 'Escolar especial', 'definicao' => 'Escolas de artes e artesanato, de línguas, de cultura geral, de cultura estrangeira, escolas religiosas e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'E', 'ocupacao_uso' => 'Escolar e cultura física', 'divisao' => 'E-3', 'descricao' => 'Espaço para cultura física', 'definicao' => 'Locais de ensino e/ou práticas de artes marciais, natação, ginástica (artística, dança, musculação e outros) esportes coletivos (tênis, futebol e outros que não estejam incluídos em F-3), sauna, casas de fisioterapia e assemelhados. Sem arquibancadas.']);

        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-1', 'descricao' => 'Local onde há objeto de valor inestimável', 'definicao' => 'Museus, centro de documentos históricos, galerias de arte, arquivos, bibliotecas e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-2', 'descricao' => 'Local religioso e velório', 'definicao' => 'Igrejas, capelas, sinagogas, mesquitas, templos, cemitérios, crematórios, necrotérios, salas de funerais e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-3', 'descricao' => 'Centro esportivo e de exibições', 'definicao' => 'Arenas em geral, estádios, ginásios, piscinas, rodeios, autódromos, sambódromo, jóquei clube, pista de patinação e assemelhados. Todos com arquibancadas.']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-4', 'descricao' => 'Estação e terminal de passageiro', 'definicao' => 'Estações rodoferroviárias e marítimas, portos, marina, metrô, aeroportos, helipontos, teleféricos, estações de transbordo em geral e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-5', 'descricao' => 'Arte cênica e auditório', 'definicao' => 'Teatros em geral, cinemas, óperas, auditórios de estúdios de rádio e televisão, auditórios em geral e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-6', 'descricao' => 'Boates e casas de show', 'definicao' => 'Boates, danceterias, discotecas, centro de convenções, e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-7', 'descricao' => 'Instalações temporárias', 'definicao' => 'Circos, parques temático, parque de diversões, feiras, eventos de foodtruck e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-8', 'descricao' => 'Local para refeição', 'definicao' => 'Restaurantes, lanchonetes, bares, cafés, refeitórios, cantinas e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-9', 'descricao' => 'Recreação pública', 'definicao' => 'Parques recreativos (sem atividade de diversões públicas) e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-10', 'descricao' => 'Exposição de animais', 'definicao' => 'Locais para exposição agropecuária e assemelhados. Edificações permanentes']);
        EdificacaoClassificacao::create(['grupo' => 'F', 'ocupacao_uso' => 'Local de Reunião de Público', 'divisao' => 'F-11', 'descricao' => 'Clubes sociais e diversão', 'definicao' => 'Clubes sociais, bilhares, boliche, salões de baile, restaurantes com atividades de diversões públicas, zoológicos, aquários, parque de diversões (edificação permanente), e assemelhados.']);

        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-1', 'descricao' => 'Garagem sem acesso de público e sem abastecimento', 'definicao' => 'Garagens automáticas e garagens com manobristas.']);
        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-2', 'descricao' => 'Garagem com acesso de público e sem abastecimento', 'definicao' => 'Garagens coletivas sem automação, em geral e sem abastecimento (exceto veículos de carga e coletivos)']);
        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-3', 'descricao' => 'Local dotado de abastecimento de combustível', 'definicao' => 'Postos de abastecimento de combustíveis e serviço, garagens com abastecimento de combustível (exceto veículos de carga e coletivos)']);
        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-4', 'descricao' => 'Serviço de conservação, manutenção e reparos', 'definicao' => 'Oficinas de conserto de veículos. Borracharia (sem recauchutagem). Oficinas e garagens de veículos de carga e coletivos (tais como: empresas de ônibus, transportadoras, etc). Garagens de máquinas agrícolas e rodoviárias. Retificadoras de motores.']);
        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-5', 'descricao' => 'Hangar', 'definicao' => 'Abrigos para aeronaves com ou sem abastecimento']);
        EdificacaoClassificacao::create(['grupo' => 'G', 'ocupacao_uso' => 'Serviço automotivo e assemelhado', 'divisao' => 'G-6', 'descricao' => 'Galpão ou garagem náutica', 'definicao' => 'Abrigos para embarcações com ou sem abastecimento. Estrutura náutica que combina áreas para guarda de embarcações em terra ou sobre a água, cobertas ou não, e acessórios de acesso à água, podendo incluir oficina para manutenção e reparo de embarcações e seus equipamentos.']);

        EdificacaoClassificacao::create(['grupo' => 'H', 'ocupacao_uso' => 'Serviço de saúde', 'divisao' => 'H-1', 'descricao' => 'Hospital veterinário e assemelhados', 'definicao' => 'Hospitais, clínicas e consultórios veterinários e assemelhados (inclui-se alojamento com ou sem adestramento)']);
        EdificacaoClassificacao::create(['grupo' => 'H', 'ocupacao_uso' => 'Serviço de saúde', 'divisao' => 'H-2', 'descricao' => 'Local onde pessoas requerem cuidados especiais por limitações físicas ou mentais', 'definicao' => 'Tratamento de dependentes de drogas, álcool e assemelhados, todos sem celas, asilos, residências geriátricas.']);
        EdificacaoClassificacao::create(['grupo' => 'H', 'ocupacao_uso' => 'Serviço de saúde', 'divisao' => 'H-3', 'descricao' => 'Hospital e assemelhados', 'definicao' => 'Hospitais, casa de saúde, prontos-socorros, clínicas com internação, ambulatórios e postos de atendimento de urgência, postos de saúde e puericultura e assemelhados com internação. Hospital psiquiátrico.']);
        EdificacaoClassificacao::create(['grupo' => 'H', 'ocupacao_uso' => 'Serviço de saúde', 'divisao' => 'H-4', 'descricao' => 'Clínica e consultório médico, odontológico e assemelhados', 'definicao' => 'Clínicas médicas, consultórios em geral, unidades de hemodiálise, ambulatórios e assemelhados. Todos sem internação.']);

        EdificacaoClassificacao::create(['grupo' => 'I', 'ocupacao_uso' => 'Industrial', 'divisao' => 'I-1', 'descricao' => 'Industrial 1', 'definicao' => 'Edificações industriais que, em função das atividades exercidas e dos materiais utilizados, são classificadas como Risco Médio 1 conforme Nota Técnica específica.']);
        EdificacaoClassificacao::create(['grupo' => 'I', 'ocupacao_uso' => 'Industrial', 'divisao' => 'I-2', 'descricao' => 'Industrial 2', 'definicao' => 'Edificações industriais que, em função das atividades exercidas e dos materiais utilizados, são classificadas como Risco Médio 2 conforme Nota Técnica específica.']);
        EdificacaoClassificacao::create(['grupo' => 'I', 'ocupacao_uso' => 'Industrial', 'divisao' => 'I-3', 'descricao' => 'Industrial 3', 'definicao' => 'Edificações industriais que, em função das atividades exercidas e dos materiais utilizados, são classificadas como Risco Grande conforme Nota Técnica específica.']);

        EdificacaoClassificacao::create(['grupo' => 'J', 'ocupacao_uso' => 'Depósito', 'divisao' => 'J-1', 'descricao' => 'Depósitos de material incombustível', 'definicao' => 'Edificações sem processo industrial que armazenam tijolos, pedras, areias, cimentos, metais e outros materiais incombustíveis, todos sem embalagem.']);
        EdificacaoClassificacao::create(['grupo' => 'J', 'ocupacao_uso' => 'Depósito', 'divisao' => 'J-2', 'descricao' => 'Todo tipo de Depósito', 'definicao' => 'Depósitos com carga de incêndio até 1.000 MJ/m², conforme Nota Técnica específica.']);
        EdificacaoClassificacao::create(['grupo' => 'J', 'ocupacao_uso' => 'Depósito', 'divisao' => 'J-3', 'descricao' => 'Todo tipo de Depósito', 'definicao' => 'Depósitos com carga de incêndio entre 1.000 e 1.200 MJ/m 2 , conforme Nota Técnica específica.']);
        EdificacaoClassificacao::create(['grupo' => 'J', 'ocupacao_uso' => 'Depósito', 'divisao' => 'J-4', 'descricao' => 'Todo tipo de Depósito', 'definicao' => 'Depósitos onde a carga de incêndio ultrapassa a 1.200 MJ/m², conforme Nota Técnica específica.']);

        EdificacaoClassificacao::create(['grupo' => 'L', 'ocupacao_uso' => 'Explosivos ou munições', 'divisao' => 'L-1', 'descricao' => 'Comércio', 'definicao' => 'Comércio em geral de fogos de artifício, munições e assemelhados']);
        EdificacaoClassificacao::create(['grupo' => 'L', 'ocupacao_uso' => 'Explosivos ou munições', 'divisao' => 'L-2', 'descricao' => 'Indústria', 'definicao' => 'Indústria de material explosivo ou munições']);
        EdificacaoClassificacao::create(['grupo' => 'L', 'ocupacao_uso' => 'Explosivos ou munições', 'divisao' => 'L-3', 'descricao' => 'Depósito', 'definicao' => 'Depósito de material explosivo ou munições']);

        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-1', 'descricao' => 'Túnel', 'definicao' => 'Túnel rodoferroviário destinados a transporte de passageiros ou cargas diversas']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-2', 'descricao' => 'Líquidos ou gases inflamáveis ou combustíveis', 'definicao' => 'Edificação destinada a manipulação, armazenamento e distribuição de líquidos ou gases inflamáveis ou combustíveis, tais como: ponto de venda ou depósito de GLP, etc.']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-3', 'descricao' => 'Central de comunicação', 'definicao' => 'Central telefônica, centros de comunicação, antenas de telefonia e assemelhados.']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-4', 'descricao' => 'Estrutura temporária', 'definicao' => 'Canteiro de obras e assemelhados, (não possuem atividade de reunião de público)']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-5', 'descricao' => 'Silos', 'definicao' => 'Armazéns de grãos e assemelhado']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-6', 'descricao' => 'Energia', 'definicao' => 'Geração, transmissão e distribuição de energia e assemelhados.']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-7', 'descricao' => 'Pátios de armazenagem', 'definicao' => 'Pátios – área não coberta que tem como destinação de uso a estocagem de produtos.']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-8', 'descricao' => 'Loteamento', 'definicao' => 'Loteamento - é a divisão de glebas em lotes destinados à edificação, com aberturas de novas vias de circulação ou de logradouros públicos ou privados']);
        EdificacaoClassificacao::create(['grupo' => 'M', 'ocupacao_uso' => 'Especial', 'divisao' => 'M-9', 'descricao' => 'Local onde a liberdade das pessoas sofre restrição', 'definicao' => 'Manicômios, reformatórios, prisões em geral (casa de detenção, penitenciárias, presídios) e instituições assemelhadas, todos com celas']);
    }
}