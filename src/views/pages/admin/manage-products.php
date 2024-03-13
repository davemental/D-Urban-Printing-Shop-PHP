
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

                <input type="text" name="product_key" placeholder="Search product" required/>
            </div>

            <button class="primary-outline-btn center" data-btn_search>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="20" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form> 
       
        <div class="mp-button-container">
            <a class="secondary-btn" href="<?php echo APP_URL;?>add-product">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="M640-640h120-120Zm-440 0h338-18 14-334Zm16-80h528l-34-40H250l-34 40Zm184 270 80-40 80 40v-190H400v190Zm182 330H200q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v196q-19-7-39-11t-41-4v-122H640v153q-35 20-61 49.5T538-371l-58-29-160 80v-320H200v440h334q8 23 20 43t28 37Zm138 0v-120H600v-80h120v-120h80v120h120v80H800v120h-80Z"/>
                </svg>
                <span>Add product</span>
           </a>

            <button class="secondary-btn" disabled data-bulk_delete>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/>
                </svg>
                <span>Bulk delete</span>
            </button>
        </div>
    </div>

    <div class="product-list">
        <table>
            <thead>
                <tr>
                    <th><input class="bulk_check" type="checkbox" name="check_all" data-bulk_check></th>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <!-- RENDER DYNAMIC DATA -->
                <?php

                    if (count($productData) === 0 ) {
                        echo '
                            <tr>
                                <td colspan="7">Empty product list</td>
                            </tr>';

                    } else {
                        foreach ($productData as $item) {
                            echo '
                                <tr data-id="'. $item->id .'" data-title="'. $item->title .'" data-featured_img="'.$item->featured_img.'">
                                    <td><input class="check_item" type="checkbox" name="check" data-check_item="'. $item->id .'"></td>
                                    <td>'. $item->id .'</td>
                                    <td>'. $item->title .'</td>
                                    <td>'. strip_tags($item->description) .'</td>
                                    <td><img src="' .APP_URL .'/public/images/uploads/products/' . $item->featured_img . '" alt="" /></td>
                                    <td><span data-date_entry="'. date('m/d/Y H:i:s', strtotime($item->date_entry)).'">'. date('m/d/Y', strtotime($item->date_entry)) .'</span></td>
                                    <td>
                                        <div>
                                            <a href="'. APP_URL .'edit-product/'.  $item->id .'" class="primary-action-btn expand-on-hover">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                                </svg>
                                            </a>
                                            <button class="primary-action-btn expand-on-hover danger" data-delete_btn>
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

<script type="module" src="<?php echo APP_URL;?>/public/js/productApp.js"></script>