@extends('template')
@section('title', 'Загоны')
@section('content')

<h1>Загон</h1>	

<hr />
<div id="app">

 <input v-model="countDown">

 <form action="{{route('add.random')}}" method="post" enctype="multipart/form-data">
		@csrf

		<button ref="submitButton" type="submit" class="btn btn-success mt-2" >Refresh</button>

</form> 
<h3 id="demo">{{$showonpage}} </h3>

    </div>
<script>
        myObject = new Vue({
            el: '#app',
            data: function () {
                return {
                    countDown: 0 ,
                    countDownTimer() {
                        if (this.countDown == 10) {
                        	this.$refs.submitButton.click();
                        }

                            setTimeout(() => {
                                this.countDown += 1
                                this.countDownTimer();
                            }, 1000)

                            
                        
                    }
                }
            },
            created() {this.countDownTimer();}
        });

        
</script>
<hr />





	<div class="row"> <!-- first row begin -->
		
		@foreach ($combined as $corra)
		<div class="col-sm mt-5">
			<ul class="list-group">
			  <li class="list-group-item active" aria-current="true">{{$corra->corrals}}</li>
			
			 @foreach ($corra->sheep as $sheeps)
			  <li class="list-group-item">{{$sheeps->name}}</li>
			  @endforeach

			</ul>			
		</div>
		@endforeach
	</div> <!-- first row end -->

			<div class="row mt-5">
				<div class="col-sm">
					<form action="{{route('kill.random')}}" method="post" enctype="multipart/form-data">
							@csrf
							<button type="submit" class="btn btn-danger" mt-5>Зарубить</button>
					</form>

				</div>

			<form action="{{route('switch.sheep')}}" method="post" enctype="multipart/form-data">
					@csrf
				<div class="form-group">
						<label for="corral1">От Загона #</label>
						<input type="text" name="corral1" placeholder="1-4" id="corral1" class="form-control">
				</div>

							<button type="submit" class="btn btn-success" mt-5>Переместить</button>
									  
				<div class="form-group">
						<label for="corral2">На Загона #</label>
						<input type="text" name="corral2" placeholder="1-4" id="corral2" class="form-control">
				</div>

					
			</form>
		
			</div>

		</div>

		
	</div>
@endsection