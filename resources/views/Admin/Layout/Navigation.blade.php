 <!-- ======= Sidebar ======= -->
 @php
 $home ="collapsed";
 $banner ="collapsed";
 $about ="collapsed";
 $projects ="collapsed";
 $services ="collapsed";
 $news ="collapsed";
 $contact ="collapsed";
 $wedo ="collapsed";
 $numberclient ="collapsed";
 $clients ="collapsed";

 if($menu =="home"){
 $home ="";
 }

 if($menu =="banner"){
 $banner ="";
 }

 if($menu =="about"){
 $about ="";
 }

 if($menu =="projects"){
 $projects ="";
 }

 if($menu =="services"){
 $services ="";
 }

 if($menu =="news"){
 $news ="";
 }

 if($menu =="contact"){
 $contact ="";
 }

 if($menu =="wedo"){
 $wedo ="";
 }

 if($menu =="numberclient"){
 $numberclient ="";
 }


 if($menu =="clients"){
 $clients ="";
 }
 @endphp


 <aside id="sidebar" class="sidebar">
     <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item">
             <a class="nav-link {{$home}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/home') }}">
                 <i class="bi bi-grid"></i>
                 <span>Home</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$banner}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/banner') }}">
                 <i class="bi bi-grid"></i>
                 <span>Banner</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$about}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/about') }}">
                 <i class="bi bi-grid"></i>
                 <span>About Us</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$projects}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/projects') }}">
                 <i class="bi bi-grid"></i>
                 <span>Projects</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$services}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/services') }}">
                 <i class="bi bi-grid"></i>
                 <span>Services</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$news}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/news') }}">
                 <i class="bi bi-grid"></i>
                 <span>News</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$contact}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/contact') }}">
                 <i class="bi bi-grid"></i>
                 <span>Contact</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$wedo}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/wedo') }}">
                 <i class="bi bi-grid"></i>
                 <span>We Do</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$numberclient}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/numberclient') }}">
                 <i class="bi bi-grid"></i>
                 <span>Number Client</span>
             </a>
         </li><!-- End Dashboard Nav -->
         <li class="nav-item">
             <a class="nav-link {{$clients}}" href="{{ asset(env('GLOBAL_PLUGIN_PATH').'/admin-page/clients') }}">
                 <i class="bi bi-grid"></i>
                 <span>Clients</span>
             </a>
         </li><!-- End Dashboard Nav -->
     </ul>

 </aside><!-- End Sidebar-->