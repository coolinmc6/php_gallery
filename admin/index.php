<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) { redirect("login.php"); } ?>
        
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            
            <?php include('includes/top_nav.php'); ?>

            <?php include('includes/side_nav.php'); ?>
        
        </nav>

       
       

        <div id="page-wrapper">

            <?php include('includes/admin-content.php') ?>
            
        </div>
        

<?php include("includes/footer.php"); ?>
<script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Views',     <?php echo $session->count; ?>],
              ['Photos',      <?php echo Photo::count_all(); ?>],
              ['Users',  <?php echo  User::count_all(); ?>],
              ['Comments', <?php echo  Comment::count_all(); ?>]
            ]);

            var options = {
              title: 'My Daily Activities',
              legend: 'none', 
              pieSliceText: 'label'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
    </script>