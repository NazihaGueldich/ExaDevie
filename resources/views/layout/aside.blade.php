   <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
       <div class="brand-logo">
           <a href="{{ route('dashboard') }}">
               <img src="https://exadev.tn/Exadev_Favicon.ico" class="logo-icon" alt="logo icon">
               <h5 class="logo-text">Devis</h5>
           </a>
       </div>
       <ul class="sidebar-menu do-nicescrol">
           <li class="sidebar-header">Menue</li>
           @if (Auth::user()->role == 0)
               <li>
                   <a href="{{ route('dashboard') }}">
                       <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                   </a>
               </li>
               <li><a href="{{ route('produits.index') }}"><i class="zmdi zmdi-archive"></i> <span>Produits</span></a>
               </li>
               <li><a href="{{ route('devis.index') }}"><i class="zmdi zmdi-assignment"></i> <span>Devis</span></a></li>
               <li><a href="{{ route('factures.index') }}"><i class="zmdi zmdi-file-text"></i> <span>Facturs</span></a>
               </li>
               <li><a href="{{ route('client.index') }}"><i class="zmdi zmdi-account-calendar"></i>
                       <span>Clients</span></a></li>
               <li><a href="{{ route('employes.index') }}"><i class="zmdi zmdi-account"></i> <span>Employés</span></a>
               </li>
               <li><a href="{{ route('histpaymts.index') }}">$ &nbsp;&nbsp; <span>Historiques Payement</span></a></li>
               <li><a href="{{ route('parameter.index') }}"><i class="zmdi zmdi-settings"></i>
                       <span>Paraméters</span></a></li>
           @else
               <li>
                   <a href="{{ route('Welcame_Employe') }}">
                       <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                   </a>
               </li>
               <li><a href="{{ route('presence_employe') }}"><i class="zmdi zmdi-calendar"></i>
                       <span>Calendrier</span></a></li>
           @endif
       </ul>

   </div>
   <!--End sidebar-wrapper-->
