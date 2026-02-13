<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Guia de Férias</title>
    <style>
        @page {
            margin: 30px 40px 80px 40px;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
            position: relative;
        }

        /* ── Watermark (marca d'água central) ── */
        .watermark {
            position: fixed;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: -1;
            text-align: center;
        }

        .watermark img {
            width: 340px;
        }

        /* ── Background pattern sutil ── */
        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.015;
            z-index: -2;
            background-image: radial-gradient(circle, #1a5276 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img.crest {
            width: 55px;
            margin-bottom: 2px;
        }

        .header h3 {
            margin: 3px 0 1px;
            font-size: 12pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 1px 0;
            font-size: 9.5pt;
        }

        .header hr {
            border: none;
            border-top: 1.5px solid #333;
            margin: 8px 40px;
        }

        /* ── Gabinete / title section ── */
        .gabinete {
            text-align: center;
            margin: 5px 0 20px;
        }

        .gabinete h4 {
            margin: 0;
            font-size: 10.5pt;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* ── Content ── */
        .content {
            margin: 0 20px;
            text-align: justify;
        }

        .content .guia-number {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 25px;
            text-decoration: underline;
        }

        .content .body-text {
            text-indent: 40px;
            margin-bottom: 20px;
        }

        .content .emission-date {
            margin-top: 35px;
            text-indent: 40px;
        }

        /* ── Signature block (posição baixa, próximo à data de emissão) ── */
        .signature-block {
            margin-top: 40px;
            text-align: center;
        }

        .signature-block .signer-title {
            font-weight: bold;
            font-size: 10.5pt;
            margin-bottom: 8px;
        }

        .signature-block .signature-img {
            margin: 5px auto;
        }

        .signature-block .signature-img img {
            width: 180px;
            height: auto;
        }

        .signature-block .stamp-area {
            display: inline-block;
            position: relative;
        }

        .signature-block .stamp-area::after {
            content: '';
            position: absolute;
            top: 50%;
            left: -10px;
            width: 80px;
            height: 80px;
            border: 2px solid rgba(200, 0, 0, 0.15);
            border-radius: 50%;
            transform: translateY(-50%);
        }

        .signature-block .signer-name {
            font-weight: bold;
            font-size: 11pt;
            margin-top: 5px;
            text-transform: uppercase;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 4px;
            min-width: 260px;
        }

        /* ── Footer ── */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 7.5pt;
            color: #555;
            border-top: 1.5px solid #1a5276;
            padding-top: 5px;
        }

        .footer img {
            width: 90px;
            margin-bottom: 3px;
        }

        .footer p {
            margin: 1px 0;
        }

        .footer .footer-ministry {
            font-size: 6.5pt;
            color: #888;
        }
    </style>
</head>

<body>

    {{-- Background pattern sutil --}}
    <div class="bg-pattern"></div>

    {{-- Marca d'água central --}}
    <div class="watermark">
        <img src="{{ public_path('images/infosi/infosiH.png') }}" alt="">
    </div>

    {{-- ═══════════ HEADER ═══════════ --}}
    <div class="header">
        <img src="{{ public_path('images/infosi/insigniaAngola.png') }}" class="crest" alt="Insígnia">
        <h3>República de Angola</h3>
        <p>MINISTÉRIO DAS TELECOMUNICAÇÕES, TECNOLOGIAS DE INFORMAÇÃO E COMUNICAÇÃO SOCIAL</p>
        <p><strong>INSTITUTO NACIONAL DE FOMENTO DA SOCIEDADE DA INFORMAÇÃO</strong></p>
        <hr>
    </div>

    {{-- ═══════════ GABINETE (dinâmico por director) ═══════════ --}}
    <div class="gabinete">
        <h4>{{ $headerTitle }}</h4>
    </div>

    {{-- ═══════════ CONTEÚDO ═══════════ --}}
    <div class="content">

        <p class="guia-number">
            GUIA DE FÉRIAS N.º {{ $sequenceNumber }}
        </p>

        <p class="body-text">
            <strong>{{ strtoupper($employee->fullName) }}</strong>,
            {{ $employee->position->name ?? 'Funcionário' }},
            está devidamente autorizado(a) em conformidade com o despacho do Exmo.
            {{ $signerTitle }} de {{ $approvalDate->format('d/m/Y') }},
            a gozar <strong>{{ $vacationDays }}</strong> dias de férias referente ao ano de
            {{ $vacation->created_at->format('Y') }}, nos termos do n.º 2 do artigo 79.º
            da Lei n.º 26/22 de 22 de Agosto — Lei de Bases da Função Pública, com início a
            <strong>{{ \Carbon\Carbon::parse($vacation->vacationStart)->format('d/m/Y') }}</strong>,
            devendo apresentar-se no dia
            <strong>{{ \Carbon\Carbon::parse($vacation->vacationEnd)->addDay()->format('d/m/Y') }}</strong>,
            junto do DASG para regularização do regresso à actividade laboral.
        </p>

        <p class="emission-date">
            Luanda, {{ $emissionDate->format('d \d\e F \d\e Y') }}.
        </p>

        {{-- ═══════════ ASSINATURA (baixa, próximo à data de emissão) ═══════════ --}}
        <div class="signature-block">
            <p class="signer-title">{{ $signerTitle }}</p>

            <div class="stamp-area">
                @if($signatureImage)
                    <div class="signature-img">
                        <img src="{{ $signatureImage }}" alt="Assinatura">
                    </div>
                @else
                    <div style="height: 60px;"></div>
                @endif
            </div>

            <br>
            <p class="signer-name">{{ strtoupper($directorName) }}</p>
        </div>

    </div>

    {{-- ═══════════ FOOTER ═══════════ --}}
    <div class="footer">
        <img src="{{ public_path('images/infosi/infosiH.png') }}" alt="INFOSI">
        <p><strong>Instituto Nacional de Fomento da Sociedade de Informação</strong></p>
        <p>Rua 17 de Setembro nº 59, Cidade Alta, Luanda — Angola</p>
        <p>Caixa Postal: 1412 | Tel.: +244 222 693 503 | Geral@infosi.gov.ao | www.infosi.gov.ao</p>
        <p class="footer-ministry">Ministério das Telecomunicações, Tecnologias de Informação e Comunicação Social</p>
    </div>

</body>

</html>