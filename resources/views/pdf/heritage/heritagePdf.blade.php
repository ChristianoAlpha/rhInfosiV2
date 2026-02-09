@extends('layouts.admin.pdf')
@section('pdfTitle', 'Lista de Materiais')
@section('titleSection')
    <h4>Lista de Materiais</h4>
    <p style='text-align: center;'>
        <strong>Quantidade:</strong> <ins>{{ $data->count() }}</ins>
    </p>
@endsection
@section('contentTable')
    <table style='font-size: 12px; width: 100%; margin-bottom: 20px;'>
        @forelse ($data as $item)
            <tr>
                <th style='width: 30%;'>Tipo</th>
                <td>{{ $item->type->name }}</td>
            </tr>
            <tr>
                <th>Nº Série</th>
                <td>{{ $item->SerialNumber }}</td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td>{{ $item->Model }}</td>
            </tr>
            <tr>
                <th>Unidade</th>
                <td>{{ $item->Unit }}</td>
            </tr>
            <tr>
                <th>Stock Atual</th>
                <td>{{ $item->CurrentStock }}</td>
            </tr>
            <tr>
                <th>Localização</th>
                <td>{{ $item->Location }}</td>
            </tr>
            <tr>
                <th>Data de Entrada</th>
                <td>{{ $item->EntryDate->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Fornecedor</th>
                <td>{{ $item->SupplierName }}</td>
            </tr>
            <tr>
                <th>Observações</th>
                <td>{{ $item->Notes }}</td>
            </tr>
        @empty
                <p class="text-center">Sem nehum Registro</p>
            
        @endforelse
    </table>
@endsection
