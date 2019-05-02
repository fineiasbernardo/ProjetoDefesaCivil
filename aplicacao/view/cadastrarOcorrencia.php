<div class="container positioning">
<div class="jumbotron campo_cadastro">
    <form method="post" action="processa_cadastrar_ocorrencia.php">
        <div class="box">
            <?php 
                if(isset($_GET['sucesso'])){
            ?>
            <div class="alert alert-success" role="alert">
                Ocorrencia cadastrada com sucesso.
            </div>
            <?php 
                }
            ?>
            <?php 
                if(isset($_GET['erroDB'])){
            ?>
            <div class="alert alert-danger" role="alert">
                Falha ao cadastrar ocorrencia. <br>
                <?php echo 'a'.pg_last_error(); ?>
            </div>
            <?php 
                }
            ?>
            <div>
                Endereço principal: <span style="color:red;">*</span>
                <label for="endereco_principal"></label>
                <select name="endereco_principal" class="form-control" ng-model="sel_endereco">
                    <option value="Coordenada">Coordenada</option>
                    <option value="Logradouro">Logradouro</option>
                </select>
            </div>
            <div ng-show="sel_endereco == 'Coordenada'">
                <div>
                    Longitude: <span style="color:red;">*</span>
                    <input name="longitude" type="text" class="form-control">
                </div>
                <div>
                    Latitude: <span style="color:red;">*</span>
                    <input name="latitude" type="text" class="form-control">
                </div>
            </div>
            <div ng-show="sel_endereco == 'Logradouro'">
                <div>
                    CEP:
                    <input id="cep" name="cep" type="text" class="form-control" ng-model="cep">
                </div>
                <div>
                    Logradouro: <span style="color:red;">*</span>
                    <input id="logradouro" name="logradouro" type="text" class="form-control">
                </div>
                <div>
                    Número:
                    <input id="complemento" name="complemento" type="text" class="form-control">
                </div>
                <div>
                    Bairro:
                    <input id="bairro" name="bairro" type="text" class="form-control">
                </div>
                <div>
                    Cidade:
                    <input id="cidade" name="cidade" type="text" class="form-control">
                </div>
                <div>
                    Referência:
                    <input name="referencia" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="box">
            <div>
                Agente principal: <span style="color:red;">*</span>
                <input name="agente_principal" type="text" class="form-control">
            </div>
            <div>
                Agente de apoio 1:
                <input name="agente_apoio_1" type="text" class="form-control">
            </div>
            <div>
                Agente de apoio 2:
                <input name="agente_apoio_2" type="text" class="form-control">
            </div>
        </div>
        <div class="box">
            Ocorrência retorno: <span style="color:red;">*</span>
            <br>
            <nav>
                <label class="radio-inline">
                    <input type="radio" value="true" name="ocorr_retorno">Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" value="false" name="ocorr_retorno" checked>Não
                </label>
            </nav>
            <br>
            <div>
                Código de referência:
                <input name="ocorr_referencia" type="text" class="form-control">
            </div>
            <div>
                Data de lançamento: <span style="color:red;">*</span>
                <input name="data_lancamento" type="date" placeholder="DD/MM/YYYY" class="form-control">
            </div>
            <div>
                Data de ocorrência: <span style="color:red;">*</span>
                <input name="data_ocorrencia" type="date" placeholder="DD/MM/YYYY" class="form-control">
            </div>
            <div>
                Descrição:
                <textarea name="descricao" class="form-control" cols="30" rows="5" maxlength = "100"></textarea>
            </div>
            <div>
                Origem:
                <input name="ocorr_origem" type="text" class="form-control">
            </div>
        </div>
        <div class="box">
            <div>
                Pessoa atendida 1:
                <br>
                <input name="pessoa_atendida_1" type="text" class="form-control inline">
                <button type="button" class="btn-default btn-small inline" data-toggle="modal" data-target="#pessoasModal"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
            <div>
                Pessoa atendida 2:
                <br>
                <input name="pessoa_atendida_2" type="text" class="form-control inline">
            </div>
            
        </div>
        <div class="box">
            <div>
                Cobrade: <span style="color:red;">*</span><br>
                <div class="cobrade">
                    Categoria:
                    <select name="cobrade_categoria" class="form-control" ng-model="categoria">
                        <option value="1">Naturais</option>
                        <option value="2">Tecnológicos</option>
                    </select>
                    Grupo:
                    <select name="cobrade_grupo" class="form-control" ng-model="grupo" ng-disabled="categoria == 0">
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
                    Subgrupo:
                    <select name="cobrade_subgrupo" class="form-control" ng-model="subgrupo" ng-disabled="grupo == 0">
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
                    Tipo:
                    <select name="cobrade_tipo" class="form-control" ng-model="tipo" ng-disabled="subgrupo==0||subgrupo==2">
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1">Tremor de terra</option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="2">Tsunami</option>
                        <option ng-if="subgrupo==2&&grupo==1&&categoria==1" value="0"></option>
                        <option ng-if="subgrupo==4&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==5&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>
                        <option ng-if="subgrupo==1&&grupo==1&&categoria==1" value="1"></option>

                    </select>
                    Subtipo:
                    <select name="cobrade_subtipo" class="form-control" ng-model="subtipo" ng-disabled="tipo == 0">
                        <option value="1">Naturais</option>
                        <option value="2">Tecnológicos</option>
                    </select>
                </div>
            </div>
            <br>
            <div>
                Natureza da ocorrência:
                <input name="natureza" type="text" class="form-control">
            </div>
            Possui fotos:
            <br>
            <nav>
                <label class="radio-inline">
                    <input type="radio" value="true" name="possui_fotos">Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" value="false" name="possui_fotos" checked>Não
                </label>
            </nav>
            <br>
            <div>
                Fotos:
                <button type="button" class="btn btn-default btn-sm inline">Carregar fotos</button>
            </div>
        </div>
        <div class="box">
            <div>
                Prioridade: <span style="color:red;">*</span>
                <label for="prioridade"></label>
                <select name="prioridade" class="form-control">
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="Alta">Alta</option>
                </select>
            </div>
            Analisado: <span style="color:red;">*</span>
            <br>
            <nav>
                <label class="radio-inline">
                    <input type="radio" value="true" name="analisado">Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" value="false" name="analisado" checked>Não
                </label>
            </nav>
            <br>
            Congelado: <span style="color:red;">*</span>
            <br>
            <nav>
                <label class="radio-inline">
                    <input type="radio" value="true" name="congelado">Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" value="false" name="congelado" checked>Não
                </label>
            </nav>
            <br>
            Encerrado: <span style="color:red;">*</span>
            <br>
            <nav>
                <label class="radio-inline">
                    <input type="radio" value="true" name="encerrado">Sim
                </label>
                <label class="radio-inline">
                    <input type="radio" value="false" name="encerrado" checked>Não
                </label>
            </nav>
            <br>
        </div>
        <input type="submit" class="btn btn-default btn-md" value="Cadastrar">
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
                            <div class="form-group">
                                Nome:
                                <input id="nome_pessoa" name="nome_pessoa" type="text" class="form-control">
                            </div>   
                            <div class="form-group">
                                CPF:
                                <input id="cpf_pessoa" name="cpf_pessoa" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                Passaporte:
                                <input id="pass_pessoa" name="pass_pessoa" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                Telefone: 
                                <input id="telefone_pessoa" name="telefone_pessoa" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                Email:
                                <input id="email_pessoa" name="email_pessoa" type="email" class="form-control">
                            </div>
                        </nav>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submitFormData" onclick="SubmitFormData()" data-dismiss="modal">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    var input = document.getElementById("submitFormData");

    // Execute a function when the user releases a key on the keyboard
    input.addEventListener("keydown", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("submitFormData").click();
    }
    });

    function SubmitFormData() {
        var nome_pessoa = $("#nome_pessoa").val();
        var email_pessoa = $("#email_pessoa").val();
        var telefone_pessoa = $("#telefone_pessoa").val();
        var cpf_pessoa = $("#cpf_pessoa").val();
        var pass_pessoa = $("#pass_pessoa").val();
        
        $.post("processa_cadastrar_pessoa.php", { nome_pessoa: nome_pessoa, email_pessoa: email_pessoa,
            telefone_pessoa: telefone_pessoa, cpf_pessoa: cpf_pessoa, pass_pessoa:pass_pessoa },
        function(data) {
         //$('#results').html(data);
         //$('#myForm')[0].reset();
        });
    }
    </script>


</div>
</div>
