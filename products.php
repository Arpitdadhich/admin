<?php

/**
 * MyClass File Doc Comment    
 * PHP version 5
 * 
 * @category MyClass
 * @package  MyPackage
 * @author   Me <me@example.com>
 * @license  http://www.abc.org GNU General Public License
 * @link     http://www.abc.com/
 */

//session_start();
require 'config.php';
require 'header.php';
require 'sidebar.php';

if (isset($_POST['submit'])) {
    $category = isset($_POST['category'])?$_POST['category']:'';
    $name = isset($_POST['name'])?$_POST['name']:'';
    $price = isset($_POST['price'])?$_POST['price']:'';
    $img = isset($_POST['img'])?$_POST['img']:'';
    //$short_desc = isset($_POST['short_desc'])?$_POST['short_desc']:'';
    $long_desc = isset($_POST['long_desc'])?$_POST['long_desc']:'';


    
     
    $sql = 'INSERT INTO products (`category_id`, `name`  , `price` , `image`,`long_desc`)
    VALUES ("'. $category .'","'. $name .'","'. $price .'" ,"'. $img .'","'. $long_desc .'")';

    if ($conn->query($sql) === true) {
        echo "New record created successfully";
    } else {
        echo "record not created";
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
     
}
 
?>



<div id="main-content">
<!-- Main Content Section with everything -->

<!-- Page Head -->
<h2>Welcome John </h2>
<p id="page-intro">What would you like to do?</p>
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Products</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Manage</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Add</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <!-- This is the target div. id must match the href of this div's tab -->
            <div class="notification png_bg">
                <a href="#" class="close">
                <img src="resources/images/icons/cross_grey_small.png" 
                     title="Close this notification" alt="close" /></a>
                <div>
                    List of all the products in the database.
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox" /></th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discription</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Choose an action</option>
                                    <option value="option2">Edit</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Apply to selected</a>
                            </div>
                            <div class="pagination">
                                <a href="#" title="First Page">&laquo; First</a>
                                <a href="#" title="Previous Page">&laquo;Previous</a>
                                <a href="#" class="number" title="1">1</a>
                                <a href="#" class="number" title="2">2</a>
                                <a href="#" class="number current" title="3">3</a>
                                <a href="#" class="number" title="4">4</a>
                                <a href="#" title="Next Page">Next &raquo;</a>
                                <a href="#" title="Last Page">Last &raquo;</a>
                            </div>
                            <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <?php $result = mysqli_query($conn, "SELECT * FROM products"); 
                while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php echo $row['product_id'] ; ?></td>
                        <td><a href="#" title="title"><?php echo $row['name']; ?></a></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['long_desc']; ?></td>
                        <td>
                            <!-- Icons  -->
                            <a href="#" title="Edit">
                            <img src="resources/images/icons/pencil.png" alt="Edit"/>
                            </a>
                            <a href="#" title="Delete">
                            <img src="resources/images/icons/cross.png" alt="Delte"/>
                            </a>
                            <a href="#" title="Edit Meta">
                            <img src="resources/images/icons/hammer_screwdriver.png"
                             alt="Edit Meta" /></a>
                        </td>
                    </tr>

                <?php } ?>
                
                
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
            <form action="products.php"  method="POST">
                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets
                     to divide the form into columns -->
                    <p>
                        <label>Name</label>
                        <input class="text-input small-input" type="text" 
                        id="small-input" name="name" />
                        <!-- <span class="input-notification success png_bg">
                        Successful message</span> -->
                        <!-- Classes for input-notification: success, error,
                         information, attention -->
                    </p>
                    <p>
                        <label>Price</label>
                        <input class="text-input medium-input datepicker"
                         type="text" id="medium-input" name="price" />
                        <!-- <span class="input-notification error png_bg">
                        Error message</span> -->
                    </p>
                    <p>
                        <label>Image</label>
                        <input type="file" id="myFile" name="img" >
                    </p>
            <p>
            <label>Category</label>              
            <select name="category" class="small-input" >
            <option value="1">Men</option>
            <option value="2">Women</option>
            <option value="3">Kids</option>
            <option value="4">Electronics</option>
            <option value="5">Sports</option>
            </select> 
            </p>
            <p>
            <label>Tags</label>
            <input type="checkbox" name="short_desc[]" /> Fashion 
            <input type="checkbox" name="short_desc[]" /> Ecommerce
            <input type="checkbox" name="short_desc[]" /> Shop
            <input type="checkbox" name="short_desc[]" /> Hand Bag
            <input type="checkbox" name="short_desc[]" /> Laptop
            <input type="checkbox" name="short_desc[]" /> Headphone
            </p>
            <p>
            <label>Discription</label>
            <textarea class="text-input textarea wysiwyg" id="textarea" 
            name="long_desc" cols="79" rows="15"></textarea>
            </p>
            <p>
            <input class="button" type="submit" name="submit" value="Submit" />
            </p>
            </fieldset>
            <div class="clear"></div>
            <!-- End .clear -->
            </form>
        </div>
        <!-- End #tab2 -->
    </div>
    <!-- End .content-box-content -->
</div>
<!-- End .content-box -->
<div class="clear"></div>
<!-- Start Notifications -->
<!--
    <div class="notification attention png_bg">
        <a href="#" class="close">
        <img src="resources/images/icons/cross_grey_small.png" 
        title="Close this notification" alt="close" /></a>
        <div>
            Attention notification. Lorem ipsum dolor sit amet,
             consectetur adipiscing elit. Proin vulputate, sapien
              quis fermentum luctus, libero.
        </div>
    </div>
    
    <div class="notification information png_bg">
        <a href="#" class="close">
        <img src="resources/images/icons/cross_grey_small.png"
         title="Close this notification" alt="close" /></a>
        <div>
            Information notification. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit. Proin vulputate, sapien
            quis fermentum luctus, libero.
        </div>
    </div>
    
    <div class="notification success png_bg">
        <a href="#" class="close">
        <img src="resources/images/icons/cross_grey_small.png"
         title="Close this notification" alt="close" /></a>
        <div>
            Success notification. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit. Proin vulputate, sapien
            quis fermentum luctus, libero.
        </div>
    </div>
    
    <div class="notification error png_bg">
        <a href="#" class="close">
        <img src="resources/images/icons/cross_grey_small.png"
         title="Close this notification" alt="close" /></a>
        <div>
            Error notification. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit. Proin vulputate, sapien quis
            fermentum luctus, libero.
        </div>
    </div>-->
<!-- End Notifications -->
<?php require 'footer.php'?>