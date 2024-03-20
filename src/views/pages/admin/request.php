
<section class="content-wrapper">
    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="content-top-menu">

        <form class="search-form" data-search_form>
            <div class="search-input">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="20" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>

                <input type="text" name="search_key" placeholder="Search name and product" required/>
            </div>

            <button class="primary-outline-btn center" data-btn_search>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="20" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form> 
       
        <div class="mp-button-container">
            <button class="secondary-btn" disabled data-bulk_delete>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="15" width="15">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <span>Bulk delete</span>
            </button>
        </div>
    </div>

    <div class="quote-list">
        <table>
            <thead>
                <tr>
                    <th><input class="bulk_check" type="checkbox" name="check_all" data-bulk_check></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Company</th>
                    <th>Address</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <!-- RENDER DYNAMIC DATA -->
                <?php

                    if (count($quoteData) === 0 ) {
                        echo '
                            <tr>
                                <td colspan="12" align="center">No quote received</td>
                            </tr>';

                    } else {
                        foreach ($quoteData as $item) {

                            $status = $item->read_status == 0 ? 'UNREAD' : 'READ';

                            echo '
                                <tr data-id="'. $item->id .'" data-name="'. $item->name .'">
                                    <td><input class="check_item" type="checkbox" name="check" data-check_item="'. $item->id .'"></td>
                                    <td>'. $item->name .'</td>
                                    <td>'. $item->email .'</td>
                                    <td>'. $item->contact_number .'</td>
                                    <td>'. $item->company .'</td>
                                    <td>'. $item->address .'</td>
                                    <td>'. $item->product .'</td>
                                    <td>'. $item->quantity .'</td>
                                    <td>'. strip_tags($item->details) .'</td>
                                    <td>'. date('m/d/Y H:i:s', strtotime($item->time_stamp)) .'</td>
                                    <td><p class="'. $status .'">'. $status .'</p></td>
                                    <td>
                                        <div>
                                            <a href="'. APP_URL .'request-details/'.  $item->id .'" class="primary-action-btn expand-on-hover">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                                    <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                                                </svg>
                                            </a>
                                            <button class="primary-action-btn delete_btn expand-on-hover danger" data-delete_btn>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                                    <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>';
                        }
                    }
                ?>
                 <!-- RENDER DYNAMIC DATA -->
            </tbody>
        </table>
    </div>
    
</section>

</main>


<script type="module" src="<?php echo APP_URL;?>/public/js/quoteRequestApp.js"></script>


