<?php
    include 'database.php';

    $id_ocorrencia = $_GET['id'];

    $query = "SELECT * FROM ocorrencia WHERE id_ocorrencia = $id_ocorrencia";
    $result = pg_query($connection, $query) or die(pg_last_error());
    $linhaOcorrencia = pg_fetch_array($result, 0);

    if($linhaOcorrencia['ocorr_endereco_principal'] == "Logradouro"){
        $id_logradouro = $linhaOcorrencia['ocorr_logradouro_id'];
        $query = "SELECT * FROM endereco_logradouro WHERE id_logradouro = $id_logradouro";
        $result = pg_query($connection, $query) or die(pg_last_error());
        $linhaLogradouro = pg_fetch_array($result, 0);
    }
    
    $id_agente = $linhaOcorrencia['agente_principal'];
    $query = "SELECT nome FROM usuario WHERE id_usuario = $id_agente";
    $result = pg_query($connection, $query) or die(pg_last_error());
    $linhaAgentePrincipal = pg_fetch_array($result, 0);

    if($linhaOcorrencia['agente_apoio_1']){
        $id_agente = $linhaOcorrencia['agente_apoio_1'];
        $query = "SELECT nome FROM usuario WHERE id_usuario = $id_agente";
        $result = pg_query($connection, $query) or die(pg_last_error());
        $linhaAgente1 = pg_fetch_array($result, 0);
    }
    if($linhaOcorrencia['agente_apoio_2']){
        $id_agente = $linhaOcorrencia['agente_apoio_2'];
        $query = "SELECT nome FROM usuario WHERE id_usuario = $id_agente";
        $result = pg_query($connection, $query) or die(pg_last_error());
        $linhaAgente2 = pg_fetch_array($result, 0);
    }
    if($linhaOcorrencia['atendido_1']){
        $id_pessoa = $linhaOcorrencia['atendido_1'];
        $query = "SELECT nome FROM pessoa WHERE id_pessoa = $id_pessoa";
        $result = pg_query($connection, $query) or die(pg_last_error());
        $linhaPessoa1 = pg_fetch_array($result, 0);
    }
    if($linhaOcorrencia['atendido_2']){
        $id_pessoa = $linhaOcorrencia['atendido_2'];
        $query = "SELECT nome FROM pessoa WHERE id_pessoa = $id_pessoa";
        $result = pg_query($connection, $query) or die(pg_last_error());
        $linhaPessoa2 = pg_fetch_array($result, 0);
    }

    $cobrade = $linhaOcorrencia['ocorr_cobrade'];
    $query = "SELECT * FROM cobrade WHERE codigo = '$cobrade'";
    $result = pg_query($connection, $query) or die(pg_last_error());
    $linhaCobrade = pg_fetch_array($result, 0);
?>

