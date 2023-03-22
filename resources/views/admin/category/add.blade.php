@extends('home')

@section('content')

<form action="/action_page.php">
 <fieldset>
  <legend>Add Data - Special Categories</legend>

<label for="category">Category</label>
<select id="category" ><br><br> 
<option>--select--</option>
<option>Health</option>
<option>wealth</option>
<option>Love</option>
<option>Career</option>
</select><br><br>
<label for="year">Category</label>
<select id="year" ><br><br>
<option>--select--</option>
<option>2012</option>
<option>2013</option>
<option>2013</option>
<option>2015</option>
</select><br><br>
<label for="myfile">Data File:</label>
<input type="file" id="myfile" multiple><br><br>

<button type="button">submit</button>



</fieldset>
</form>
@endsection