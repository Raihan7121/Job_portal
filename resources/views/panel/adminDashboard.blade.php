<!-- Recent Sales -->
<div class="col-12">
    <div class="card recent-sales ">

     
      <div class="card-body">
        <h5 class="card-title">All Users</h5>

        <table class="table table-borderless ">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Address</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($users->isNotEmpty())
           
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row"><a href="#">#{{$user->id}}</a></th>
                            <td><a href="#" class="text-primary">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                              <div class="action-dots">
                                
                                <button href="" class="btn" data-bs-toggle="dropdown" aria-expanded="false">:</button>
                             
                                <ul class="dropdown-menu">
                                   <li> <a href="{{ route('user.delete', $user->id ) }}" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a></li>
                                   <li> <a href="{{ route('user.adminrole',$user->id ) }}" class="dropdown-item" onclick="return confirm('Are you sure you want to make admin this user?')">Make Admin</a>  </li>
                                   <li> <a href="{{ route('user.sellerrole',$user->id ) }}" class="dropdown-item" onclick="return confirm('Are you sure you want to make seller this user?')">Make Seller</a>  </li>
                                   <li> <a href="{{ route('user.userrole',$user->id ) }}" class="dropdown-item" onclick="return confirm('Are you sure you want to make user this user?')">Make User</a>  </li>        
                                </ul>
                              </div>
                            </td>
                        </tr>                  
                    @endforeach        
            @endif
          </tbody>
          
        </table>

        {{ $sells->links()}}

      </div>

    </div>
  </div><!-- End Recent Sales -->