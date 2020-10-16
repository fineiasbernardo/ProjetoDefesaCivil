<div class="container positioning">
<div class="jumbotron campo_cadastro">
    <form method="post" action="processa_editar_ocorrencia.php" enctype="multipart/form-data">
        <input name="id_ocorrencia" type="hidden" value="<?php echo $_POST['id_ocorrencia']; ?>">
        <input type="hidden" name="chamado_id"  value="<?php echo $_POST['chamado_id']; ?>">
        <div class="box">
            <div class="row cabecalho">
                <div class="col-sm-6">
                    <nav class="texto-cabecalho">Estado de Santa Catarina</nav>
                    <nav class="texto-cabecalho">Prefeitura de Balneário Camboriú</nav>
                    <nav class="texto-cabecalho">Secretaria de segurança</nav>
                    <nav class="texto-cabecalho">Defesa Civil</nav>
                </div>
                <div class="col-sm-6">
                    <img src="images/balneario-camboriu.png" alt="prefeitura-balneario-camboriu" class="img-cabecalho">
                </div>
            </div>
            <h2 class="text-center">Registro de ocorrência</h2>
        <hr>
            <?php if(isset($_GET['erroDB'])){ ?>
            <div class="alert alert-danger" role="alert">
                Falha ao alterar ocorrencia.
            </div>
            <?php } ?>
            <div>
                Endereço principal: <span style="color:red;">*</span>
                <br>
                <label for="endereco_principal"></label>
                <select name="endereco_principal" class="form-control endereco-principal" ng-model="sel_endereco" ng-init="sel_endereco='<?php echo $_POST['endereco_principal']; ?>'" required>
                    <option value="Coordenada">Coordenada</option>
                    <option value="Logradouro">Logradouro</option>
                </select>
            </div>
            <?php if(isset($_GET['endereco_principal'])){ ?>
                <span class="alertErro">
                    Opção de endereço desconhecida.
                </span>
            <?php } ?>
            <div ng-show="sel_endereco == 'Coordenada'">
                <div class="row">
                    <div class="col-sm-4">
                        <span>Latitude: <span style="color:red;">*</span></span>
                        <input id="latitude" name="latitude" type="text" class="form-control"  value="<?php echo $_POST['latitude']; ?>" onchange="verificaLatLgn()">
                    </div>
                    <div class="col-sm-4">
                        Longitude: <span style="color:red;">*</span>
                        <input id="longitude" name="longitude" type="text" class="form-control"  value="<?php echo $_POST['longitude']; ?>" onchange="verificaLatLgn()">
                        
                    </div>
                    <div class="col-sm-4">
                        <br>
                        <button type="button" class="btn-default btn-small inline open-AddBookDialog" data-toggle="modal" data-id="map"><span class="glyphicon glyphicon-map-marker"></span></button>
                    </div>
                </div>
            </div>
            <div ng-show="sel_endereco == 'Logradouro'">
                <div class="row">
                    <div class="col-sm-3">
                        <span>CEP:</span> 
                        <input id="cep" name="cep" type="text" class="form-control" ng-model="cep" ng-init="cep='<?php echo $_POST['cep']; ?>'" maxlength="8" onchange="verificaCep(this.value)">
                        <span id="erroCep" class="alertErro hide">CEP inválido.</span>
                    </div>
                    <div class="col-sm-9">
                        <span>Logradouro: <span style="color:red;">*</span></span>
                        <input id="logradouro" name="logradouro" type="text" class="form-control" value="<?php echo $_POST['logradouro']; ?>">
                        <?php if(isset($_GET['logradouro'])){ ?>
                            <span class="alertErro">Erro ao cadastrar logradouro.</span>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <span>Número: </span> <span style="color:red;">*</span>
                        <input id="complemento" name="complemento" type="text" class="form-control" value="<?php echo $_POST['numero']; ?>">
                    </div>
                    <div class="col-sm-8">
                        <span>Bairro: <span style="color:red;">*</span></span>
                        <input id="bairro" name="bairro" type="text" class="form-control" value="<?php echo $_POST['bairro']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <span>Cidade: </span> <span style="color:red;">*</span> 
                        <input id="cidade" name="cidade" type="text" class="form-control" value="<?php echo $_POST['cidade']; ?>">
                    </div>
                    <div class="col-sm-7">
                        <span>Referência: <span style="color:red;">*</span></span>
                        <input name="referencia" type="text" class="form-control" value="<?php echo $_POST['referencia']; ?>">
                    </div>
                </div>
            </div>
        <hr>
            <div>
                Agente principal: <span style="color:red;">*</span>
                <input id="agente_principal" name="agente_principal" type="text" class="form-control" value="<?php echo $_POST['agente_principal']; ?>" onkeyup="showResult(this.value,this.id)" required>
                <div class="autocomplete" id="livesearchagente_principal"></div>
            </div>
            <?php if(isset($_GET['agente_principal'])){ ?>
                    <span class="alertErro">
                        Agente não encontrado ou informado incorretamente.
                    </span>
                <?php } ?>
            <div>
                Agente de apoio 1:
                <input id="agente_apoio_1" name="agente_apoio_1" type="text" class="form-control" value="<?php echo $_POST['agente_apoio1']; ?>" onkeyup="showResult(this.value,this.id)">
                <div class="autocomplete" id="livesearchagente_apoio_1"></div>
            </div>
            <?php if(isset($_GET['agente_apoio_1'])){ ?>
                <span class="alertErro">
                    Agente não encontrado ou informado incorretamente.
                </span>
            <?php } ?>
            <div>
                Agente de apoio 2:
                <input id="agente_apoio_2" name="agente_apoio_2" type="text" class="form-control" value="<?php echo $_POST['agente_apoio2']; ?>" onkeyup="showResult(this.value,this.id)">
                <div class="autocomplete" id="livesearchagente_apoio_2"></div>
            </div>
            <?php if(isset($_GET['agente_apoio_2'])){ ?>
                <span class="alertErro">
                    Agente não encontrado ou informado incorretamente.
                </span>
            <?php } ?>
        <hr>
            <div>
                <span>Data de ocorrência: <span style="color:red;">*</span></span>
                <br>
                <input id="data_ocorrencia" name="data_ocorrencia" type="date" class="form-control data" value="<?php echo $_POST['data_ocorrencia']; ?>" max="<?php echo date('Y-m-d'); ?>" required onchange="verificaData()">
            </div>
            <span id="erroData" class="alertErro hide">Data de lançamento inválida.</span>
            <div>
                Titulo:
                <textarea id="titulo" name="titulo" class="form-control" cols="30" rows="2" maxlength="120" ng-model="tituloVal" ng-init="tituloVal='<?php echo $_POST['titulo']; ?>'"></textarea>
                <span class="char-count">{{tituloVal.length || 0}}/120</span>
            </div>
            <div>
                Descrição:
                <textarea id="descricao" name="descricao" class="form-control" cols="30" rows="5" maxlength = "100" ng-model="descricaoVal" ng-init="descricaoVal='<?php echo $_POST['ocorr_descricao']; ?>'"></textarea>
            </div>
            <div>
                Origem:
                <input name="ocorr_origem" type="text" class="form-control" value="<?php echo $_POST['ocorr_origem']; ?>">
            </div>
        <hr>
            <div>
                Pessoa atendida 1:
                <br>
                <input id="pessoa_atendida_1" name="pessoa_atendida_1" type="text" class="form-control inline" style="width:93%;" value="<?php echo $_POST['pessoa1']; ?>" onkeyup="showResult(this.value,this.id)">
                <button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#pessoasModal"><span class="glyphicon glyphicon-plus"></span></button>
                <div class="autocomplete" id="livesearchpessoa_atendida_1"></div>
                <div id="resultpessoa_atendida_1"></div>
            </div>
            <?php if(isset($_GET['pessoa_atendida_1'])){ ?>
                <span class="alertErro">
                    Pessoa não encontrada ou informada incorretamente.
                </span>
            <?php } ?>
            <div>
                Pessoa atendida 2:
                <br>
                <input id="pessoa_atendida_2" name="pessoa_atendida_2" type="text" class="form-control inline" style="width:93%;" value="<?php echo $_POST['pessoa2']; ?>" onkeyup="showResult(this.value,this.id)">
                <button type="button" class="btn-default btn-small inline open-AddBookDialog" data-toggle="modal" data-id="pessoa_atendida_2"><span class="glyphicon glyphicon-plus"></span></button>
                <div class="autocomplete" id="livesearchpessoa_atendida_2"></div>
                <div id="resultpessoa_atendida_2"></div>
            </div>
            <?php if(isset($_GET['pessoa_atendida_2'])){ ?>
                <span class="alertErro">
                    Pessoa não encontrada ou informada incorretamente.
                </span>
            <?php } ?>
        <hr>
        <div>
                Cobrade: 
                <?php if(isset($_GET['cobrade'])){ ?>
                    <br><span class="alertErro">
                        Cobrade incorreto.
                    </span>
                <?php } ?>
                <div class="cobrade">
                    Categoria: <span style="color:red;">*</span><br>
                    <select name="cobrade_categoria" class="form-control cobrade-sub" ng-model="categoria" ng-init="categoria='<?php echo $_POST['ocorr_cobrade'][0]; ?>'">
                        <option value="1">Naturais</option>
                        <option value="2">Tecnológicos</option>
                        <option value="0">Não Listado</option>
                    </select>
                    Grupo: <span style="color:red;" ng-hide="categoria == 0">*</span><br>
                    <select name="cobrade_grupo" class="form-control cobrade-sub" ng-model="grupo" ng-disabled="categoria == 0" ng-init="grupo='<?php echo $_POST['ocorr_cobrade'][1]; ?>'">
                        <option ng-if="categoria==1" value="1">Geológico</option>
                        <option ng-if="categoria==1" value="2">Hidrológico</option>
                        <option ng-if="categoria==1" value="3">Meteorológico</option>
                        <option ng-if="categoria==1" value="4">Climatólogo</option>
                        <option ng-if="categoria==1" value="5">Biológico</option>
                        <option ng-if="categoria==2" value="1">Desastres Relacionados a Substâncias radioativas</option>
                        <option ng-if="categoria==2" value="2">Desastres Relacionados a Produtos Perigosos</option>
                        <option ng-if="categoria==2" value="3">Desastres Relacionados a Incêndios Urbanos</option>
                        <option ng-if="categoria==2" value="4">Desastres relacionados a obras civis</option>
                        <option ng-if="categoria==2" value="5">Desastres relacionados a transporte de passageiros e cargas não perigosas</option>
                    </select>
                    Subgrupo: <span style="color:red;" ng-hide="grupo == 0">*</span><br>
                    <select name="cobrade_subgrupo" class="form-control cobrade-sub" ng-model="subgrupo" ng-disabled="grupo == 0" ng-init="subgrupo='<?php echo $_POST['ocorr_cobrade'][2]; ?>'">
                        <option ng-if="grupo==1&&categoria==1" value="1">Terremoto</option>
                        <option ng-if="grupo==1&&categoria==1" value="2">Emanação vulcânica</option>
                        <option ng-if="grupo==1&&categoria==1" value="3">Movimento de massa</option>
                        <option ng-if="grupo==1&&categoria==1" value="4">Erosão</option>
                        <option ng-if="grupo==2&&categoria==1" value="1">Inundações</option>
                        <option ng-if="grupo==2&&categoria==1" value="2">Enxurradas</option>
                        <option ng-if="grupo==2&&categoria==1" value="3">Alagamentos</option>
                        <option ng-if="grupo==3&&categoria==1" value="1">Sistemas de Grande Escala/Escala Regional</option>
                        <option ng-if="grupo==3&&categoria==1" value="2">Tempestades</option>
                        <option ng-if="grupo==3&&categoria==1" value="3">Temperaturas Extremas</option>
                        <option ng-if="grupo==4&&categoria==1" value="1">Seca</option>
                        <option ng-if="grupo==5&&categoria==1" value="1">Epidemias</option>
                        <option ng-if="grupo==5&&categoria==1" value="2">Infestações/Pragas</option>
                        <option ng-if="grupo==1&&categoria==2" value="1">Desastres siderais com riscos radioativos</option>
                        <option ng-if="grupo==1&&categoria==2" value="2">Desastres com substâncias e equipamentos radioativos de uso em pesquisas, indústrias e usinas nucleares</option>
                        <option ng-if="grupo==1&&categoria==2" value="3">Desastres relacionados com riscos de intensa poluição ambiental provocada por resíduos radioativos</option>
                        <option ng-if="grupo==2&&categoria==2" value="1">Desastres em plantas e distritos industriais, parques e armazenamentos com extravasamento de produtos perigosos</option>
                        <option ng-if="grupo==2&&categoria==2" value="2">Desastres relacionados à contaminação da água</option>
                        <option ng-if="grupo==2&&categoria==2" value="3">Desastres Relacionados a Conflitos Bélicos</option>
                        <option ng-if="grupo==2&&categoria==2" value="4">Desastres relacionados a transporte de produtos perigosos</option>
                        <option ng-if="grupo==3&&categoria==2" value="1">Incêndios urbanos</option>
                        <option ng-if="grupo==4&&categoria==2" value="1">Colapso de edificações</option>
                        <option ng-if="grupo==4&&categoria==2" value="2">Rompimento/colapso de barragens</option>
                        <option ng-if="grupo==5&&categoria==2" value="1">Transporte rodoviário</option>
                        <option ng-if="grupo==5&&categoria==2" value="2">Transporte ferroviário</option>
                        <option ng-if="grupo==5&&categoria==2" value="3">Transporte aéreo</option>
                        <option ng-if="grupo==5&&categoria==2" value="4">Transporte marítimo</option>
                        <option ng-if="grupo==5&&categoria==2" value="5">Transporte aquaviário</option>
                    </select>
                    Tipo: <span style="color:red;" ng-hide="subgrupo == 0">*</span><br>
                    <select name="cobrade_tipo" class="form-control cobrade-sub" ng-model="tipo" ng-disabled="subgrupo==0" ng-init="tipo='<?php echo $_POST['ocorr_cobrade'][3]; ?>'">
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1">Tremor de terra</option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="2">Tsunami</option>
                        <option ng-if="subgrupo==2&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="subgrupo==3&&grupo==1&&categoria==1" value="1">Quedas, Tombamentos e rolamentos</option>
                        <option ng-if="subgrupo==3&&grupo==1&&categoria==1" value="2">Deslizamentos</option>
                        <option ng-if="subgrupo==3&&grupo==1&&categoria==1" value="3">Corridas de Massa</option>
                        <option ng-if="subgrupo==3&&grupo==1&&categoria==1" value="4">Subsidências e colapsos</option>
                        <option ng-if="subgrupo==4&&grupo==1&&categoria==1" value="1">Erosão Costeira/Marinha</option>
                        <option ng-if="subgrupo==4&&grupo==1&&categoria==1" value="2">Erosão de Margem Fluvial</option>
                        <option ng-if="subgrupo==4&&grupo==1&&categoria==1" value="3">Erosão Continental</option>
                        <option ng-if="grupo==2&&categoria==1" value="0"></option>
                        <option ng-if="subgrupo==1&&grupo==3&&categoria==1" value="1">Ciclones</option>
                        <option ng-if="subgrupo==1&&grupo==3&&categoria==1" value="2">Frentes Frias/Zonas de Convergência</option>
                        <option ng-if="subgrupo==2&&grupo==3&&categoria==1" value="1">Tempestade Local/Convectiva</option>
                        <option ng-if="subgrupo==3&&grupo==3&&categoria==1" value="1">Onda de Calor</option>
                        <option ng-if="subgrupo==3&&grupo==3&&categoria==1" value="2">Onda de Frio</option>
                        <option ng-if="subgrupo==1&&grupo==4&&categoria==1" value="1">Estiagem</option>
                        <option ng-if="subgrupo==1&&grupo==4&&categoria==1" value="2">Seca</option>
                        <option ng-if="subgrupo==1&&grupo==4&&categoria==1" value="3">Incêndio Florestal</option>
                        <option ng-if="subgrupo==1&&grupo==4&&categoria==1" value="4">Baixa Humidade do Ar</option>
                        <option ng-if="subgrupo==1&&grupo==5&&categoria==1" value="1">Doenças infecciosas virais </option>
                        <option ng-if="subgrupo==1&&grupo==5&&categoria==1" value="2">Doenças infecciosas bacterianas</option>
                        <option ng-if="subgrupo==1&&grupo==5&&categoria==1" value="3">Doenças infecciosas parasíticas</option>
                        <option ng-if="subgrupo==1&&grupo==5&&categoria==1" value="4">Doenças infecciosas fúngicas</option>
                        <option ng-if="subgrupo==2&&grupo==5&&categoria==1" value="1">Infestações de animais</option>
                        <option ng-if="subgrupo==2&&grupo==5&&categoria==1" value="2"> Infestações de algas</option>
                        <option ng-if="subgrupo==2&&grupo==5&&categoria==1" value="3">Outras Infestações</option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==2" value="1">Queda de satélite (radionuclídeos)</option>
                        <option ng-if="subgrupo==2&&grupo==1&&categoria==2" value="1">ontes radioativas em processos de produção</option>
                        <option ng-if="subgrupo==3&&grupo==1&&categoria==2" value="1">Outras fontes de liberação de radionuclídeos para o meio ambiente</option>
                        <option ng-if="subgrupo==1&&grupo==2&&categoria==2" value="1">Liberação de produtos químicos para a atmosfera causada por explosão ou incêndio</option>
                        <option ng-if="subgrupo==2&&grupo==2&&categoria==2" value="1">Liberação de produtos químicos nos sistemas de água potável</option>
                        <option ng-if="subgrupo==2&&grupo==2&&categoria==2" value="2">Derramamento de produtos químicos em ambiente lacustre, fluvial, marinho e aquíferos</option>
                        <option ng-if="subgrupo==3&&grupo==2&&categoria==2" value="1">Liberação produtos químicos e contaminação como conseqüência de ações militares.</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="1">Transporte rodoviário</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="2">Transporte ferroviário</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="3">Transporte aéreo</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="4">Transporte dutoviário</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="5">Transporte marítimo</option>
                        <option ng-if="subgrupo==4&&grupo==2&&categoria==2" value="6">Transporte aquaviário</option>
                        <option ng-if="subgrupo==1&&grupo==3&&categoria==2" value="1">Incêndios em plantas e distritos industriais, parques e depósitos</option>
                        <option ng-if="subgrupo==1&&grupo==3&&categoria==2" value="2">Incêndios em aglomerados residenciais</option>
                        <option ng-if="grupo==4&&categoria==2" value="0"></option>
                        <option ng-if="grupo==5&&categoria==2" value="0"></option>
                    </select>
                    Subtipo: <span style="color:red;" ng-hide="tipo==0 || categoria==2">*</span><br>
                    <select name="cobrade_subtipo" class="form-control cobrade-sub" ng-model="subtipo" ng-disabled="tipo==0 || categoria==2" ng-init="subtipo='<?php echo $_POST['ocorr_cobrade'][4]; ?>'">
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="subgrupo==2&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="tipo==1&&subgrupo==3&&grupo==1&&categoria==1" value="1">Blocos</option>
                        <option ng-if="tipo==1&&subgrupo==3&&grupo==1&&categoria==1" value="2">Lascas</option>
                        <option ng-if="tipo==1&&subgrupo==3&&grupo==1&&categoria==1" value="3">Matacões</option>
                        <option ng-if="tipo==1&&subgrupo==3&&grupo==1&&categoria==1" value="4">Lajes</option>
                        <option ng-if="tipo==2&&subgrupo==3&&grupo==1&&categoria==1" value="1">Deslizamentos de solo e ou rocha</option>
                        <option ng-if="tipo==3&&subgrupo==3&&grupo==1&&categoria==1" value="1">Solo/Lama</option>
                        <option ng-if="tipo==3&&subgrupo==3&&grupo==1&&categoria==1" value="2">Rocha/Detrito</option>
                        <option ng-if="tipo==4&&subgrupo==3&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="tipo==1&&subgrupo==4&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="tipo==2&&subgrupo==4&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="tipo==3&&subgrupo==4&&grupo==1&&categoria==1" value="1">Laminar</option>
                        <option ng-if="tipo==3&&subgrupo==4&&grupo==1&&categoria==1" value="2">Ravinas</option>
                        <option ng-if="tipo==3&&subgrupo==4&&grupo==1&&categoria==1" value="3">Boçorocas</option>
                        <option ng-if="grupo==2&&categoria==1" value="0"></option>
                        <option ng-if="tipo==1&&subgrupo==1&&grupo==3&&categoria==1" value="1">Ventos Costeiros (Mobilidade de Dunas)</option>
                        <option ng-if="tipo==1&&subgrupo==1&&grupo==3&&categoria==1" value="2">Marés de Tempestade (Ressacas)</option>
                        <option ng-if="tipo==2&&subgrupo==1&&grupo==3&&categoria==1" value="0"></option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==3&&categoria==1" value="1">Tornados</option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==3&&categoria==1" value="2">Tempestade de Raios</option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==3&&categoria==1" value="3">Granizo</option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==3&&categoria==1" value="4">Chuvas Intensas</option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==3&&categoria==1" value="5">Vendaval</option>
                        <option ng-if="tipo==1&&subgrupo==3&&grupo==3&&categoria==1" value="0"></option>
                        <option ng-if="tipo==2&&subgrupo==3&&grupo==3&&categoria==1" value="1">Friagem</option>
                        <option ng-if="tipo==2&&subgrupo==3&&grupo==3&&categoria==1" value="2">Geadas</option>
                        <option ng-if="tipo==1&&subgrupo==1&&grupo==4&&categoria==1" value="0"></option>
                        <option ng-if="tipo==2&&subgrupo==1&&grupo==4&&categoria==1" value="0"></option>
                        <option ng-if="tipo==3&&subgrupo==1&&grupo==4&&categoria==1" value="1">Incêndios em Parques, Áreas de Proteção Ambiental e Áreas de Preservação Permanente Nacionais, Estaduais ou Municipais</option>
                        <option ng-if="tipo==3&&subgrupo==1&&grupo==4&&categoria==1" value="2">Incêndios em áreas não protegidas, com reflexos na qualidade do ar</option>
                        <option ng-if="tipo==4&&subgrupo==1&&grupo==4&&categoria==1" value="0"></option>
                        <option ng-if="subgrupo==1&&grupo==5&&categoria==1" value="0"></option>
                        <option ng-if="tipo==1&&subgrupo==2&&grupo==5&&categoria==1" value="0"></option>
                        <option ng-if="tipo==2&&subgrupo==2&&grupo==5&&categoria==1" value="1">Marés vermelhas</option>
                        <option ng-if="tipo==2&&subgrupo==2&&grupo==5&&categoria==1" value="2">Ciano bactérias em reservatórios</option>
                        <option ng-if="tipo==3&&subgrupo==2&&grupo==5&&categoria==1" value="0"></option>
                        <option ng-if="categoria==2" value="0"></option>
                    </select>
                </div>
            </div>
            <br>
            <div>
                Descricao cobrade: <span style="color:red;" ng-show="categoria == 0">*</span>
                <textarea id="natureza" name="cobrade_descricao" class="form-control" cols="30" rows="2" maxlength = "100" ng-disabled="categoria != 0"  ng-model="cobrade_descricao" ng-init="cobrade_descricao='<?php echo $_POST['cobrade_descricao']; ?>'" required></textarea>
            </div>
            <br>
            <div>
                Adicionar fotos:
                <input name="possui_fotos" type="hidden" value="<?php echo $_POST['possui_fotos']; ?>">
                <input name="files[]" type="file" multiple="multiple" accept="image/png,image/jpeg">
            </div>
        <hr>
            <div>
                Prioridade: <span style="color:red;">*</span>
                <label for="prioridade"></label>
                <select name="prioridade" class="form-control" style="width:30%;" required ng-model="prioridade" ng-init="prioridade='<?php echo $_POST['prioridade']; ?>'">
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>
            <?php if($_SESSION['nivel_acesso'] == 1 || $_SESSION['nivel_acesso'] == 2){ ?>
                <div class="row">
                    <div class="col-sm-4">
                        <span>Analisado: <span style="color:red;">*</span></span><br>
                        <div style="display:inline;">
                            <label class="radio-inline">
                                <input type="radio" value="true" id="analisado" name="analisado" <?php echo ($_POST['analisado'] == t) ? 'checked':''; ?>>Sim
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="false" id="analisado" name="analisado" <?php echo ($_POST['analisado'] == t) ? '':'checked'; ?>>Não
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <span>Congelado: <span style="color:red;">*</span></span><br>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" value="true" name="congelado" <?php echo ($_POST['congelado'] == t) ? 'checked':''; ?>>Sim
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="false" name="congelado" <?php echo ($_POST['congelado'] == t) ? '':'checked'; ?>>Não
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <span>Encerrado: <span style="color:red;">*</span></span><br>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" value="true" name="encerrado" <?php echo ($_POST['encerrado'] == t) ? 'checked':''; ?>>Sim
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="false" name="encerrado" <?php echo ($_POST['encerrado'] == t) ? '':'checked'; ?>>Não
                            </label>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <p>Status</p>
                <nav>
                    <input type="hidden" name="analisado" value="<?php echo ($_POST['analisado'] == t) ? "true":"false"; ?>">
                    Analisado: <span><?php echo ($_POST['analisado'] == t) ? 'Sim':'Não'; ?></span>
                </nav>
                <nav>
                    <input type="hidden" name="congelado" value="<?php echo ($_POST['congelado'] == t) ? "true":"false";  ?>">
                    Congelado: <span><?php echo ($_POST['congelado']== t) ? 'Sim':'Não'; ?></span>
                </nav>
                <nav>
                    <input type="hidden" name="encerrado" value="<?php echo ($_POST['encerrado'] == t) ? "true":"false";  ?>">
                    Encerrado: <span><?php echo ($_POST['encerrado']== t) ? 'Sim':'Não'; ?></span>
                </nav>
            <?php } ?>
            <br>
        </div>
        <input type="submit" class="btn btn-default btn-md" value="Salvar">
    </form>

    <div class="modal fade" id="pessoasModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Cadastrar pessoa</h5>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <nav>
                            <input id="id_pessoa" type="hidden" value="">
                            <div class="row">
                                <div class="col-sm-12">
                                    Nome: <span style="color:red;">*</span>
                                    <input id="nome_pessoa" name="nome_pessoa" type="text" class="form-control" onchange="verificaNome(this.value)">
                                </div>
                            </div>   
                            <span id="erroNome" class="alertErro hide">Nome inválido.</span>
                            <div class="row">
                                <div class="col-sm-6">
                                    CPF:
                                    <input id="cpf_pessoa" name="cpf_pessoa" type="text" class="form-control" maxlength="11" onchange="verificaCpf(this.value)">
                                    <span id="erroCpf" class="alertErro hide">CPF inválido.</span>
                                </div>
                                <div class="col-sm-6">
                                    Outros documentos:
                                    <input id="outros_documentos" name="outros_documentos" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    Celular: 
                                    <input id="celular_pessoa" name="celular_pessoa" type="text" class="form-control" pattern="\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}" title="(XX) XXXXX-XXXX" onchange="verificaCelular(this.value)">
                                    <span id="erroCelular" class="alertErro hide">Celular inválido.</span>
                                </div>
                                <div class="col-sm-6">
                                    Telefone: 
                                    <input id="telefone_pessoa" name="telefone_pessoa" type="text" class="form-control" pattern="\([0-9]{2}\)\s[0-9]{4}\-[0-9]{4}" title="(XX) XXXX-XXXX" onchange="verificaTelefone(this.value)">
                                    <span id="erroTelefone" class="alertErro hide">Telefone inválido.</span>
                                </div>
                            </div>
                            <span id="erroTelefone" class="alertErro hide">Telefone inválido.</span>
                            <div class="form-group">
                                Email:
                                <input id="email_pessoa" name="email_pessoa" type="email" class="form-control" onchange="verificaEmail(this.value)">
                            </div>
                            <span id="erroEmail" class="alertErro hide">Email inválido.</span>
                        </nav>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submitFormData" onclick="SubmitFormData()">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="map" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Mapa</h5>
                </div>
                <div class="modal-body">
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitFormData" onclick="SubmitFormData()" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>