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
            transition: ease all 1s;
        }

        .button:hover {
            background: white;
            color: rgba(91,202,255,1);
        }
    </style>
</head>
<body>
    <form class="container">
        <h1>Check CPF</h1>
        <input type="text" name="cpf" class="input cpf mask">
        <button class="button" type="submit">Enviar</button>
    </form>
</body>
</html>