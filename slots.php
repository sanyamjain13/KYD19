<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang='en' dir='ltr'>

<head>
  <meta charset='utf-8'>
  <title>Slots</title>
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:100,400,900|Ubuntu&display=swap' rel='stylesheet'>


  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
  <!-- Font Awesome -->
  <script src='https://kit.fontawesome.com/faacc3d813.js'></script>
  <!-- Bootstrap Scripts -->
  <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
  <!-- CSS Style Sheets -->
  <link rel='stylesheet' href='css/slots_styles.css'>
</head>

<body>
  <?php
    $speciality=$_GET['Speciality'];
    $hospital=$_GET['Hospital'];
    $select="SELECT * FROM doctor WHERE Speciality='$speciality' AND Hospital='$hospital'";
    $run=mysqli_query($conn,$select);
    while ($rows=mysqli_fetch_assoc($run)) {

      echo "
      <div class='doctor'>
        <div class='doc'>
          <img class='doc-img' src='images/doctorimages/$rows[image]' alt=''>

          <div class='doc-slots'>
            <div class='doc-name'>
              <h3 class='name'>$rows[Dname]</h3>
              <h4 class='desc'>$rows[Speciality]</h4>
            </div>
            <div class='dates'>
              <table class='table'>
                <thead style='background-color:#116daa'>
                  <tr>
                    <th scope='col'>Previous Date</th>
                    <th scope='col'><button  type='button' class='btn btn-primary'>24-07-2019</button></th>
                    <th scope='col'>Next Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Morning</td>
                    <td>Afternoon</td>
                    <td>Evening</td>
                  </tr>
                  <tr>

                    <td>Time</td>
                    <td>Time</td>
                    <td>Time</td>
                  </tr>
                  <tr class='a' style='display:none'>

                    <td>Time</td>
                    <td>Time</td>
                    <td>Time</td>
                  </tr>
                  <tr class='a' style='display:none'>

                    <td>Time</td>
                    <td>Time</td>
                    <td>Time</td>
                  </tr>
                  <tr class='a' style='display:none'>

                    <td>Time</td>
                    <td>Time</td>
                    <td>Time</td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class='view'>
              <button type='button' class='btn v btn-info'>View all Slots</button>
            </div>
          </div>
        </div>
      </div>

      ";
    }
  ?>


        <!-- <div class='dates'>
          <table class='table'>
            <thead style='background-color:#116daa'>
              <tr>

                <th scope='col'>Previous Date</th>
                <th scope='col'><button  type='button' class='btn btn-primary'>24-07-2019</button></th>
                <th scope='col'>Next Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <td>Morning</td>
                <td>Afternoon</td>
                <td>Evening</td>
              </tr>
              <tr>

                <td>Time</td>
                <td>Time</td>
                <td>Time</td>
              </tr>
              <tr class='a' style='display:none'>

                <td>Time</td>
                <td>Time</td>
                <td>Time</td>
              </tr>
              <tr class='a' style='display:none'>

                <td>Time</td>
                <td>Time</td>
                <td>Time</td>
              </tr>
              <tr class='a' style='display:none'>

                <td>Time</td>
                <td>Time</td>
                <td>Time</td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class='view'>
          <button type='button' class='btn v btn-info'>View all Slots</button>
        </div>
      </div>
    </div>

  </div> -->
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='js/slots_js.js' charset='utf-8'></script>
</body>

</html>
