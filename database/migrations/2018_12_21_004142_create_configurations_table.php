<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('displayName')->nullable();
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        DB::table('configurations')->insert([
        [ 
            'displayName' => 'WhatsApp',
            'key' => 'fb_whatsapp',
            'value' => null 
        ],
        [ 
            'displayName' => 'Telefone Principal',
            'key' => 'tel_princ',
            'value' => null 
        ],
        [ 
            'displayName' => 'Telefone Secundário',
            'key' => 'tel_sec',
            'value' => null 
        ],
        [ 
            'displayName' => 'E-mail',
            'key' => 'email_link',
            'value' => null 
        ],        
        [ 
            'displayName' => 'Endereço',
            'key' => 'endereco',
            'value' => null 
        ],    
        [ 
            'displayName' => 'Latitude',
            'key' => 'lat',
            'value' => null 
        ], 
        [ 
            'displayName' => 'Longitude',
            'key' => 'long',
            'value' => null 
        ],       
        [ 
            'displayName' => 'Horário de funcionamento',
            'key' => 'horarios',
            'value' => null 
        ],          
        [ 
            'displayName' => 'Link Facebook',
            'key' => 'fb_link',
            'value' => null 
        ],
        [ 
            'displayName' => 'Link Instagram',
            'key' => 'ig_link',
            'value' => null 
        ],
        [ 
            'displayName' => 'Link Twitter',
            'key' => 'tw_link',
            'value' => null 
        ],
        [ 
            'displayName' => 'Link Pinterest',
            'key' => 'pi_link',
            'value' => null 
        ],
        [ 
            'displayName' => 'Link Linkedin',
            'key' => 'li_link',
            'value' => null 
        ],

        [ 
            'displayName' => 'Título Principal',
            'key' => 'title_main',
            'value' => null 
        ],
        [ 
            'displayName' => 'Descrição Principal',
            'key' => 'descr_main',
            'value' => null 
        ],
            
        [ 
            'displayName' => 'Nome',
            'key' => 'name',
            'value' => null 
        ],
        [
            'displayName' => 'Logo',
            'key' => 'logo_url',
            'value' => null 
        ],
        
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
