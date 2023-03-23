@extends('home')

@section('content')
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModalCenter" style="float:right">
  Add Data
</button>
<table class="table" id="table1">
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>ID</th>
        <th>Special Category</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($data as $value)
                <tr>
                    
                    
                <td>{{$value->spl_category_id}}</td>
                    <td>{{$value->spl_category}}</td>
               
               
        <td>
				<a  href="" class="edit_btn" name="edit_btn" ><i class='far fa-edit' style='font-size:18px'></i></a>
			
			
				<a href=""  class="del_btn" name="del_btn"><i class='far fa-trash-alt' style='font-size:18px'></i></a>
			</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="{{route('addData')}}">
      {{ csrf_field() }}
      <div class=" row">
    <label for="specialCategory" class="col-sm-4">Special Category:</label>
    <div class="col">
      <input type="text" class="form-control" name="spl_category" id="spl_category" value="">
    </div>
  </div>

      
  
<button class="btn btn-primary" type="submit">Submit form</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  @endsection