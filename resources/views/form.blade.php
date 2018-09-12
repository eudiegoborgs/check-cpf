<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check CPF</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: linear-gradient(135deg, rgba(85,239,203,1) 0%,rgba(30,87,153,1) 0%,rgba(85,239,203,1) 0%,rgba(91,202,255,1) 100%);
            width: 100vw;
            height: 100vh;
            font-family: 'Roboto', sans-serif;
            transition: ease all 0.5s;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
            flex-wrap: wrap;
            width: 60vw;
            max-width: 400px;
            margin: 0 auto;
            min-height: 100vh;
            color: white;
            text-transform: uppercase;
        }

        h1 {
            font-size: 3rem;
            width: 100%;
            text-align: center;
        }

        .input {
            width: 100%;
            max-width: 400px;
            background: transparent;
            border: transparent;
            border-bottom: solid 1px white;
            color: white;
            padding: 10px 20px;
            font-size: 2rem;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            margin: 0 auto;
        }

        .input:focus {
            outline: none;
        }

        .button {
            width: 100%;
            max-width: 400px;
            background: transparent;
            border: solid 1px white;
            color: white;
            padding: 10px 20px;
            font-size: 1.5rem;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            margin: 30px auto;
            color: white;
            cursor: pointer;
            text-transform: uppercase;
            transition: ease all 0.5s;
        }

        .button:hover {
            background: white;
            color: rgba(91,202,255,1);
        }

        #state {
            width: 100%;
            text-align: center;
            font-size: 2.5rem;
        }

        #alert {
            width: 100%;
            text-align: center;
        }

        body.block {
            background: #282537;
            background-image: -webkit-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: -moz-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: -o-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            background-image: radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
            transition: ease all 0.5s;
        }
        body.error {
            background: #282537;
            background-image: linear-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);
            background-image: -webkit-radial-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);
            background-image: -moz-radial-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);
            background-image: -o-radial-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);
            background-image: radial-gradient(90deg, #FF9A8B 0%, #FF6A88 55%, #FF99AC 100%);
            transition: ease all 0.5s;
        }
        body.free {
            background: #282537;
            background-image: linear-gradient(90deg, #05974A 0%, #F2E51E 100%);
            background-image: -webkit-radial-gradient(90deg, #05974A 0%, #F2E51E 100%);
            background-image: -moz-radial-gradient(90deg, #05974A 0%, #F2E51E 100%);
            background-image: -o-radial-gradient(90deg, #05974A 0%, #F2E51E 100%);
            background-image: radial-gradient(90deg, #05974A 0%, #F2E51E 100%);
            transition: ease all 0.5s;
        }
    </style>
</head>
<body>
    <form class="container">
        <h1>Consulte o CPF</h1>
        <input type="text" name="cpf" class="input cpf mask">
        <button class="button" type="submit">Enviar</button>
        <div id="state"></div>
        <div id="alert"></div>
    </form>
    <script src="{{ asset('js/mask.min.js') }}"></script> 
    <script>
        VMasker(document.querySelector(".mask.cpf")).maskPattern("999.999.999-99");
        document.querySelector("form").addEventListener('submit', function(event){
            event.preventDefault();
            var inputCPF = document.getElementsByName('cpf').item(0);
            var cpf = inputCPF.value;

            var ajax = new XMLHttpRequest();

            // Seta tipo de requisição e URL com os parâmetros
            ajax.open("GET", "{{ route('check-cpf') }}?cpf=" + cpf, true);

            // Envia a requisição
            ajax.send();

            // Cria um evento para receber o retorno.
            ajax.onreadystatechange = function() {

            console.log(ajax);
            
            // Caso o state seja 4 e o http.status for 200, é porque a requisiçõe deu certo.
                if (ajax.readyState == 4 && (ajax.status == 200 || ajax.status == 422)) {
                
                    var data = JSON.parse(ajax.responseText);
                    console.log(data);
                    
                    document.getElementById("state").innerHTML = data.state;
                    document.getElementById("alert").innerHTML = data.message;
                    document.querySelector("body").className = data.state;

                }
            }
        });
    </script>
</body>
</html>