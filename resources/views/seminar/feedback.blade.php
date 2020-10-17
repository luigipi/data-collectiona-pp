@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="header-title">
					<h2 class="header-lg">Feedback</h2> <a href="/export">export</a>
					<h4 class="header-sm">Many thanks for attending IBOR 7 CONFERENCE.</h4>
					<p>To help us help us assess our events, we would appreciate you taking a few minutes of your time to complete this questionaire. Please tick the boxes that best represent your views.</p>
				</div>
				<form action="#" id="feedbackForm" method="POST" enctype="mulitpart/form-data">
					@csrf
					<div class="form-group">
						<p class="form-label">How did you hear about the IBOR conference?</p>
						<input type="radio" name="about" value="Invitation">
						<label>Invitation</label>
						 <input type="radio" name="about" value="Social media">
						 <label>Social media</label>
						<input type="radio" name="about" value="Friend">
						<lable>Friend</lable>
						<input type="radio" id="about" name="about" value="null" >
						<label>Others</label>												
						<input type="text" id="t-box1" class="hidden t-box" name="abouts" placeholder="please specify">
					</div>
					<div class="form-group">
						<p class="form-label">What were your main reasons for attending the event?</p>
						<input type="radio" name="reason" value="Networking"> Networking
						<input type="radio" name="reason" value="Topic/Program"> Topic/Program of interest
						<input type="radio" name="reason" value="Speaker/Artist"> Speaker/Artist
						<input type="radio" name="reason" value="Location"> Location
						<input type="radio" id="reason" name="reason" value="null"> Others
						<input type="text" id="t-box2" class="hidden t-box" name="reasons" placeholder="please specify">
					</div>
					<div class="form-group">
						<p class="form-label">Tick the boxes that best describe you</p>
						Gender: <br>
						<input type="radio" name="gender" value="Female"> Female
						<input type="radio" name="gender" value="Male"> Male <br>
						Age: <br>
						<input type="radio" name="age" value="13-16"> 13-16
						<input type="radio" name="age" value="16-19"> 16-19
						<input type="radio" name="age" value="19-30"> 19-30
						<input type="radio" name="age" value="over 30"> over 30
					</div>
					<div class="form-group">
						<p class="form-label">Would you attend the next edition of the IBOR conference?</p>
						<input type="radio" name="nextedition" value="Yes"> Yes
						<input type="radio" name="nextedition" value="No"> No
					</div>
					<div class="form-group text-center">
						<a href="javascript:;" class="btn btn-lg" id="submit">Submit <img src="{{asset('imgs/loader.gif')}}" id="loader" width="30" class="hidden"> </a>
					</div>
				</form>

			</div>
		</div>
	</div>
@endsection