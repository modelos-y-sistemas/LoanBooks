<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/main.css">
    <title>Buscar y Recibir</title>
</head>
<body>
    <section class="container-section">
        <div class="container-buttons">
            <div class="box-1">
                <button href="">Buscar y Recibir</button>
                <button href="">Prestar</button>
                <button href="">Registrar</button>
            </div>
            <div class="box-2">
                <button href="">Salir</button>
            </div>
        </div>
        
        <div class="user-name" id="user-name">¡Hola, Edith! :)</div>
        <h1 class="title">Prestar Libros</h1>
        
        <article class="container-menu">
            <ul class="options">
                <li id="alumne">
                    <a href="#alumne">Alumne</a>
                    <ul>
                        <li>
                            <div class="inputs">
                                <input type="text" placeholder="Codigo">
                                <input type="text" placeholder="Nombre">
                            </div>
                            
                            <div class="inputs">
                                <input type="text" placeholder="Apellido">
                                <input type="text" placeholder="DNI">
                            </div>
                            
                            <div class="inputs">
                                <input type="text" placeholder="Telefono">
                                <select name="Curso" id="Curso">
                                    <option value="1">Opcion 1</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <li id="libro">
                    <a href="#libro">Libro</a>
                    <ul>
                        <div class="inputs">
                            <input type="text" placeholder="Nombre">
                            <input type="text" placeholder="Categoria">
                            
                            <div class="order-label">
                                <label for="#Egreso">Fecha de Egreso</label>
                                <input type="date" id="Egreso" name="Egreso">
                            </div>
                            
                            <div class="order-label">
                                <label for="#Regreso">Fecha de Regreso</label>
                                <input type="date" id="Regreso" name="Regreso">
                            </div>
                        </div>
                    </ul>
                </li>
                
                <li id="profesore">
                    <a href="#profesore">Profesore</a>
                    <ul>
                        <div class="box-inputs">
                            <div class="inputs">
                                <input type="text" placeholder="Nombre">
                                <input type="text" placeholder="DNI">
                            </div>
                            
                            <div class="inputs">
                                <input type="text" placeholder="Apellido">
                                <input type="text" placeholder="Telefono">
                                <input type="text" placeholder="Codigo">
                            </div>
                        </ul>
                    </li>
                </ul>
            </article>
        </section>
        
        <section class="container-table">
            <article class="table">
                <div class="div1 title-col"> Nombre y Apellido</div>
                <div class="div2 "> </div>
                <div class="div3"> </div>
                <div class="div4"> </div>
                <div class="div5 title-col">Rol</div>
                <div class="div6"> </div>
                <div class="div7"> </div>
                <div class="div8"> </div>
                <div class="div9 title-col">Libro</div>
                <div class="div10"> </div>
                <div class="div11"> </div>
                <div class="div12"> </div>
                <div class="div13 title-col">Categoria</div>
                <div class="div14"> </div>
                <div class="div15"> </div>
                <div class="div16"> </div>
                <div class="div17 title-col">Cantidad</div>
                <div class="div18"> </div>
                <div class="div19"> </div>
                <div class="div20"> </div>
                <div class="div21 title-col">Curso</div>
                <div class="div22"> </div>
                <div class="div23"> </div>
                <div class="div24"> </div>
                <div class="div25 title-col">Fecha</div>
                <div class="div26"> </div>
                <div class="div27"> </div>
                <div class="div28"> </div>
                <div class="div29 title-col">Devuelto</div>
                <div class="div30"> </div>
                <div class="div31"> </div>
                <div class="div32"> </div>
                <div class="div33 title-col">Bibliotecarie</div>
                <div class="div34"> </div>
                <div class="div35"> </div>
                <div class="div36"> </div>
    </article>
</section>

<div class="footer">
    <button class="btn">Entregaron</button>

    <div class="boxes">
        <div class="box-number">1</div>
        <div class="box-number">2</div>
        <div class="box-number">3</div>
        <div class="box-number">4</div>
    </div>
    

    <button class="btn">Buscar</button>
</div>

</body>
</html>