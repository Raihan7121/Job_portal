@extends('panel.base')
@section('content')

<div class="card mb-3">

    <div class="card-body">
  
      <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">CHANGE YOUR PROFILE PICTURE</h5>
        <p class="text-center small">Select your profile pic</p>
      </div>
  
      <div class="modal-body">
        <form id="profilePicForm" name="profilePicForm" action="" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
				<p class="text-danger" id="image-error"></p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mx-3">Update</button>
                <a href="{{route('panel.dashboard')}}" class="btn btn-secondary">Close</a>
              
            </div>
            
        </form>
      </div>
     
  
      
    
  
    </div>
  </div>
 

    
@endsection

@section('customJs')
<script>
$('#profilePicForm').submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url:'{{ route("panel.updateProfilePic") }}',
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response){
            if(response.status == false){
                var errors = response.errors;
                if(errors.image){
                    $("#image-error").html(errors.image)
                }
            } else {
                window.location.href = '{{ route('panel.dashboard') }}';
            }
            

        }
    });

});

</script>
    
@endsection