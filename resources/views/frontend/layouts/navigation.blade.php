    <header class="site-navbar py-3" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-11 col-xl-2">
            <img src="{{asset('images/logo.png')}}" style="width: 50px; margin-left: 110px; " alt = "Image">
            <h2 class="mb-0 h1"><a href="{{ route('home')}}" class="text-white h2 mb-0">Plagiarismchecker</a></h2>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                <li class="{{ in_array(Route::getCurrentRoute()->getName(), ['home']) ? "active" : NULL }}"><a href="{{ route('home')}}">The checker</a></li>

                <li class="{{ in_array(Route::getCurrentRoute()->getName(), ['service']) ? "active has-children" : "has-children" }}" >
                  <a href="{{ route('service')}}">Services</a>
                  <ul class="dropdown">
                    <li><a href="{{ route('pages.plagiarism_checker')}}">Plagiarism checker</a></li>
                    <li><a href="{{ route('pages.similarity_checker')}}">Similarity checker</a></li>
                    <li><a href="{{ route('pages.checker_students')}}">Plagiarism check for students</a></li>
                    <li><a href="{{ route('pages.checker_business')}}">Plagiarism check for business</a></li>
                    <li><a href="{{ route('pages.checker_universities')}}">Plagiarism check for universities</a></li>
                  </ul>
                </li>
                <li class="{{ in_array(Route::getCurrentRoute()->getName(), ['pages.partners']) ? "active" : NULL }}"><a href="{{ route('pages.partners')}}">For Distributors</a></li>
                <li class="{{ in_array(Route::getCurrentRoute()->getName(), ['pages.blog']) ? "active" : NULL }}"><a href="{{ route('pages.blog')}}">Blog</a></li>
                <li class="{{ in_array(Route::getCurrentRoute()->getName(), ['pages.contact']) ? "active" : NULL }}"><a href="{{ route('pages.contact')}}">Contacts</a></li>
                @if(!Auth::check())
                <li ><a href="login">Members area</a></li>
                @else
                <li ><a href="{{ route('user.dashboard')}}">Member</a></li>
                @endif
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>