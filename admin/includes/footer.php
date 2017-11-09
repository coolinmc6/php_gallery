  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
