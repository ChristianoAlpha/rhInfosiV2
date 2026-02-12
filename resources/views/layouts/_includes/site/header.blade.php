<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="keywords"
        content="Fondex - Business and Finance Consulting HTML5 Template, Zippco - Business and Finance Consulting WordPress Theme, Axacus - Business Agency WordPress Theme, Axacus - Business Agency HTML Template, themes & template, html5 template, html template, html, woocommerce, shopify, prestashop, eCommerce, JavaScript, best CSS theme,css3, elementor theme, latest premium themes 2023, latest premium templates 2023, Preyan Technosys Pvt.Ltd, cymol themes, themetech mount, Web 3.0, multi-theme, website theme and template, woocommerce, bootstrap template, web templates, responsive theme, services, web design and development, business accountant, advisor, business, company consultancy, creative websites, finance, financial, insurance, legal adviser, business agents, marketing, trader, trading">
    <meta name="description" content="Fondex – Business &amp; Finance Consulting HTML Template" />
    <meta name="author" content="www.themetechmount.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>INFOSI recursos humanos</title>

    <link rel="shortcut icon" href="{{ asset('auth/img/infosi3.png') }}" />


    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/themify-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/layers.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/settings.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/prettyPhoto.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/shortcodes.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}" />


    @push('styles')
        <style>
            /* Fundo do header (desktop) */
            header.ttm-header-style-classic {
                background: url('{{ asset('frontend/images/footer-bg-one.jpg') }}') center/cover no-repeat !important;
            }

            header.ttm-header-style-classic .ttm-header-wrap {
                background: transparent !important;
            }

            .site-navigation,
            .site-navigation nav.menu {
                background: transparent !important;
            }

            /* ====================== Mobile/sidebar ====================== */
            @media screen and (max-width: 1200px) {

                /* sidebar vai herdar a mesma imagem */
                header.ttm-header-style-classic .site-navigation nav.menu,
                header.ttm-header-style-classic .site-navigation nav.menu.active {
                    background: url('{{ asset('frontend/images/footer-bg-one.jpg') }}') center/cover no-repeat !important;
                }
            }
        </style>
    @endpush


    @stack('styles')
</head>

<body>
    <header id="masthead" class="header ttm-header-style-classic">
        <!-- Barra Superior -->
        <div style="background-color: #E46705; color: #fff; padding: 10px 20px; width: 100%;">
            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 20px;">
                <!-- Gestão de Capital Humano -->
                <div style="white-space: nowrap;">
                    <i class="fas fa-company"></i>
                    <em><strong>Capital Humano</strong>-INFOSI </em>
                </div>
                <!-- E-mail -->
                <div style="white-space: nowrap;">
                    <i class="fa fa-envelope-o"></i>
                    <a href="mailto: GERAL@INFOSI.GOV.AO" style="color: #fff; text-decoration: none; margin-left: 5px;">
                        geral@infosi.gov.ao
                    </a>
                </div>
                <!-- Telefone -->
                <div style="white-space: nowrap;">
                    <i class="fa fa-phone"></i>
                    <span style="margin-left: 5px;">(+244) 222 692 971</span>
                </div>
                <!-- Redes Sociais -->
                <div style="display: flex; gap: 10px;">
                    <a href="https://www.facebook.com/TEC.DIGITAL.AO" target="_blank" rel="noopener noreferrer"
                        style="color: #fff;">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/infosi01/" target="_blank" rel="noopener noreferrer"
                        style="color: #fff;">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Fim da Barra Superior -->

        <!-- Cabeçalho Principal (Branding e Navbar) -->
        <div class="ttm-header-wrap">
            <div id="ttm-stickable-header-w" class="ttm-stickable-header-w clearfix">
                <div id="site-header-menu" class="site-header-menu">
                    <div class="site-header-menu-inner ttm-stickable-header">
                        <div class="container">
                            <!-- Branding -->
                            <br>
                            <div class="site-branding">
                                <a class="home-link" href="{{ route('frontend.index') }}"
                                    title="Gestão de Capital Humano" rel="home">
                                    <img id="logo-img" class="img-center" src="{{ asset('auth/img/infosi2.png') }}"
                                        alt="logo-img">
                                </a>
                            </div>
                            <!-- Navbar -->
                            @include('layouts._includes.site.navbar')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
