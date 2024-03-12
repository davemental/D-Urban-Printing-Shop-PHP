
<section class="content-wrapper">

    <div class="user-account">
        <div class="page-title">
            <h1>My Profile</h1>
            <span class="text-body-m">Manage and protect your account</span>
        </div>


        <form>
            <div>
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="Your unique user name" value="" />
            </div>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Your name" value="" />
            </div>
        
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="youremail@gamil.com" value="" />
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="your password" value="" />
            </div>

            <div>
                <label for="retype_password">Re-Type Password</label>
                <input type="password" name="retype_password" placeholder="re-type your password" value="" />
            </div>

            <div>
                <button class="secondary-btn" data-save>Save</button>
            </div>
        </form>
    </div>
    
</section>
</main>


<script type="module" async src="<?php echo APP_URL;?>/public/js/userAccountApp.js"></script>