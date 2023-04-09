<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelephoneDddsSeeder extends Seeder
{
    public function run()
    {
        DB::table('telephone_ddds')->insert([
            ['ddd' => '11', 'city' => 'São Paulo – SP'],
            ['ddd' => '12', 'city' => 'São José dos Campos – SP'],
            ['ddd' => '13', 'city' => 'Santos – SP'],
            ['ddd' => '14', 'city' => 'Bauru – SP'],
            ['ddd' => '15', 'city' => 'Sorocaba – SP'],
            ['ddd' => '16', 'city' => 'Ribeirão Preto – SP'],
            ['ddd' => '17', 'city' => 'São José do Rio Preto – SP'],
            ['ddd' => '18', 'city' => 'Presidente Prudente – SP'],
            ['ddd' => '19', 'city' => 'Campinas – SP'],
            ['ddd' => '21', 'city' => 'Rio de Janeiro – RJ'],
            ['ddd' => '22', 'city' => 'Campos dos Goytacazes – RJ'],
            ['ddd' => '24', 'city' => 'Volta Redonda – RJ'],
            ['ddd' => '27', 'city' => 'Vitória / Vila Velha – ES'],
            ['ddd' => '28', 'city' => 'Cachoeiro de Itapemirim – ES'],
            ['ddd' => '31', 'city' => 'Belo Horizonte – MG'],
            ['ddd' => '32', 'city' => 'Juiz de Fora – MG'],
            ['ddd' => '33', 'city' => 'Governador Valadares – MG'],
            ['ddd' => '34', 'city' => 'Uberlândia – MG'],
            ['ddd' => '35', 'city' => 'Poços de Caldas – MG'],
            ['ddd' => '37', 'city' => 'Divinópolis – MG'],
            ['ddd' => '38', 'city' => 'Montes Claros – MG'],
            ['ddd' => '41', 'city' => 'Curitiba – PR'],
            ['ddd' => '42', 'city' => 'Ponta Grossa – PR'],
            ['ddd' => '43', 'city' => 'Londrina – PR'],
            ['ddd' => '44', 'city' => 'Maringá – PR'],
            ['ddd' => '45', 'city' => 'Foz do Iguaçú – PR'],
            ['ddd' => '46', 'city' => 'Pato Branco / Francisco Beltrão – PR'],
            ['ddd' => '47', 'city' => 'Joinville – SC'],
            ['ddd' => '48', 'city' => 'Florianópolis – SC'],
            ['ddd' => '49', 'city' => 'Chapecó – SC'],
            ['ddd' => '51', 'city' => 'Porto Alegre – RS'],
            ['ddd' => '53', 'city' => 'Pelotas – RS'],
            ['ddd' => '54', 'city' => 'Caxias do Sul – RS'],
            ['ddd' => '55', 'city' => 'Santa Maria – RS'],
            ['ddd' => '61', 'city' => 'Brasília – DF'],
            ['ddd' => '62', 'city' => 'Goiânia – GO'],
            ['ddd' => '63', 'city' => 'Palmas – TO'],
            ['ddd' => '64', 'city' => 'Rio Verde – GO'],
            ['ddd' => '65', 'city' => 'Cuiabá – MT'],
            ['ddd' => '66', 'city' => 'Rondonópolis – MT'],
            ['ddd' => '67', 'city' => 'Campo Grande – MS'],
            ['ddd' => '68', 'city' => 'Rio Branco – AC'],
            ['ddd' => '69', 'city' => 'Porto Velho – RO'],
            ['ddd' => '71', 'city' => 'Salvador – BA'],
            ['ddd' => '73', 'city' => 'Ilhéus – BA'],
            ['ddd' => '74', 'city' => 'Juazeiro – BA'],
            ['ddd' => '75', 'city' => 'Feira de Santana – BA'],
            ['ddd' => '77', 'city' => 'Barreiras – BA'],
            ['ddd' => '79', 'city' => 'Aracaju – SE'],
            ['ddd' => '81', 'city' => 'Recife – PE'],
            ['ddd' => '82', 'city' => 'Maceió – AL'],
            ['ddd' => '83', 'city' => 'João Pessoa – PB'],
            ['ddd' => '84', 'city' => 'Natal – RN'],
            ['ddd' => '85', 'city' => 'Fortaleza – CE'],
            ['ddd' => '86', 'city' => 'Teresina – PI'],
            ['ddd' => '87', 'city' => 'Petrolina – PE'],
            ['ddd' => '88', 'city' => 'Juazeiro do Norte – CE'],
            ['ddd' => '89', 'city' => 'Picos – PI'],
            ['ddd' => '91', 'city' => 'Belém – PA'],
            ['ddd' => '92', 'city' => 'Manaus – AM'],
            ['ddd' => '93', 'city' => 'Santarém – PA'],
            ['ddd' => '94', 'city' => 'Marabá – PA'],
            ['ddd' => '95', 'city' => 'Boa Vista – RR'],
            ['ddd' => '96', 'city' => 'Macapá – AP'],
            ['ddd' => '97', 'city' => 'Coari – AM'],
            ['ddd' => '98', 'city' => 'São Luís – MA'],
            ['ddd' => '99', 'city' => 'Imperatriz – MA']
        ]);
    }
}