<div class="container positioning">
<div class="jumbotron campo_cadastro">
    <?php if(isset($_GET['sucesso'])){ ?>
            <div class="alert alert-success" role="alert">
                Ocorrencia alterada com sucesso.
            </div>
    <?php } ?>
    <div class="box">
        <p>Endereços</p>
        <nav>
            Endereço principal: <span id="coordenada_principal" ng-model="sel_endereco" ng-init="sel_endereco='<?php echo $linhaOcorrencia['ocorr_endereco_principal']; ?>'"><?php echo $linhaOcorrencia['ocorr_endereco_principal']; ?></span>
        </nav>
        <div ng-show="sel_endereco == 'Logradouro'">
            <nav>
                Logradouro: <span id="logradouro"><?php echo $linhaLogradouro['logradouro'];?></span>
            </nav>
            <nav>
                Endereço numeral: <span id="numero" ><?php echo $linhaLogradouro['numero']; ?></span>
            </nav>
            <nav>
                Endereço referência: <span id="referencia" ><?php echo $linhaLogradouro['referencia']; ?></span>
            </nav>
        </div>
        <div ng-show="sel_endereco == 'Coordenada'">
            <nav>
                Latitude: <span id="latitude" ><?php echo $linhaOcorrencia['ocorr_coordenada_latitude']; ?></span>
            </nav>
            <nav>
                Longitude: <span id="longitude" ><?php echo $linhaOcorrencia['ocorr_coordenada_longitude']; ?></span>
            </nav>
        </div>
    </div>
    <div class="box">
        <p>Agentes</p>
        <nav>
            Agente principal: <span id="agente_principal" ><?php echo $linhaAgentePrincipal['nome']; ?></span>
        </nav>
        <nav>
            Agente de apoio 1: <span id="agente_apoio_1" ><?php echo $linhaAgente1['nome']; ?></span>
        </nav>
        <nav>
            Agente de apoio 2: <span id="agente_apoio_2" ><?php echo $linhaAgente2['nome']; ?></span>
        </nav>
    </div>
    <div class="box">
        <p>Ocorrencia</p>
        <nav>
            Ocorrência retorno: <span id="ocorr_retorno"><?php echo ($linhaOcorrencia['ocorr_retorno'] == t) ? 'Sim' : 'Não'; ?></span>
        </nav>
        <nav>
            Código de referência: <span id="ocorr_referencia"><?php echo $linhaOcorrencia['ocorr_referencia']; ?></span>
        </nav>
        <nav>
            Data de lançamento: <span id="data_lancamento" value="<?php echo $linhaOcorrencia['data_lancamento'];?>">
            <?php 
                echo date("d/m/Y", strtotime($linhaOcorrencia['data_lancamento']));
            ?>
            </span>
        </nav>
        <nav>
            Data de ocorrência: <span id="data_ocorrencia" value="<?php echo $linhaOcorrencia['data_ocorrencia']; ?>">
            <?php 
                echo date("d/m/Y", strtotime($linhaOcorrencia['data_ocorrencia']));
            ?>
            </span>
        </nav>
        <nav>
            Descrição: <span id="ocorr_descricao"><?php echo $linhaOcorrencia['ocorr_descricao']; ?></span>
        </nav>
        <nav>
            Origem: <span id="ocorr_origem"><?php echo $linhaOcorrencia['ocorr_origem']; ?></span>
        </nav>
    </div>

    <div class="box">
        <p>Atentidos</p>
        <nav>
            Pessoa atendida 1: <span id="atendido_1"><?php echo $linhaPessoa1['nome']; ?></span>
        </nav>
        <nav>
            Pessoa atendida 2: <span id="atendido_2"><?php echo $linhaPessoa2['nome']; ?></span>
        </nav>
    </div>

    <div class="box">
        <p>Tipo</p>
        <nav>
            Cobrade: <span id="ocorr_cobrade"><?php echo $linhaCobrade['subgrupo']; ?></span>
        </nav>
        <nav>
            Natureza da ocorrência: <span id="ocorr_natureza"><?php echo $linhaOcorrencia['ocorr_natureza']; ?></span>
        </nav>
        <nav>
            Possui fotos: <span id="fotos"><?php echo ($linhaOcorrencia['ocorr_fotos'] == t) ? 'Sim':'Não'; ?></span>
        </nav>
    </div>
    <div class="box">
        <p>Status</p>
        <nav>
            Prioridade: <span id="ocorr_prioridade"><?php echo $linhaOcorrencia['ocorr_prioridade']; ?></span>
        </nav>
        <nav>
            Analisado: <span id="ocorr_analisado"><?php echo ($linhaOcorrencia['ocorr_analisado'] == t) ? 'Sim':'Não'; ?></span>
        </nav>
        <nav>
            Congelado: <span id="ocorr_congelado"><?php echo ($linhaOcorrencia['ocorr_congelado']== t) ? 'Sim':'Não'; ?></span>
        </nav>
        <nav>
            Encerrado: <span id="ocorr_encerrado"><?php echo ($linhaOcorrencia['ocorr_encerrado']== t) ? 'Sim':'Não'; ?></span>
        </nav>
    </div>
    <form action="index.php?pagina=editarOcorrencia" method="post">
        <input name="id_ocorrencia" type="hidden" value="<?php echo $id_ocorrencia; ?>">
        <input name="endereco_principal" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_endereco_principal']; ?>">
        <input name="cep" type="hidden" value="<?php echo $linhaLogradouro['cep']; ?>">
        <input name="cidade" type="hidden" value="<?php echo $linhaLogradouro['cidade']; ?>">
        <input name="bairro" type="hidden" value="<?php echo $linhaLogradouro['bairro']; ?>">
        <input name="logradouro" type="hidden" value="<?php echo $linhaLogradouro['logradouro']; ?>">
        <input name="numero" type="hidden" value="<?php echo $linhaLogradouro['numero'] ?>">
        <input name="referencia" type="hidden" value="<?php echo $linhaLogradouro['referencia']; ?>">
        <input name="latitude" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_coordenada_latitude']; ?>">
        <input name="longitude" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_coordenada_longitude']; ?>">
        <input name="agente_principal" type="hidden" value="<?php echo $linhaAgentePrincipal['nome']; ?>">
        <input name="agente_apoio1" type="hidden" value="<?php echo $linhaAgente1['nome']; ?>">
        <input name="agente_apoio2" type="hidden" value="<?php echo $linhaAgente2['nome']; ?>">
        <input name="ocorr_retorno" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_retorno']; ?>">
        <input name="ocorr_referencia" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_referencia']; ?>">
        <input name="data_lancamento" type="hidden" value="<?php echo $linhaOcorrencia['data_lancamento']; ?>">
        <input name="data_ocorrencia" type="hidden" value="<?php echo $linhaOcorrencia['data_ocorrencia']; ?>">
        <input name="ocorr_descricao" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_descricao']; ?>">
        <input name="ocorr_origem" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_origem']; ?>">
        <input name="pessoa1" type="hidden" value="<?php echo $linhaPessoa1['nome']; ?>">
        <input name="pessoa2" type="hidden" value="<?php echo $linhaPessoa2['nome']; ?>">
        <input name="ocorr_cobrade" type="hidden" value="<?php echo $linhaCobrade['codigo']; ?>">
        <input name="possui_foto" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_fotos']; ?>">
        <input name="prioridade" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_prioridade']; ?>">
        <input name="analisado" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_analisado']; ?>">
        <input name="congelado" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_congelado']; ?>">
        <input name="encerrado" type="hidden" value="<?php echo $linhaOcorrencia['ocorr_encerrado']; ?>">
        <input type="submit" class="btn btn-default btn-md" value="Editar">
    </form>
</div>
</div>