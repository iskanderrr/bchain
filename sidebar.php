<?php


function sidebar($active){
    $isAdmin =isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN';
    echo '  <div class="sidebar">
    <div class="logo">
      <a href="" style="text-decoration: none;color:black;">
        <h1>BlockChain</h1>
      </a>
    </div>
    <div style="display: flex; flex-direction: column;">
      <div class="side-menus">
        <p class="side-bar-title" style="margin-bottom: 12px;"> MENU</p>
        <ul class="menu">
          <li class="'; if ($active ===1 ) echo "selected";
          echo '"><a href="index.php">
              <div class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0,0,300,150">
                  <g fill="#9A9A9A" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                    style="mix-blend-mode: normal">
                    <g transform="scale(10.66667,10.66667)">
                      <path
                        d="M12,2.09961l-11,9.90039h3v9h7v-6h2v6h7v-9h3zM12,4.79102l6,5.40039v0.80859v8h-3v-6h-6v6h-3v-8.80859z">
                      </path>
                    </g>
                  </g>
                </svg>
                <p>Home</p>
              </div>
            </a></li>
          <li class="'; if ($active ===2 ) echo "selected";
          echo '"><a href="post.php">
              <div class="menu-item">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
              <path d="M 43.125 2 C 41.878906 2 40.636719 2.488281 39.6875 3.4375 L 38.875 4.25 L 45.75 11.125 C 45.746094 11.128906 46.5625 10.3125 46.5625 10.3125 C 48.464844 8.410156 48.460938 5.335938 46.5625 3.4375 C 45.609375 2.488281 44.371094 2 43.125 2 Z M 37.34375 6.03125 C 37.117188 6.0625 36.90625 6.175781 36.75 6.34375 L 4.3125 38.8125 C 4.183594 38.929688 4.085938 39.082031 4.03125 39.25 L 2.03125 46.75 C 1.941406 47.09375 2.042969 47.457031 2.292969 47.707031 C 2.542969 47.957031 2.90625 48.058594 3.25 47.96875 L 10.75 45.96875 C 10.917969 45.914063 11.070313 45.816406 11.1875 45.6875 L 43.65625 13.25 C 44.054688 12.863281 44.058594 12.226563 43.671875 11.828125 C 43.285156 11.429688 42.648438 11.425781 42.25 11.8125 L 9.96875 44.09375 L 5.90625 40.03125 L 38.1875 7.75 C 38.488281 7.460938 38.578125 7.011719 38.410156 6.628906 C 38.242188 6.246094 37.855469 6.007813 37.4375 6.03125 C 37.40625 6.03125 37.375 6.03125 37.34375 6.03125 Z" fill="#9A9A9A"></path>
              </svg>
                <p>Create Post</p>
              </div>
            </a></li>
            ';if($isAdmin==true){
          echo'<li class="'; if ($active ===3 ) echo "selected";
          echo '"><a href="AdminPanel.php">
              <div class="menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18" viewBox="0,0,300,150">
                  <g fill="#9A9A9A" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                    style="mix-blend-mode: normal">
                    <g transform="scale(10.66667,10.66667)">
                      <path
                        d="M12,2.09961l-11,9.90039h3v9h7v-6h2v6h7v-9h3zM12,4.79102l6,5.40039v0.80859v8h-3v-6h-6v6h-3v-8.80859z">
                      </path>
                    </g>
                  </g>
                </svg>
                

              
                <p>Admin Panel</p>
              </div>
            </a></li>'
            ;}
        echo '<br/>
        </ul>
      </div>
      <div>
        <p class="side-bar-title"> OTHER</p>
        <ul class="menu">
          <li><a href="profile.php">
              <div class="menu-item">
                <img src="'.getPicture().'" alt="" width="40px;" style="border-radius: 50%;" id="pic" ">

                <div>
                  <p class="profile-title"><b>'.getFullNameById().'</b></p>
                  <p class="profile-desc" style="opacity: 0.5;">'.getEmailById().'</p>
                </div>






              </div>
            </a></li>
          <li><a href="logout.php">
              <div class="menu-item">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.08 10.965L15 9.045L13.08 7.125" stroke="#9A9A9A" stroke-width="1.5"
                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M7.32001 9.04492H14.9475" stroke="#9A9A9A" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M8.82001 15C5.50501 15 2.82001 12.75 2.82001 9C2.82001 5.25 5.50501 3 8.82001 3"
                    stroke="#9A9A9A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
                <p>Logout</p>
              </div>
            </a></li>

        </ul>
      </div>
    </div>

  </div>';
    

}

    
    
    
    
    
    
    
    
   




?>