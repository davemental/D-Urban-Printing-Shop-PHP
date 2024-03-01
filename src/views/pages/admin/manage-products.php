
<section class="content-wrapper">
    <div class="page-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="mp-menu-container">

        <form class="search-form" data-search_form>
            <div class="search-input">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="20" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>

                <input type="text" name="product_key" placeholder="Search product" required/>
            </div>

            <button class="primary-outline-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="20" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </form> 
       
        <div class="mp-button-container">
            <a class="secondary-btn" href="<?php echo APP_URL;?>add-product">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="15" width="15">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add product</span>
           </a>

            <button class="secondary-btn" disabled data-bulk_delete>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="15" width="15">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <span>Bulk delete</span>
            </button>
        </div>
    </div>

    <div class="product-list">
        <table>
            <thead>
                <tr>
                    <th><input class="bulk_check" type="checkbox" name="check_all" data-check_all></th>
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
                                            <button class="primary-action-btn" data-edit>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                                </svg>
                                            </button>
                                            <button class="primary-action-btn delete_btn">
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

    <!-- <div class="mp-navigation-container">
        <div class="pagination-status">
            <span>1-10 or 97</span>
        </div>

        <div.append('title', 'Delete Product');ass="table-pagination">
            <div>
                <span>Rows per page:</span>
                <select name="rows_per_page">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <div class="pagination-control">
                <button data-prev>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" height="15" width="15">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <span>1/10</span>

                <button data-next>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"  height="15" width="15">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div.append>
    </div> -->
</section>

</main>

<script type="module" async src="<?php echo APP_URL;?>/public/js/adminApp.js"></script>

