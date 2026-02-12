@extends('layouts.pdf')

@section('pdfTitle', 'Guia de Férias')

@section('titleSection')
    <h4 style="text-transform: uppercase;">{{ $headerTitle }}</h4>
@endsection

@section('contentTable')
    <div
        style="margin: 30px 40px; font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.5; text-align: justify;">

        <p style="text-align: center; font-weight: bold; margin-bottom: 30px; font-size: 12pt;">
            GUIA DE FÉRIAS N.º {{ $sequenceNumber }}
        </p>

        <p>
            <strong>{{ strtoupper($employee->fullName) }}</strong>, {{ $employee->position->name ?? 'Funcionário' }}, está
            devidamente autorizado em conformidade com o despacho do Exmo. {{ $signerTitle }} de
            {{ $approvalDate->format('d/m/Y') }}, a gozar <strong>{{ $vacation->vacationDays ?? 0 }}</strong> dias de férias
            referente ao ano de {{ $vacation->created_at->format('Y') }}, nos termos do n.º 2 do artigo 79º da Lei n.º 26/22
            de 22 de Agosto - Lei de Bases da Função Pública, com início a
            <strong>{{ \Carbon\Carbon::parse($vacation->vacationStart)->format('d/m/Y') }}</strong>, devendo apresentar-se
            no dia <strong>{{ \Carbon\Carbon::parse($vacation->vacationEnd)->addDay()->format('d/m/Y') }}</strong>, junto do
            DASG para regularização do regresso à actividade laboral.
        </p>

        <p style="margin-top: 30px;">
            Luanda, {{ $emissionDate->format('d/m/Y') }}.
        </p>

        <div style="margin-top: 60px; text-align: center;">
            <p style="margin-bottom: 50px; font-weight: bold;">
                {{ $signerTitle }}
            </p>

            {{-- Aqui você pode inserir a imagem da assinatura digital se tiver --}}
            {{-- <img src="{{ public_path('images/signatures/signature.png') }}" style="width: 200px;"> --}}

            <p style="font-weight: bold; margin-top: 50px;">
                {{ strtoupper($directorName) }}
            </p>
        </div>

    </div>
@endsection