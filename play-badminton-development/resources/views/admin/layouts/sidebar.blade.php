  <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
              <a href="{{ route('dashboard') }}" class="logo">
                  {{-- <img src="{{ asset('backend/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                      class="navbar-brand" height="20" /> --}}
                      <h5 class="text-white">BADMINTON-CLUB</h5>
              </a>
              <div class="nav-toggle">
                  <button class="btn btn-toggle toggle-sidebar">
                      <i class="gg-menu-right"></i>
                  </button>
                  <button class="btn btn-toggle sidenav-toggler">
                      <i class="gg-menu-left"></i>
                  </button>
              </div>
              <button class="topbar-toggler more">
                  <i class="gg-more-vertical-alt"></i>
              </button>
          </div>
          <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
              <ul class="nav nav-secondary">
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}">
                          <i class="fas fa-home"></i>
                          <p>Dashboard</p>
                          {{-- <span class="caret"></span> --}}
                      </a>
                      {{-- <div class="collapse" id="dashboard">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('dashboard') }}">
                                      <span class="sub-item">Dashboard 1</span>
                                  </a>
                              </li>
                          </ul>
                      </div> --}}
                  </li>
                  <li class="nav-section">
                      <span class="sidebar-mini-icon">
                          <i class="fa fa-ellipsis-h"></i>
                      </span>
                      <h4 class="text-section">Components</h4>
                  </li>
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#players">
                          <i class="fas fa-users"></i>
                          <p>Players</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="players">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('players.create') }}">
                                      <span class="sub-item">Add Player</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('players.index') }}">
                                      <span class="sub-item">View Player</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#teams">
                          <i class="fas fa-user-check"></i>
                          <p>Teams</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="teams">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('teams.create') }}">
                                      <span class="sub-item"> Add Team</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('teams.index') }}">
                                      <span class="sub-item">View Teams</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#events">
                          <i class="fas fa-luggage-cart"></i>
                          <p>Events</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="events">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('events.create') }}">
                                      <span class="sub-item"> Add Event</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('events.index') }}">
                                      <span class="sub-item">View Event</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a data-bs-toggle="collapse" href="#matches">
                          <i class="far fa-check-circle"></i>
                          <p>Matches</p>
                          <span class="caret"></span>
                      </a>
                      <div class="collapse" id="matches">
                          <ul class="nav nav-collapse">
                              <li>
                                  <a href="{{ route('matches.create') }}">
                                      <span class="sub-item">Add Match</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{ route('matches.index') }}">
                                      <span class="sub-item">View Matches</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  </div>
