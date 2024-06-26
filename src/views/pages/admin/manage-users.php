
<section class="content-wrapper">
    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="user-menu-container">

        <div class="mp-button-container">
            <button class="secondary-btn" data-new_account_btn>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="15" width="15">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>New Account</span>
           </button>
        </div>
    </div>

    <div class="user-list">
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                 <!-- RENDER DYNAMIC DATA -->
                 <?php
                     if (count($userData) > 0) {
                         foreach ($userData as $user) {
                             echo '<tr>
                                     <td>'. $user->id .'</td>
                                     <td>'. $user->name .'</td>
                                     <td>'. $user->username .'</td>
                                     <td>'. $user->email .'</td>
                                     <td><span data-date_entry="'. $user->time_stamp .'">'. $user->time_stamp .'</span></td>
                                 </tr>';
                         }
                     }
               ?>
            </tbody>
        </table>
    </div>
    
</section>

</main>

<script type="module" async src="<?php echo APP_URL;?>/public/js/manageUserApp.js"></script>

