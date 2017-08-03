<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      @if(Auth::check())
      <div class="user-panel">
        <div class="pull-left image">
           @if(Auth::user()->avata)
                <img src="{{url('public/upload/images')}}/{{ Auth::user()->avata }}" class="img-circle" alt="User Image">
           @else
                <img src="{{url('public/upload/icon/user.jpg')}}" class="img-circle" alt="User Image">
           @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="{{ URL::route('users.getUserProfile')}}"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      @endif
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          {{-- <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span> --}}
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
            

        <li class="treeview">

            <a href="{{ URL::route('wallets.getAdd') }}">

                <i class="fa fa-square"></i>

                <span>Add Wallets </span>

                <span class="label label-primary pull-right"></span>
            </a> 
        </li>

        <li class="treeview ">

            <a href="{{ URL::route('wallets.getList') }}">

                <i class="fa fa-list"></i>

                <span>List Wallets </span>

                <span class="label label-primary pull-right"></span>
            </a>   
        </li>

        <li class="treeview ">
            <a href="{{URL::route('wallets.getTransfersMoney')}}">

                <i class="fa fa-files-o"></i>

                <span>Transfers Money</span>

                <span class="label label-primary pull-right"></span>
            </a>
        </li>

        <li class="treeview ">

            <a href="{{URL::route('wallets.getListTransfers')}}">
                <i class="fa fa-files-o"></i>

                <span>List Transfers Money</span>

                <span class="label label-primary pull-right"></span>
            </a>   
        </li>


        <li class="treeview ">
            <a href="{{URL::route('categorys.getAdd')}}">
                <i class="fa fa-th"></i> <span>Add Categorys</span>
                <small class="label pull-right bg-green"></small>
            </a> 
        </li>

        <li class="treeview " >
            <a href="{{URL::route('categorys.getList')}}">
                <i class="fa fa-th"></i> <span>List Categorys</span>
                <small class="label pull-right bg-green"></small>
            </a>
        </li>

        <li class="treeview " >
            <a href="{{URL::route('transection.getAdd')}}">
                <i class="fa fa-th"></i> <span>Add Transaction</span>
                <small class="label pull-right bg-green"></small>
            </a>
        </li>

    </ul>
    </section>
    <!-- /.sidebar -->