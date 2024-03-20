

    
<section class="content-wrapper">
    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="request-details">
        <div>
            <p class="label">Name:</p>
            <p><?php echo $quoteData->name; ?></p>
        </div>

        <div>
            <p class="label">Email:</p>
            <p><?php echo $quoteData->email; ?></p>
        </div>

        <div>
            <p class="label">Contact Number:</p>
            <p><?php echo $quoteData->contact_number; ?></p>
        </div>

        <div>
            <p class="label">Address:</p>
            <p><?php echo $quoteData->address; ?></p>
        </div>

        <div>
            <p class="label">Company/Organization:</p>
            <p><?php echo $quoteData->company; ?></p>
        </div>

        <div>
            <p class="label">Selected Product:</p>
            <p><?php echo $quoteData->product; ?></p>
        </div>

        <div>
            <p class="label">Estimated Quantity:</p>
            <p><?php echo $quoteData->quantity; ?></p>
        </div>

        <div>
            <p class="label">Inquiry Details:</p>
            <p><?php echo $quoteData->details; ?></p>
        </div>

        <div>
            <p class="label">Sample Design:</p>
            <p>
                <a data-fslightbox href="<?php echo APP_URL . '/public/quote-file/' . $quoteData->file_name; ?>">
                <img src="<?php echo APP_URL . '/public/quote-file/' . $quoteData->file_name; ?>" alt="" /></a>
            </p>
        </div>
    </div>
</section>
</main>

<script src="<?php echo APP_URL; ?>/public/js/plugins/fslightbox.js"></script>
