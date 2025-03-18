<html>

    <head>
    <title>CMS System</title>
    <script src="jQry/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>

    <body>
      
      <?php include 'include/menubar.php'; ?>
      <br>
      
<div class="container">
    <div class="row">
        <section class="col-lg-7">
<?php
$sel_sql="select * from posts";
$runs_sql=mysqli_query($conn,$sel_sql);//$runs_sql=$conn->query($conn,$sel_sql);
while($rows=mysqli_fetch_assoc($runs_sql))
{
    echo '<div class="card">
    <div class="card-header">
                <strong>'.$rows['title'].'</strong>
            </div>
        <div class="card-body">
            
            <div class="row">
            <div class="col-lg-9">
            <img src=" '.$rows['image'].'" width="100%" alt="...">
            </div>
            <div class="col-lg-12">
            <p class="card-text">'.substr($rows['description'],0,150).'..... 
                </p>
            </div>
            </div>
            <div class="row">
                <div class=""></div>
                <div class=""> <a href="readpost.php?pstd='.$rows['post_id'].'" class="btn btn-secondary">Read More</a></div>
            </div>
          
        </div>

    </div>';
}

?>     
        </section>

        <aside class="col-lg-5">
       <form role="form"action="">
        <div class="card">

            <div class="card-header">Search Something</div>

          <div class="card-body">

           <div class="row mb-2">
              <div class="input-group">
                
                    <input type="search" class="form-control" id="username" placeholder="Search something">
               
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="bi bi-search"></i></button>
                </div>
              </div>
           </div>
         </div>
        </div>
       </form>

       <form role="form" action="">
        <div class="card">
                <div class=" card-header">
            Login Area
        </div>
        <div class="card-body">

            <div class="row mb-2">
                <label for="username" class="col-sm-4 col-form-label">User Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="username">
                </div>
            </div>
            <div class="row mb-2">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password">
                </div>
            </div>
            <div class="row mb-2">

                <div class="col-sm-8">
                    <input type="submit" id="submit" class="btn btn-success btn-block">
                </div>
            </div>

        </div>
       </div>
      </form>
        
  <div class="list-group">
      <a href="" class="list-group-item">
          <h4 class="list-group-item-heading">Post1</h4>
          <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
      </a>
      <a href="" class="list-group-item active">
          <h4 class="list-group-item-heading">Post1</h4>
          <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
      </a>
      <a href="" class="list-group-item">
          <h4 class="list-group-item-heading">Post1</h4>
          <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
      </a>
      <a href="" class="list-group-item">
          <h4 class="list-group-item-heading">Post1</h4>
          <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
      </a>
  </div>
      </aside>
</div>    
    </body>
</html>