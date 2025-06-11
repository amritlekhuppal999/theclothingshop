

    <div class="user-panel mt-2 pb-2 mb-2 d-flex ">
        <div class="image">
            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-circle elevation-2 mt-2" alt="User Image">
        </div>
        <div class="info">
            {{-- Admin Name --}}
            <a href="#" class="d-block">{{ session('admin.name') }} </a>
            <small class="text-white bg-purple p-1">{{ getUserRole(session('admin.role')) }}</small>
        </div>
    </div>