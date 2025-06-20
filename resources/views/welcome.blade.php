<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trivium | Cervecería Artesanal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="welcome" x-data="welcomeApp" x-cloak>

        <aside :style="{visibility: loaded ? 'visible' : 'hidden'}" class="content" x-ref="content" @scroll="handleScroll()">
            <section class="bottom" x-ref="bottom" :style="{paddingTop: bottomPaddingTop + 'px', transition:systemScroll?'none': 'all 1s ease-in-out'}">
                <figure x-ref="figure" :style="{paddingTop: figurePaddingTop + 'px'}">
                    <img x-cloak x-ref="figureImg" :style="{width: figureImgWidth + 'px'}" id="home-link" class="link active" src="{{ asset('images/welcome/TRIVIUM_recortado.png') }}"
                        alt="Logo de Trivium" @click="setSection('home')" />
                </figure>
                <article class="relevant">
                    <nav>
                        <div>
                            <a id="login-link" class="link" :class="section== 'login'?'active': ''" @click.prevent="setSection('login')">Iniciar Sesión</a>
                            <a id="products-link" class="link" :class="section== 'products'?'active': ''"
                                @click.prevent="setSection('products')">Ver Productos</a>
                        </div>
                        <div>
                            <a id="about-link" class="link" :class="section== 'about'?'active': ''" @click.prevent="setSection('about')">Acerca De</a>
                            <a id="register-link" class="link" :class="section== 'register'?'active': ''" @click.prevent="setSection('register')">Registrarse</a>
                        </div>
                    </nav>
                    <template x-if="section == 'login'">
                        <section id="login" x-ref="login" class="relevant-content" @scroll="handleInnerScroll($el)">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <label for="login">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="login" placeholder="Nombre de usuario o Correo">
                                </label>
                                <label for="password">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="password" placeholder="Contraseña">
                                </label>
                                <button type="submit" class="fa-solid fa-door-open"></button>
                            </form>
                            <figure>
                                <img src="{{ asset('images/welcome/TRIVIUM-Texto-Sin Fondo.png') }}" alt>
                            </figure>
                        </section>
                    </template>
                    <template x-if="section == 'products'">

                        <section id="products" class="relevant-content" x-data="productos">
                <template x-if="!!products">
                <template x-for="(product, index) in products" :key="product.id">
                    <div x-data="producto" class="product-container" x-init="producto= product">
                        <article class="product">
                            <div class="slideshow-container"  x-ref="slideshow-container" @mousemove="appearControls()" :data-index="slideshowIndex">
                                <figure class="slideshow">
                                    <template x-for="(image, index) in product.imagenes" :key="index">
                                        <img :src="`/storage/${image}`" alt @click="openImageModal(`/storage/${image}`, index)" style="cursor: pointer;">                                    </template>
                                </figure>
                                <div class="prev-image"  x-ref="prev-image" @click="prevSlideshowImage()">
                                    <i class="fa-solid fa-circle-chevron-left"></i>
                                </div>
                                <div class="next-image"  x-ref="next-image" @click="nextSlideshowImage()">
                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                </div>
                                <div class="controls visible"  x-ref="controls" >
                                    <template x-for="(image, indexI) in product.imagenes" :key="indexI">
                                        <img @click="updateSlideshow(indexI)" :class="indexI == 0 ? 'active' : ''"
                                            :src="`/storage/${image}`" alt>
                                    </template>
                                </div>
                                <div class="scroll-left-controls visible"   x-ref="scroll-left-controls" @mouseenter="scrollLeft"
                                    @mouseleave="clearInterval(intervalScroll)">
                                </div>
                                <div class="scroll-right-controls visible"  x-ref="scroll-right-controls"  @mouseenter="scrollRight"
                                    @mouseleave="clearInterval(intervalScroll)">
                                </div>
                            </div>
                            <div class="right">
                                <h1 x-text="product.nombre"></h1>
                                <p class="description" x-text="product.descripcion"></p>

                                </p>
                                <div class="info">
                                    <div class="left"  x-ref="left" ><span class="price" x-text="`$ ${product.precio}`"></span></div>
                                </div>
                            </div>
                            <div x-show="showImageModal" class="product-modal" @click.self="closeImageModal">
                                <button class="close-modal" @click.stop="closeImageModal()">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <button class="left-arrow" @click.stop="prevModalImage()" >
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <img :src="modalImageUrl">
                                <button class="right-arrow" @click.stop="nextModalImage()" >
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </article>
                    </div>
                </template>
            </template>
                <template x-if="!products">
                    <div class="loading">
                        <p>Cargando productos...</p>
                    </div>
                </template>
            </section>
                    </template>
                    <template x-if="section == 'about'">

                        <section id="about" x-ref="about" class="relevant-content" @scroll="handleInnerScroll($el)">
                            <div class="paragraph">
                                <img src="{{ asset('images/welcome/TRIVIUM-36.jpg') }}" alt>
                                <p>
                                    Somos tres amigos unidos por una misma pasión: la cerveza artesanal.
                                    Después de años explorando estilos del mundo, en 2022 decidimos crear 
                                    los nuestros.
                                    <br>
                                    <br>
                                    Nos formamos, experimentamos, debatimos y perfeccionamos cada receta 
                                    hasta dar con lo que hoy es Trivium:
                                </p>
                            </div>
                            <div class="paragraph">
                                <p>
                                    Una IPA intensa y aromática<br>
                                    Una Golden Ale suave y refrescante<br>
                                    Una Irish Red Ale con carácter y equilibrio<br>
                                    Una Porter tostada y llena de sabor<br>
                                    <br>
                                    <br>
                                    Cada botella refleja lo que somos:
                                    pasión, dedicación y ganas de compartir algo único.
                                </p>
                                <img src="{{ asset('images/welcome/TRIVIUM-36.jpg') }}" alt>
                            </div>
                            <div class="paragraph vertical">
                                <p>
                                    Descubre en cada sorbo el sabor de una historia hecha con alma.
                                </p>
                                <img src="{{ asset('images/welcome/TRIVIUM-38.jpg') }}" alt>
                            </div>
                        </section>
                    </template>
                    <template x-if="section == 'register'">

                        <section id="register" x-ref="register" class="relevant-content" @scroll="handleInnerScroll($el)">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <label for="username">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="username" placeholder="Nombre de usuario">
                                </label>
                                <label for="name">
                                    <i class="fa-solid fa-id-card"></i>
                                    <input type="text" name="name" placeholder="Nombres y apellidos">
                                </label>
                                <label for="cellphone">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <input type="text" name="cellphone" placeholder="Número de celular">
                                </label>
                                <label for="email">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" name="email" placeholder="Correo electrónico">
                                </label>
                                <label for="email_confirmation">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" name="email_confirmation"
                                        placeholder="Confirma el correo electrónico">
                                </label>
                                <label for="password">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="password" placeholder="Crea una contraseña">
                                </label>
                                <label for="password_confirmation">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirma la contraseña">
                                </label>
                                <button type="submit" class="fa-solid fa-user-plus"></button>
                            </form>
                            <figure>
                                <img src="{{ asset('images/welcome/TRIVIUM-Texto-Sin Fondo.png') }}" alt>
                            </figure>
                        </section>
                    </template>
                </article>
            </section>
        </aside>
    <img class="background" x-ref="background" src="{{ asset('images/welcome/4cervezastrivium.jpg') }}" alt="Cuatro cervezas Trivium">
</body>
</html>
