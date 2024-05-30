<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de texto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

        /* Estilo para los elementos generales */
        #add-interest,
        #add-hobby {
            background-color: #28a745;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #add-interest .bi-plus,
        #add-hobby .bi-plus {
            color: white;
        }
        .navbar-link {
    display: none;
}
        .btn-remove {
            background-color: #C2185B;
            color: white;
            border: none;
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove svg {
            width: 30px;
            height: 30px;
        }

        #add-interest-container,
        #add-hobby-container {
            display: flex;
            justify-content: center;
        }

        #generate-text-btn {
            background-color: rgba(168, 25, 101, 255);
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            text-align: center;
            display: block;
            margin-top: 30px !important;
            width: 100%;
            max-width: 430px;
            margin: 0 auto;
        }

        /* Estilo para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            position: relative;
            border-radius: 0;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            margin-left: auto;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .copy-text {
            color: white;
            background-color: #218838;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .copy-text:hover,
        .copy-text:focus {
            background-color: #1e7e34;
            outline: none;
        }

        #nav-primarys{
            margin-left: 13% !important;
        }
        .copy-text svg {
            margin-right: 8px;
        }

        .btn-close-bottom {
            background-color: rgba(189, 158, 134, 255);
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .btn-close-bottom:hover,
        .btn-close-bottom:focus {
            background-color: #5a6268;
            outline: none;
        }


        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
            border-bottom: 1px solid #e5e5e5;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 18px;
            color: black;
            font-weight: bold;
        }

        .modal-body {
            padding: 10px 0;
        }

        .modal-footer {
            padding: 5px;
            text-align: right;
            border-top: 1px solid #e5e5e5;
            margin-top: 10px;
            border-bottom: none;
        }

        .modal-footer .btn {
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        /* Estilo para el footer */
        /* Estilo para el footer */
        .footer {
            background-color: #bd9e86;
            color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            z-index: 1060;
        }


        /* Estilo responsivo */
        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
            }
            #nav-primarys{
            margin-left: 1% !important;
        }

            #generate-text-btn {
                width: 80%;
            }

            .form-label {
                font-size: 12px;
            }

            .footer {
                font-size: 12px;
                padding: 8px 0;
            }
        }
        @media (max-width: 992px) {
            #hidden {
                display: none;
            }

            #nav-primarys{
                margin-left: 0px% !important;
            }

        }

        @media (max-width: 576px) {
            .modal-content {
                width: 95%;
            }

  
            #generate-text-btn {
                width: 80%;
                margin: 0 auto;
                margin-bottom: 100px !important;
            }

            .form-label {
                font-size: 10px;
            }

            .footer {
                font-size: 10px;
                padding: 6px 0;
            }

            .row.mb-3.align-items-center {
                display: block;
            }

            .col {
                width: 100%;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" id="nav-primarys" style="" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="30" height="30" class="me-2">
                <span>Generador de texto</span>
            </a>

            <a class="nav-link" id="hidden" style="margin-left: 2% !important;" href="#">Contacto</a>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="hidden" style="margin-left: 40% !important;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Nombre de cuenta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Acción</a></li>
                        <li><a class="dropdown-item" href="#">Otra acción</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Algo más aquí</a></li>
                    </ul>
                </li>
            </ul>

            <button class="navbar-toggler" id="navbar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" id="navbar-link" href="#">Contacto</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-link">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Nombre de cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Acción</a></li>
                            <li><a class="dropdown-item" href="#">Otra acción</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Algo más aquí</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Generador de texto</h1>
        <p>Completa tus datos personales para rellenar automáticamente un texto de presentación.</p>
        <form id="generador-form">
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </span>
                        <input type="text" class="form-control border-start-0" id="nombre" placeholder="" required>
                    </div>
                </div>
                <div class="col">
                    <label for="apellidos" class="form-label">Apellido(s) *</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </span>
                        <input type="text" class="form-control border-start-0" id="apellidos" placeholder="" required>
                    </div>
                </div>
                <div class="col">
                    <label for="correo" class="form-label">Correo electrónico *</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-envelope" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg>
                        </span>
                        <input type="email" class="form-control border-start-0" id="correo" placeholder="" required>
                    </div>
                </div>

                <div class="col">
                    <label for="telefono" class="form-label">Teléfono *</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telephone" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.123-.58L3.654 1.328zM1.885.511a1.745 1.745 0 0 1 2.615.163l1.795 2.308c.422.544.563 1.254.383 1.912l-.548 2.19a.75.75 0 0 0 .197.71l2.852 2.852a.75.75 0 0 0 .71.197l2.19-.548a1.745 1.745 0 0 1 1.911.383l2.308 1.794a1.745 1.745 0 0 1 .163 2.615l-1.034 1.035a2.678 2.678 0 0 1-2.856.684 18.6 18.6 0 0 1-7.01-4.418A18.6 18.6 0 0 1 .2 4.456 2.678 2.678 0 0 1 .885.511z" />
                            </svg>
                        </span>
                        <input type="tel" class="form-control border-start-0" id="telefono" placeholder=""
                            pattern="[0-9]*" required>
                    </div>
                </div>


                <!-- Interests Section -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="intereses" class="form-label">Áreas de interés laboral (min. 1)*</label>
                        <div id="intereses-container">
                            <div class="input-group mb-2" id="interes-1">
                                <span class="input-group-text bg-white border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-list-ul" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control border-start-0" name="intereses[]"
                                    placeholder="">
                            </div>
                        </div>
                        <div id="add-interest-container">
                            <button type="button" class="btn btn-success rounded-circle" id="add-interest">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a.5.5 0 0 1 .5.5V7h5.5a.5.5 0 0 1 0 1H8v5.5a.5.5 0 0 1-1 0V8H1.5a.5.5 0 0 1 0-1H7V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Hobbies Section -->
                    <div class="col">
                        <label for="hobbies" class="form-label">Hobbies (min. 1)*</label>
                        <div id="hobbies-container">
                            <div class="input-group mb-2" id="hobby-1">
                                <span class="input-group-text bg-white border-end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-list-ul" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control border-start-0" name="hobbies[]" placeholder="">
                            </div>
                        </div>
                        <div id="add-hobby-container">
                            <button type="button" class="btn btn-success rounded-circle" id="add-hobby">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a.5.5 0 0 1 .5.5V7h5.5a.5.5 0 0 1 0 1H8v5.5a.5.5 0 0 1-1 0V8H1.5a.5.5 0 0 1 0-1H7V1.5A.5.5 0 0 1 8 1z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" id="generate-text-btn">Generar texto</button>
        </form>

        <div id="texto-generado" class="mt-4">
            <!-- El texto generado aparecerá aquí -->
        </div>
    </div>

    <!-- Modal para mostrar el texto generado -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Texto generado</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p id="modal-text"></p>
            </div>
            <div class="modal-footer">
                <button class="btn copy-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clipboard" viewBox="0 0 16 16">
                        <path
                            d="M10 1.5v1h2a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1h2v-1a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1zM9 0H7a1 1 0 0 0-1 1v1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-1-1zm0 3H7v-1h2v1z" />
                    </svg>
                    Copiar texto
                </button>
                <button class="btn btn-close-bottom">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>Sitio de prueba realizado por Ignacio Cabello</span>
        </div>
    </footer>





    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggler = document.querySelector('.navbar-toggler');
        const navbarNav = document.querySelector('#navbarNav');

        toggler.addEventListener('click', function () {
            navbarNav.classList.toggle('show');
            document.querySelectorAll('.navbar-link').forEach(link => {
                link.classList.toggle('show-links');
            });
        });
    });
        document.addEventListener('DOMContentLoaded', function () {
            let interestCount = 1;
            let hobbyCount = 1;

            document.getElementById('add-interest').addEventListener('click', function () {
                interestCount++;
                const newInterestField = document.createElement('div');
                newInterestField.classList.add('input-group', 'mb-2');
                newInterestField.id = `interes-${interestCount}`;
                newInterestField.innerHTML = `
            <span class="input-group-text bg-white border-end-0 rounded-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
            </span>
            <input type="text" class="form-control border-start-0 custom-rounded" name="intereses[]" placeholder="Interés">
            <button type="button" class="btn btn-remove" style="border-radius: 0 100px 100px 0 !important;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        `;
                document.getElementById('intereses-container').appendChild(newInterestField);
            });

            document.getElementById('intereses-container').addEventListener('click', function (event) {
                if (event.target.classList.contains('btn-remove') || event.target.closest('.btn-remove')) {
                    const interestField = event.target.closest('.input-group');
                    interestField.remove();
                }
            });

            document.getElementById('add-hobby').addEventListener('click', function () {
                hobbyCount++;
                const newHobbyField = document.createElement('div');
                newHobbyField.classList.add('input-group', 'mb-2');
                newHobbyField.id = `hobby-${hobbyCount}`;
                newHobbyField.innerHTML = `
            <span class="input-group-text bg-white border-end-0 rounded-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
            </span>
            <input type="text" class="form-control border-start-0 custom-rounded" name="hobbies[]" placeholder="Hobby">
            <button type="button" class="btn btn-remove" style="border-radius: 0 100px 100px 0 !important;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        `;
                document.getElementById('hobbies-container').appendChild(newHobbyField);
            });

            document.getElementById('hobbies-container').addEventListener('click', function (event) {
                if (event.target.classList.contains('btn-remove') || event.target.closest('.btn-remove')) {
                    const hobbyField = event.target.closest('.input-group');
                    hobbyField.remove();
                }
            });

            const modal = document.getElementById("myModal");
            const span = document.getElementsByClassName("close");
            const copyBtn = document.querySelector(".copy-text");
            const modalText = document.getElementById("modal-text");

            document.getElementById('generador-form').addEventListener('submit', function (event) {
                event.preventDefault();

                const nombre = document.getElementById('nombre').value;
                const apellidos = document.getElementById('apellidos').value;
                const correo = document.getElementById('correo').value;
                const telefono = document.getElementById('telefono').value;

                const intereses = Array.from(document.querySelectorAll('input[name="intereses[]"]'))
                    .map(input => input.value).filter(value => value.trim() !== '').join(', ');

                const hobbies = Array.from(document.querySelectorAll('input[name="hobbies[]"]'))
                    .map(input => input.value).filter(value => value.trim() !== '').join(', ');

                const textoGenerado = `
            ¡Hola! Soy <strong>${nombre} ${apellidos}</strong>. Me apasiona el aprendizaje y siempre busco nuevos desafíos.
            Disfruto colaborar en equipo, comunicarme eficazmente y encontrar soluciones creativas. Además de mi curiosidad, me interesa [el/la] <strong>${intereses}</strong>.
            Creo en el impacto positivo y en aplicar mis habilidades en proyectos significativos. Fuera del trabajo, disfruto [el/la] <strong>${hobbies}</strong>.
            Soy una persona apasionada, curiosa y orientada a resultados, lista para enfrentar nuevos retos con entusiasmo. Puedes contactarme a través de <strong>${correo}</strong> o por teléfono al <strong>${telefono}</strong>.
            ¡Espero conocerte pronto!
        `;

                modalText.innerHTML = textoGenerado;
                modal.style.display = "block";
            });

            Array.from(span).forEach(element => {
                element.onclick = function () {
                    modal.style.display = "none";
                }
            });

            copyBtn.onclick = function () {
                navigator.clipboard.writeText(modalText.innerText).then(() => {

                });
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>