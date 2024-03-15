<main data-main >
    
    <div class="page-title-container title-texture-primary">
        <h1 class="text-title-l"><b>Get a Quote</b></h1>
    </div>

    <div class="get-quote-container bg-texture-primary">

        <section id="get-quote">
            <form method="post" data-send_inquiry_form>
                <div class="form-field">
                    <p>
                        <label for="name">Name<span class="red">*</span></label>
                        <input type="text" name="name" placeholder="Complete name" required/>
                    </p>

                    <p>
                        <label for="email">Email<span class="red">*</span></label>
                        <input type="email" name="email" placeholder="example@gmail.com" required/>
                    </p>
                </div>

                <div class="form-field">
                    <p>
                        <label for="contact_number">Contact Number<span class="red">*</span></label>
                        <input type="text" name="contact_number" placeholder="000-000-0000" required/>
                    </p>

                    <p>
                        <label for="company">Company/Organization</label>
                        <input type="text" name="company" placeholder="N/A"/>
                    </p>
                </div>

                <div>
                    <label for="delivery_address">Delivery Address<span class="red">*</span></label>
                    <input type="text" name="address" placeholder="Complete Delivery Address" required/>
                </div>

                <div class="form-field">
                    <p>
                        <label for="product">Select Product<span class="red">*</span></label>
                        <select name="product" required/>
                            <?php 

                                if (count($productData) > 0) {
                                    foreach ($productData as $item) {
                                        echo '<option value="'.$item->title.'">'.$item->title.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </p>

                    <p>
                        <label for="quantity">Quantity<span class="red">*</span></label>
                        <input type="number" name="quantity" placeholder="0" data-required="true"/>
                    </p>
                </div>

                <div>
                    <label for="details">Details<span class="red">*</span></label>
                    <textarea rows="8" name="details" placeholder="Please described your order details" required></textarea>
                </div>

                <div>
                    <label for="file_upload">Upload Logo/Custom Design/Sample (png/jpg)</label>
                    <input type="file" name="file_upload" accept=".jpg, .jpeg, .png, .webp|image/*" />
                </div>

                <div>
                    <button class="primary-btn" data-send_inquiry>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="M120-160v-640l760 320-760 320Zm80-120 474-200-474-200v140l240 60-240 60v140Zm0 0v-400 400Z"/>
                        </svg>
                        <span>Send Inquiry</span>
                    </button>
                </div>
            </form>

        </section>
    </div>

    <div class="g-maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7906.554299009843!2d124.99938036820068!3d7.760403778533991!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ff3b84daa5078b%3A0xe9861a9d65754e3c!2sD-URBAN%20PRINTING%20SHOP%20%26%20SERVICES!5e0!3m2!1sen!2sph!4v1708475672137!5m2!1sen!2sph" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</main>