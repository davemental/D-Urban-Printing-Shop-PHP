
<section class="content-wrapper">

    <div class="user-account">
        <div class="page-title">
            <h1>My Profile</h1>
            <span class="text-body-m">Manage and protect your account</span>
        </div>

        <form>
            <input type="hidden" name="id" value="<?php echo $userData->id; ?>" />

            <div>
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="Your unique user name" value="<?php echo $userData->username; ?>" />
            </div>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Your name" value="<?php echo $userData->name; ?>" />
            </div>
        
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="youremail@gamil.com" value="<?php echo $userData->email; ?>" />
            </div>

            <div>
                <label for="password">New Password</label>
                <input type="password" name="password" placeholder="your password" value="" />
            </div>

            <div>
                <label for="retype_password">Re-Type Password</label>
                <input type="password" name="retype_password" placeholder="re-type your password" value="" />
            </div>

            <div>
                <button class="secondary-btn" data-save>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none"/><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z"/>
                    </svg>    
                    <span>Save</span>
                </button>
            </div>
        </form>
    </div>
    
</section>
</main>


<script type="module" async src="<?php echo APP_URL;?>/public/js/userAccountApp.js"></script>