    <footer>
        <div class="container">
            <?php if(!isset($_SESSION['login'])){ ?>
                <span class="text-left footer">Telefone: (47) 3268-3133</span>
                <span class="footer">Endereço: Alameda dos Estados Policial Luiz Carlos Rosa, 25 - Estados, Balneário Camboriú - SC</span>
            <?php } ?>
        </div>
    </footer>
    
    </div>
    </div>
    <!--<script src="angular/angular.js"></script>-->
    <script src="javascript/main.js"></script>
    <script>
        if(window.location.href == "http://localhost/aplicacao/index.php?pagina=visualizarSensores"){
            ativaJson();
            setInterval(function(){ ativaJson(); }, 3600000);
        }
        if(window.location.href == "http://localhost/aplicacao/index.php?pagina=monitorarChamado"){
            monitorarChamado();
            setInterval(function(){ monitorarChamado(); }, 60000);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAu6rNYe4C_omXFiKMY6DuCk6wgklzLInY&callback=myMap"></script>
</body>
</html>