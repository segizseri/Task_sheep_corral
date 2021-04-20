@extends('template')
@section('title', 'Отчеты')
@section('content')
	<h1>
		Отчеты
	</h1>
	<div class="container">




  @for ($i = 1; $i <= 30; $i++)
 <a class="btn btn-primary mb-3" href="{{ route('myreports') }}/{{$i}}" role="button">День {{$i}}</a>
  @endfor

		

		<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>День</th>
      <th>Овечки</th>
      <th>Зарезено</th>
    </tr>
  </thead>
  <tbody>
  	@foreach ($reports as $rep)
    <tr>
      <th scope="row">{{$rep->id}}</th>
      <td>{{$rep->day}}</td>
      <td>{{$rep->sheep}}</td>
      <td>{{$rep->killed}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

		
	</div>

@endsection