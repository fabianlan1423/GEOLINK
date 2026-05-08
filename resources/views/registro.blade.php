<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>GEOLIK REGISTRO</title>
</head>
<body class="bod">

    <div style="display: flex; justify-content: center; margin-top: 10%;">
        <div class="cuadroregistro">
            <div class="cuadro50porcen"><!--INGRESO-->
                <div style="width: 90%; justify-items: center; align-content: center;">
                    <div style="width: 50%">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="usuario" placeholder="Usuario">
                            <label for="usuario">Usuario</label>
                        </div>
                    </div>
                    <div style="width: 50%">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Password" placeholder="Password">
                            <label for="Password">Password</label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="cuadro50porcen"><!--REGISTRO USUARIO-->

            </div>
        </div>
    </div>
    <!--<a href="{{route('welcome')}}">link</a> forma de llamar a un hipervinculo dentro de laravel -->
</body>
</html>