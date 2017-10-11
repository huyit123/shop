@extends('backend.layout.layout')

@section('title', 'admin home')
@section('description', 'home')
@section('keywords', 'home')

@section('content')

        <!-- Breadcrumb -->
        <ol class="breadcrumb hidden-xs">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>

        <h4 class="page-title">TABLES</h4>

        {{--<div class="block-area" id="defaultStyle">--}}
            {{--<h3 class="block-title">Default Style</h3>--}}
            {{--<table class="table tile">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>No.</th>--}}
                    {{--<th>First Name</th>--}}
                    {{--<th>Last Name</th>--}}
                    {{--<th>Username</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--<tr>--}}
                    {{--<td>1</td>--}}
                    {{--<td>Jhon </td>--}}
                    {{--<td>Makinton </td>--}}
                    {{--<td>@makinton</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td>2</td>--}}
                    {{--<td>Malinda</td>--}}
                    {{--<td>Hollaway</td>--}}
                    {{--<td>@hollway</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td>3</td>--}}
                    {{--<td>Wayn</td>--}}
                    {{--<td>Parnel</td>--}}
                    {{--<td>@wayne123</td>--}}
                {{--</tr>--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}



@endsection