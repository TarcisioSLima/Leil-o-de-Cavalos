<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quarter Horse</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/bc42253982.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.t_header{
    background-color: #282e09;
}

.t_header ul {
    list-style: none; /* Remove marcadores de lista */
    margin: 0; /* Remove margens padrão */
    padding: 0; /* Remove padding padrão */
    display: flex; /* Define o display como flexbox */
}

.t_header li {
    margin-right: 10px; /* Adiciona espaço entre os itens da lista */
}

.t_header li:last-child { 
    margin-right: 0; 
}
.t_header li:first-child { 
    margin-left: 10px; 
}

.t_header a {
    display: block; 
    padding: 10px 15px; 
    background-color:#282e09; 
    color: #b6ab9e; 
    text-decoration: none; 
    border-radius: 5px; 
}

.t_header a:hover {
    background-color: #53422a; /* Cor de fundo ao passar o mouse */
}    

body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
}

.header {
    background-color: #b6ab9e;
    color: white;
    padding: 5px 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.header .auth-buttons button {
    background-color: #282e09;
    color: #b6ab9e;
    border: none;
    padding: 10px 15px;
    margin-left: 10px;
    cursor: pointer;
    border-radius: 0.25rem;
}

.header .auth-buttons button:hover {
    background-color: #191c06;
    
}

.main-content {
    padding: 20px;
    display: flex;
    gap: 20px;
}

.search-container {
  display: flex;
  width: 300px; 
  border-radius: 10px;
  overflow: hidden;
  background-color: #282e09 ;
  color: #b6ab9e;
}
.search-box {
  padding: 10px;
  border: none;
  width: 100%;
  font-size: 16px;
  background-color: transparent;
  
}

.search-box::placeholder {
  color: #b6ab9e; 
}

.search-button {
  background-color: transparent;
  border: none;
  padding: 10px;
  cursor: pointer;
}

.search-icon {
  width: 20px; 
  color: #b6ab9e; 
}

.u_categorias {
    display: flex;
    flex-direction: column;
    width: 300px;
    margin: 10%;
    padding-top: 0;
    list-style: none;
    border: 1px solid rgb(210, 209, 209); 
    background-color: rgb(247, 247, 247);
    border-radius: 10px;
    overflow: hidden;
}

.u_categorias a {
    text-decoration: none;
    color: #191c06;
    display: flex;
    align-items: center;
    padding: 15px 20px; 
    border-bottom: 1px solid rgb(210, 209, 209);
     
}

.u_categorias i {
    margin-right: 6px; 
    font-size: 1.0em; 
    padding: 0;
}

.img_i {
    max-width: 100%;
    border-radius: 10px;
    
    
}
.search-container {
    display: flex;
    align-items: center;
}

.main-content {
    width: 75%; 
    padding: 0;
    margin-left: 10%;
}

.card_categorias{
    width: 25%;
    
}

.container {
    display: flex;
    max-width: 1200px; 
    margin: 0 auto; 
    padding: 20px;
    
}

.lotes {
    display: flex;
    align-items: center;
}
.lotes div{
    margin-left: 2%;    
}

.ul_numeros {
    list-style: none;
    display: flex;
}

.ul_numeros li {
    margin-right: 50px;
}

.lotes {
    text-align: left;
    
}
p {
    margin-left: 10px;
}

.lotes ul {
    list-style: none;
    display: flex;
    margin-right: 10px;
    text-align: center;
    flex-direction: column;
    
}
.uls {
    display: flex;
    
    
}

.nuns {
    font-size: 30px;
}

.ls {
    border: solid 2px rgb(216, 216, 216);
    border-radius: 5px;
}
.u_categorias li:hover{
    background-color: #dedddd;
}

    </style>
</head>
<body>
    <header class="header">
        <div class="logo" >
           <img src="assets/img/logo_verde.png" alt="" style="max-width: 200px; max-height: 200px;">
        </div>

        <div class="search-container">
            <input type="text" placeholder="Pesquisar..." class="search-box">
            <button type="submit" class="search-button">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </button>
          </div>
            

        
        <div class="auth-buttons">
            <button id="button1" class="" onmouseover="animate_y1()" onmouseout="animate_n1()"><i class="fa-solid fa-user-check"></i> Login</button>
            <button id="button2" class="" onmouseover="animate_y2()" onmouseout="animate_n2()"><i class="fa-solid fa-user-plus"></i> Cadastrar-se</button>
        </div>
       
    </header>

    <div class="t_header">
        <ul>
            <li><a href="#">Início</a></li>
            <li><a href="#">Quem Somos</a></li>
            <li><a href="#">Anunciar</a></li>
        </ul>
    </div>

    <div class="container"> 
        
            <div class="card_categorias">
                <ul class="u_categorias">
                    <li><a href="#"><i class="fa-solid fa-box"></i>Categoria de exemplo 1</a></li>
                    <li><a href="#"><i class="fa-solid fa-litecoin-sign"></i>Categoria de exemplo 2</a></li>
                    <li><a href="#"><i class="fa-solid fa-volleyball"></i>Categoria de exemplo 3</a></li>
                    <li><a href="#"><i class="fa-solid fa-horse"></i>Categoria de exemplo 4</a></li>
                    <li><a href="#"><i class="fa-solid fa-display"></i>Categoria de exemplo 5</a></li>
                    <li><a href="#"><i class="fa-solid fa-person"></i>Categoria de exemplo 6</a></li>  
                </ul>
            </div>


        <div class="main-content"> 
            <img src="assets/img/test.png" alt="" class="img_i"> 
        </div>
    </div>

    <div class="lotes">
        <div class="ls">
            <img src="assets/img/horse.jpg" alt=""> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 1
            </h4> <br>
            <hr><br>
            <p>R$ 12.000,00</p>
            <br>
            <hr>
        <div class="uls">
                <ul class="ul_dias">
                    <li class="nuns">4</li>
                    <li>Dias</li>
                </ul>
                <ul class="ul_horas">
                    <li class="nuns">7</li>
                    <li>Horas</li>
                </ul>
                <ul class="ul_minutos">       
                    <li class="nuns">40</li>
                    <li>Minutos</li>
                </ul>
                <ul class="ul_segundos">
                    <li class="nuns">10</li>
                    <li>Segundos</li>
                </ul>
            
        </div>
        
        </div>
        <div class="ls">
            <img src="assets/img/horse.jpg" alt=""> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 2
            </h4>
            <br><hr>
            <br>
            <p>R$ 4.700,00</p>
            <br><hr>
        <div class="uls">

            <ul class="ul_dias">
                <li class="nuns">4</li>
                <li>Dias</li>
            </ul>
            <ul class="ul_horas">
                <li class="nuns">7</li>
                <li>Horas</li>
            </ul>
            <ul class="ul_minutos">       
                <li class="nuns">40</li>
                <li>Minutos</li>
            </ul>
            <ul class="ul_segundos">
                <li class="nuns">10</li>
                <li>Segundos</li>
            </ul>
        </div>
        

        </div>
        <div class="ls">
            <img src="assets/img/horse.jpg" alt=""> <br>
            <hr> <br>
            <h4>
                Item de Exemplo 3
            </h4>
            <br> <hr><br>
            <p>R$ 9.000,00</p>
            <br><hr>
            <div class="uls">
                <ul class="ul_dias">
                    <li class="nuns">4</li>
                    <li>Dias</li>
                </ul>
                <ul class="ul_horas">
                    <li class="nuns">7</li>
                    <li>Horas</li>
                </ul>
                <ul class="ul_minutos">       
                    <li class="nuns">40</li>
                    <li>Minutos</li>
                </ul>
                <ul class="ul_segundos">
                    <li class="nuns">10</li>
                    <li>Segundos</li>
                </ul>
            </div>
               
        </div>
        <div class="ls">
                <img src="assets/img/horse.jpg" alt=""> <br> <hr> <br>
                <h4>
                    Item de Exemplo 4
                </h4>
                <br> <hr><br>
                <p>R$ 4.000,00</p>
                <br><hr>
                <div class="uls">
                    <ul class="ul_dias">
                        <li class="nuns">4</li>
                        <li>Dias</li>
                    </ul>
                    <ul class="ul_horas">
                        <li class="nuns">7</li>
                        <li>Horas</li>
                    </ul>
                    <ul class="ul_minutos">       
                        <li class="nuns">40</li>
                        <li>Minutos</li>
                    </ul>
                    <ul class="ul_segundos">
                        <li class="nuns">10</li>
                        <li>Segundos</li>
                    </ul>
                </div>
                
        </div>
            
    </div>
<br><br><br><br><br><br>



    <script>
        function animate_y1() {
            document.getElementById("button1").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n1() {
            document.getElementById("button1").classList.remove('animate__animated', 'animate__pulse')
        }
        function animate_y2() {
            document.getElementById("button2").classList.add('animate__animated', 'animate__pulse')
        }
        function animate_n2() {
            document.getElementById("button2").classList.remove('animate__animated', 'animate__pulse')
        }
    </script>
</body>
</html>
