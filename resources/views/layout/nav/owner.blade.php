<ul class="navbar-nav flex-column">
    <li class="nav-divider">
        Menu
    </li>
    <li class="nav-item ">
        <a class="nav-link active" href="{{route(currentUser().'.dashboard')}}"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
    </li>
    <li class="nav-item ">
        <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Product <span class="badge badge-success">6</span></a>
        <div id="submenu-1" class="collapse submenu" style="">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route(currentUser().'.category.index')}}">{{__('Category')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route(currentUser().'.subcategory.index')}}">{{__('Sub Category')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route(currentUser().'.childcategory.index')}}">{{__('Child Category')}}</a>
                </li>
                    <a class="nav-link" href="{{route(currentUser().'.product.index')}}">{{__('Product')}}</a>
                </li>
                </li>
                    <a class="nav-link" href="{{route(currentUser().'.purchase.index')}}">{{__('Purchase')}}</a>
                </li>
                </li>
                    <a class="nav-link" href="{{route(currentUser().'.supplier.index')}}">{{__('Supplier')}}</a>
                </li>
                </li>
                    <a class="nav-link" href="{{route(currentUser().'.customer.index')}}">{{__('Pustomer')}}</a>
                </li>
            </ul>
        </div>
    </li>
</ul>