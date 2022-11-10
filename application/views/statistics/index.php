<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>  
    <script src="https://code.highcharts.com/highcharts.js"></script>  
    <style>
    @media print {
  body * {
    visibility: visible;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
  </head>
  <body class="p-3 m-0 border-0 bd-example">

  <h3><?= $title ?></h3>
  <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolore voluptate numquam sunt corporis error ipsa iure velit molestiae delectus, quam excepturi totam. Officiis veniam provident nostrum deserunt ducimus architecto quis. </p>

  <button class="btn btn-primary mb-2" onclick="window.print()">Print</button>

    <!-- Example Code -->
    
    <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
      <div class="col">
        <div class="card">
        <img src="<?= base_url() . 'uploads/' . 'order_date.png' ?>" class="card-img-top" alt="order_date" height ="300">
       <!-- <img class="bd-placeholder-img card-img-top" src = "order_date.png" height ="140" width= "100%" alt=""> -->
          <div class="card-body">
            <h5 class="card-title">The Last Order Date</h5>
            <?php foreach($orders as $order) : ?>
            <p class="card-text"><?= $order['orderDate'] ?></p>
            <?php endforeach ; ?>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
        <img src="<?= base_url() . 'uploads/' . 'bset_customer.png' ?>" class="card-img-top" alt="best_customer" height ="300">    
          <div class="card-body">
            <h5 class="card-title">The best customer</h5>
            <?php foreach($customers as $customer) : ?>
            <p class="card-text"><?php echo $customer['customerName'] ?></p>
            <?php endforeach ; ?>         
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
        <img src="<?= base_url() . 'uploads/' . 'product-icon.png' ?>" class="card-img-top" alt="best_prodcut" height ="300">        
          <div class="card-body">
            <h5 class="card-title">The most popular product</h5>
            <?php foreach($mostPopular as $most) : ?>
            <p class="card-text"><?= $most['productName'] ?></p>
            <?php endforeach ; ?>         
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
        <img src="<?= base_url() . 'uploads/' . 'hourglass-done-icon.png' ?>" class="card-img-top" alt="almost_done" height ="300">        
          <div class="card-body">
            <h5 class="card-title">Stocks running out soon</h5>
            <?php foreach($quantities as $quantity) : ?>
            <p class="card-text"><?= $quantity['productName'] ?></p>
            <p class="card-text"><?= 'Quantity: '.$quantity['quantityP'] ?></p>
            <?php endforeach ; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="">
        <p class="fw-bold"> The best seller product</p>
        <?php foreach($orderDetails as $orderDetail) : ?>
    <ol class="list-group list-group">
  <li class="list-group-item d-flex justify-content-between align-items-start mb-2">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><?= $orderDetail['productName'] ?></div>
    </div>
    <span class="badge bg-primary rounded-pill">number of orders: <?= $orderDetail['Total'] ?></span>
  </li>
</ol>
<?php endforeach ; ?>
</div>

<div class="mt-4">
        <p class="fw-bold">  Top 3 Customers</p>
        <?php foreach($statistics as $statistic) : ?>
<div class="row mb-2">
    <div class="col-md-9">
    <ol class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold"><?= $statistic['customerName'] ?></div>
      <?= $statistic['address'] ?>
    </div>
    <span class="badge bg-primary rounded-pill"> number of orders: <?= $statistic['Total'] ?></span>
  </li>
    </ol>
    </div>
</div>

<?php endforeach ; ?>

    </div>
    
<div class="container">  
    <br/>  
    <!--<h2 class="text-center"> Highcharts in Codeigniter MYSQL JSON </h2>  -->
    <?php $array_product = array(); ?>   
      <?php foreach($products as $product) : ?>
<!-- <?php echo $product['productName']; ?>  -->
<?php $array_product[] = $product['productName']; ?>
<?php endforeach ; ?>
<?php $object_encoded = json_encode( $array_product );?>

<?php $array_quantityP = array(); ?>   
<?php foreach($products as $product) : ?>
<!-- <?php echo $product['quantityP']; ?>  -->
<?php $array_quantityP[] = $product['quantityP']; ?>
<?php $array_quantityP = array_map('intval', $array_quantityP); ?>
<?php $object_encoded2 = json_encode( $array_quantityP);?>
<?php endforeach ; ?>
    <h2 class="text-center"> Highcharts of Products </h2>  
    <div class="row">  
        <div class="col-md-10 col-md-offset-1">  
            <div class="panel panel-default">  
                <div class="panel-body">  
                    <div id="container"></div>  
    <script type="text/javascript">  
    
    $(function () {   
        
        $('#container').highcharts({  
            chart: {  
                type: 'column'  
            },  
            title: {  
                text: 'The name of product and thier quantity'  
            },  
            xAxis: {  
              title: {  
                    text: 'product name'  
                }  , 
                categories: <?php echo $object_encoded ?>
            },  
            yAxis: {  
                title: {  
                    text: 'quantity'  
                }  
            },  
            series: [{  
                name: 'quantity', 
                data: <?php echo $object_encoded2 ?>
            }] 
        });  
    });  
        
    </script> 
                </div>  
            </div>  
        </div>  
    </div>
</div>  


<div class="container box">
  <h3>Export Data to Excel in Codeigniter using PHPSpreadsheet (Customer Table)</h3>
  <br />
  <div class="table-responsive">
   <table class="table table-bordered">
    <tr>
     <th>Name</th>
     <th>Address</th>
     <th>Postal Code</th>
    </tr>
    <?php
    foreach($allCustomers as $customer)
    {
     echo '
     <tr>
     <td>'.$customer['customerName'].'</td>
     <td>'.$customer['address'].'</td>
     <td>'.$customer['PostalCode'].'</td>
     </tr>
     ';
    }
    ?>
   </table>
   <div>
    <form method="post" action="<?php echo base_url(); ?>Statistics/createExcel">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>
   <br />
   <br />
  </div>
 </div>
    
    <!-- End Example Code -->
  </body>
</html>